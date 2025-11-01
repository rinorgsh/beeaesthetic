<template>
  <section class="gallerie-section py-5">
    <div class="container">
      <!-- Titre de la section -->
      <div class="section-header text-center mb-5">
        <h2 class="section-title">Gallerie</h2>
        <div class="separator"><span></span></div>
        <p class="section-subtitle">Découvrez nos plus belles créations</p>
      </div>
      
      <!-- Grille de la galerie avec chargement progressif -->
      <div class="gallerie-grid">
        <div 
          v-for="(image, index) in visibleImages" 
          :key="index" 
          class="gallerie-item"
          @click="openLightbox(index)"
          :class="{ [`animation-${index % 4}`]: true }"
          :style="{ animationDelay: `${index * 0.15}s` }"
        >
          <div class="image-container">
            <!-- ✅ CLOUDINARY : Transformation automatique, WebP/AVIF auto -->
            <img 
              :src="getCloudinaryUrl(image.id, 600)"
              :alt="image.alt"
              class="gallerie-image"
              loading="lazy"
              :fetchpriority="index < 8 ? 'high' : 'low'"
            >
          </div>
        </div>
      </div>

      <!-- Indicateur de chargement -->
      <div class="loading-container text-center mt-4" v-if="isLoading">
        <div class="loading-spinner"></div>
        <p class="loading-text">Chargement...</p>
      </div>

      <!-- Indicateur de fin -->
      <div class="end-message text-center mt-4" v-if="!hasMoreImagesToLoad && visibleImages.length > 0 && !isLoading">
        <div class="separator mt-4"><span></span></div>
        <p class="end-text mt-2">Vous avez tout vu</p>
      </div>
      
      <!-- Lightbox pour afficher les images en grand -->
      <div class="lightbox" v-if="lightboxOpen" @click="closeLightbox">
        <button class="lightbox-close" @click.stop="closeLightbox">&times;</button>
        <button class="lightbox-prev" @click.stop="prevImage" v-if="lightboxIndex > 0">&larr;</button>
        
        <div class="lightbox-content" @click.stop>
          <!-- ✅ Dans le lightbox, on charge la grande version (1920px) -->
          <img 
            :src="getCloudinaryUrl(visibleImages[lightboxIndex].id, 1920)"
            :alt="visibleImages[lightboxIndex].alt"
            class="lightbox-img"
          >
        </div>
        
        <button class="lightbox-next" @click.stop="nextImage" v-if="lightboxIndex < visibleImages.length - 1">&rarr;</button>
      </div>
    </div>
  </section>
</template>

<script setup>
import { ref, computed, onMounted, onUnmounted, nextTick } from 'vue';

// ✅ CONFIGURATION CLOUDINARY
// Remplacez 'YOUR_CLOUD_NAME' par votre vrai cloud name
const CLOUDINARY_CLOUD_NAME = import.meta.env.VITE_CLOUDINARY_CLOUD_NAME || 'dqljt4ans';
const CLOUDINARY_FOLDER = 'gallery'; // Le dossier dans Cloudinary

/**
 * ✅ FONCTION MAGIQUE : Génère l'URL Cloudinary avec transformations
 * 
 * @param {string} imageId - ID de l'image (ex: 'image00001')
 * @param {number} width - Largeur désirée en pixels
 * @returns {string} URL Cloudinary optimisée
 */
const getCloudinaryUrl = (imageId, width) => {
  // Transformations automatiques :
  // - w_${width} : Redimensionner à cette largeur
  // - f_auto : Format automatique (WebP/AVIF selon navigateur)
  // - q_auto : Qualité automatique optimisée par IA
  // - dpr_auto : Pour écrans Retina
  return `https://res.cloudinary.com/${CLOUDINARY_CLOUD_NAME}/image/upload/w_${width},f_auto,q_auto,dpr_auto/${CLOUDINARY_FOLDER}/${imageId}`;
};

/**
 * Version alternative avec crop intelligent (si besoin)
 */
const getCloudinaryUrlWithCrop = (imageId, width, height) => {
  // c_fill : Remplit le cadre en croppant si nécessaire
  // g_auto : Détecte automatiquement la zone importante (visages, etc.)
  return `https://res.cloudinary.com/${CLOUDINARY_CLOUD_NAME}/image/upload/w_${width},h_${height},c_fill,g_auto,f_auto,q_auto/${CLOUDINARY_FOLDER}/${imageId}`;
};

// Générer le tableau d'images
const createGalleryImages = () => {
  const images = [];
  for (let i = 1; i <= 22; i++) {
    const imageNumber = String(i).padStart(5, '0');
    images.push({
      id: `image${imageNumber}`, // ID Cloudinary
      alt: `Image ${i}`
    });
  }
  return images;
};

// ✅ Préchargement intelligent
const preloadImages = (indexes) => {
  indexes.forEach(index => {
    if (index >= 0 && index < galleryImages.value.length) {
      const image = galleryImages.value[index];
      
      // Précharger le thumbnail Cloudinary
      const img = new Image();
      img.src = getCloudinaryUrl(image.id, 600);
    }
  });
};

// ✅ Préchargement des grandes images pour le lightbox
const preloadFullImages = (indexes) => {
  indexes.forEach(index => {
    if (index >= 0 && index < visibleImages.value.length) {
      const image = visibleImages.value[index];
      
      // Précharger la grande image
      const img = new Image();
      img.src = getCloudinaryUrl(image.id, 1920);
    }
  });
};

// Images de la galerie
const galleryImages = ref(createGalleryImages());

// État pour le chargement progressif
const visibleImages = ref([]);
const initialLoadCount = 8;
const loadMoreCount = 8;
const isLoading = ref(false);

// État pour le lightbox
const lightboxOpen = ref(false);
const lightboxIndex = ref(0);

// Vérifier s'il y a plus d'images à charger
const hasMoreImagesToLoad = computed(() => {
  return visibleImages.value.length < galleryImages.value.length;
});

// Charger plus d'images
const loadMoreImages = () => {
  if (!hasMoreImagesToLoad.value || isLoading.value) return;
  
  isLoading.value = true;
  
  setTimeout(() => {
    const startIndex = visibleImages.value.length;
    const endIndex = Math.min(startIndex + loadMoreCount, galleryImages.value.length);
    const newImages = galleryImages.value.slice(startIndex, endIndex);
    
    visibleImages.value = [...visibleImages.value, ...newImages];
    isLoading.value = false;
    
    // Précharger les prochaines images
    if (hasMoreImagesToLoad.value) {
      preloadImages([endIndex, endIndex + 1, endIndex + 2]);
    }
  }, 300);
};

// Observer d'intersection
let observer = null;

const setupIntersectionObserver = () => {
  const sentinel = document.createElement('div');
  sentinel.classList.add('scroll-sentinel');
  document.querySelector('.gallerie-section').appendChild(sentinel);
  
  observer = new IntersectionObserver((entries) => {
    if (entries[0].isIntersecting && hasMoreImagesToLoad.value && !isLoading.value) {
      loadMoreImages();
    }
  }, {
    rootMargin: '500px',
    threshold: 0.1
  });
  
  observer.observe(sentinel);
};

// Méthodes pour le lightbox
const openLightbox = (index) => {
  lightboxIndex.value = index;
  lightboxOpen.value = true;
  document.body.style.overflow = 'hidden';
  
  // ✅ Précharger les GRANDES images adjacentes
  preloadFullImages([index - 1, index, index + 1]);
};

const closeLightbox = () => {
  lightboxOpen.value = false;
  document.body.style.overflow = '';
};

const nextImage = () => {
  if (lightboxIndex.value < visibleImages.value.length - 1) {
    lightboxIndex.value++;
    preloadFullImages([lightboxIndex.value + 1]);
  }
};

const prevImage = () => {
  if (lightboxIndex.value > 0) {
    lightboxIndex.value--;
    preloadFullImages([lightboxIndex.value - 1]);
  }
};

// Charger les premières images
const initialLoad = () => {
  visibleImages.value = galleryImages.value.slice(0, initialLoadCount);
  
  // Précharger les prochaines images
  preloadImages([initialLoadCount, initialLoadCount + 1, initialLoadCount + 2]);
  
  nextTick(() => {
    setupIntersectionObserver();
  });
};

// Cycle de vie du composant
onMounted(() => {
  initialLoad();
});

onUnmounted(() => {
  if (observer) {
    observer.disconnect();
  }
});
</script>

<style scoped>
.gallerie-section {
  background-color: #fafafa;
  font-family: 'Montserrat', 'Raleway', 'Helvetica Neue', sans-serif;
  position: relative;
}

.section-title {
  font-size: 2.2rem;
  font-weight: 300;
  text-transform: uppercase;
  letter-spacing: 3px;
  color: #333;
  margin-bottom: 0.5rem;
}

.separator {
  display: flex;
  justify-content: center;
  align-items: center;
  margin: 1rem 0;
}

.separator span {
  display: block;
  width: 50px;
  height: 1px;
  background-color: #000;
}

.section-subtitle {
  font-size: 1rem;
  font-weight: 300;
  color: #777;
  margin-bottom: 2rem;
}

.gallerie-grid {
  display: grid;
  grid-template-columns: repeat(4, 1fr);
  gap: 8px;
}

.gallerie-item {
  position: relative;
  overflow: hidden;
  aspect-ratio: 1;
  opacity: 0;
  cursor: pointer;
}

.gallerie-item:hover {
  transform: scale(1.02);
  transition: transform 0.3s ease;
}

@keyframes fadeInUp {
  from {
    opacity: 0;
    transform: translateY(30px);
  }
  to {
    opacity: 1;
    transform: translateY(0);
  }
}

@keyframes fadeInRight {
  from {
    opacity: 0;
    transform: translateX(-30px);
  }
  to {
    opacity: 1;
    transform: translateX(0);
  }
}

@keyframes fadeInLeft {
  from {
    opacity: 0;
    transform: translateX(30px);
  }
  to {
    opacity: 1;
    transform: translateX(0);
  }
}

@keyframes zoomIn {
  from {
    opacity: 0;
    transform: scale(0.85);
  }
  to {
    opacity: 1;
    transform: scale(1);
  }
}

.animation-0 {
  animation: fadeInUp 0.8s ease forwards;
}

.animation-1 {
  animation: fadeInRight 0.8s ease forwards;
}

.animation-2 {
  animation: fadeInLeft 0.8s ease forwards;
}

.animation-3 {
  animation: zoomIn 0.8s ease forwards;
}

.image-container {
  position: relative;
  width: 100%;
  height: 100%;
  overflow: hidden;
}

.gallerie-image {
  width: 100%;
  height: 100%;
  object-fit: cover;
  will-change: transform;
  backface-visibility: hidden;
  /* ✅ Cloudinary optimise déjà la qualité, mais on peut améliorer le rendu */
  image-rendering: -webkit-optimize-contrast;
}

.loading-container {
  padding: 1.5rem 0;
}

.loading-spinner {
  display: inline-block;
  width: 40px;
  height: 40px;
  border: 2px solid rgba(0, 0, 0, 0.1);
  border-top-color: #000;
  border-radius: 50%;
  animation: spin 0.8s linear infinite;
  margin-bottom: 0.5rem;
}

@keyframes spin {
  to {
    transform: rotate(360deg);
  }
}

.loading-text {
  font-size: 0.9rem;
  color: #777;
  letter-spacing: 1px;
}

.end-message {
  padding: 1rem 0;
}

.end-text {
  font-size: 0.9rem;
  color: #999;
  letter-spacing: 1px;
  font-style: italic;
}

.scroll-sentinel {
  position: absolute;
  bottom: 500px;
  left: 0;
  width: 100%;
  height: 20px;
  opacity: 0;
  pointer-events: none;
}

/* Lightbox */
.lightbox {
  position: fixed;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background-color: rgba(0, 0, 0, 0.9);
  display: flex;
  align-items: center;
  justify-content: center;
  z-index: 2000;
}

.lightbox-content {
  max-width: 90%;
  max-height: 90%;
  position: relative;
}

.lightbox-content img,
.lightbox-img {
  max-width: 100%;
  max-height: 90vh;
  display: block;
  margin: 0 auto;
  box-shadow: 0 0 20px rgba(0, 0, 0, 0.3);
  object-fit: contain;
}

.lightbox-close,
.lightbox-prev,
.lightbox-next {
  background: transparent;
  border: none;
  color: white;
  font-size: 1.5rem;
  cursor: pointer;
  position: absolute;
  transition: all 0.3s;
  width: 50px;
  height: 50px;
  display: flex;
  align-items: center;
  justify-content: center;
}

.lightbox-close {
  top: 20px;
  right: 20px;
  font-size: 2rem;
}

.lightbox-prev {
  left: 20px;
  top: 50%;
  transform: translateY(-50%);
}

.lightbox-next {
  right: 20px;
  top: 50%;
  transform: translateY(-50%);
}

.lightbox-close:hover,
.lightbox-prev:hover,
.lightbox-next:hover {
  opacity: 0.7;
}

/* Responsive */
@media (max-width: 1200px) {
  .gallerie-grid {
    grid-template-columns: repeat(3, 1fr);
    gap: 8px;
  }
}

@media (max-width: 992px) {
  .section-title {
    font-size: 1.8rem;
  }
  .gallerie-grid {
    gap: 6px;
  }
}

@media (max-width: 768px) {
  .gallerie-grid {
    grid-template-columns: repeat(2, 1fr);
    gap: 6px;
  }
}

@media (max-width: 576px) {
  .gallerie-grid {
    grid-template-columns: repeat(2, 1fr);
    gap: 4px;
  }
  
  .section-title {
    font-size: 1.5rem;
  }
}
</style>
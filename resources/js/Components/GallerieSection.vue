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
              <img 
                :src="image.src" 
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
            <img :src="visibleImages[lightboxIndex].src" :alt="visibleImages[lightboxIndex].alt">
          </div>
          
          <button class="lightbox-next" @click.stop="nextImage" v-if="lightboxIndex < visibleImages.length - 1">&rarr;</button>
        </div>
      </div>
    </section>
  </template>
  
  <script setup>
  import { ref, computed, onMounted, onUnmounted, nextTick } from 'vue';
  
  // Générer le tableau d'images numérotées
  const createGalleryImages = () => {
    const images = [];
    for (let i = 1; i <= 35; i++) {
      const imageNumber = String(i).padStart(5, '0'); // Format: 00001, 00002, etc.
      images.push({
        src: `/Images/image${imageNumber}.jpeg`,
        alt: `Image ${i}`
      });
    }
    return images;
  };
  
  // Préchargement d'images pour améliorer les performances
  const preloadImages = (indexes) => {
    indexes.forEach(index => {
      if (index >= 0 && index < galleryImages.value.length) {
        const img = new Image();
        img.src = galleryImages.value[index].src;
      }
    });
  };
  
  // Images de la galerie
  const galleryImages = ref(createGalleryImages());
  
  // État pour le chargement progressif
  const visibleImages = ref([]);
  const initialLoadCount = 8; // Nombre d'images à charger initialement
  const loadMoreCount = 8; // Nombre d'images à charger à chaque fois qu'on scroll
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
    
    // Simuler un délai de chargement réduit pour une expérience plus rapide
    setTimeout(() => {
      const startIndex = visibleImages.value.length;
      const endIndex = Math.min(startIndex + loadMoreCount, galleryImages.value.length);
      const newImages = galleryImages.value.slice(startIndex, endIndex);
      
      visibleImages.value = [...visibleImages.value, ...newImages];
      isLoading.value = false;
      
      // Précharger les prochaines images pour une expérience plus fluide
      if (hasMoreImagesToLoad.value) {
        preloadImages([endIndex, endIndex + 1, endIndex + 2]);
      }
    }, 300); // Délai réduit pour une meilleure performance
  };
  
  // Observer d'intersection pour détecter quand l'utilisateur atteint le bas de la page
  let observer = null;
  
  // Configuration de l'observer d'intersection
  const setupIntersectionObserver = () => {
    // Créer un élément sentinelle qui sera observé
    const sentinel = document.createElement('div');
    sentinel.classList.add('scroll-sentinel');
    document.querySelector('.gallerie-section').appendChild(sentinel);
    
    // Configurer l'observer
    observer = new IntersectionObserver((entries) => {
      if (entries[0].isIntersecting && hasMoreImagesToLoad.value && !isLoading.value) {
        loadMoreImages(); // Charge automatiquement plus d'images quand on descend
      }
    }, {
      rootMargin: '500px', // Augmenter pour précharger plus tôt
      threshold: 0.1
    });
    
    // Observer l'élément sentinelle
    observer.observe(sentinel);
  };
  
  // Méthodes pour le lightbox
  const openLightbox = (index) => {
    lightboxIndex.value = index;
    lightboxOpen.value = true;
    document.body.style.overflow = 'hidden'; // Empêcher le défilement
    
    // Précharger les images adjacentes pour une navigation fluide
    preloadImages([index - 1, index + 1]);
  };
  
  const closeLightbox = () => {
    lightboxOpen.value = false;
    document.body.style.overflow = ''; // Restaurer le défilement
  };
  
  const nextImage = () => {
    if (lightboxIndex.value < visibleImages.value.length - 1) {
      lightboxIndex.value++;
      // Précharger l'image suivante
      preloadImages([lightboxIndex.value + 1]);
    }
  };
  
  const prevImage = () => {
    if (lightboxIndex.value > 0) {
      lightboxIndex.value--;
      // Précharger l'image précédente
      preloadImages([lightboxIndex.value - 1]);
    }
  };
  
  // Charger les premières images
  const initialLoad = () => {
    visibleImages.value = galleryImages.value.slice(0, initialLoadCount);
    
    // Précharger les prochaines images
    preloadImages([initialLoadCount, initialLoadCount + 1, initialLoadCount + 2]);
    
    // Mettre en place l'observer après le rendu initial
    nextTick(() => {
      setupIntersectionObserver();
    });
  };
  
  // Cycle de vie du composant
  onMounted(() => {
    // Charger les premières images
    initialLoad();
  });
  
  onUnmounted(() => {
    // Nettoyer l'observer lorsque le composant est détruit
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
  
  /* Grille de la galerie */
  .gallerie-grid {
    display: grid;
    grid-template-columns: repeat(4, 1fr);
    gap: 8px; /* Espacement réduit entre les images */
  }
  
  .gallerie-item {
    position: relative;
    overflow: hidden;
    aspect-ratio: 1;
    opacity: 0; /* Commencer invisible pour l'animation */
    cursor: pointer; /* Indiquer que l'image est cliquable */
  }
  
  .gallerie-item:hover {
    transform: scale(1.02); /* Léger effet au survol */
    transition: transform 0.3s ease;
  }
  
  /* Animations d'apparition variées */
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
    /* Appliquer un traitement de performance à l'image */
    will-change: transform; /* Optimise les animations */
    backface-visibility: hidden; /* Réduit les problèmes de rendu */
  }
  
  /* Indicateur de chargement */
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
  
  /* Message de fin */
  .end-message {
    padding: 1rem 0;
  }
  
  .end-text {
    font-size: 0.9rem;
    color: #999;
    letter-spacing: 1px;
    font-style: italic;
  }
  
  /* Sentinel pour l'infinite scroll */
  .scroll-sentinel {
    position: absolute;
    bottom: 500px; /* Chargement plus anticipé */
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
  
  .lightbox-content img {
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
      grid-template-columns: repeat(2, 1fr); /* 2 par 2 sur mobile */
      gap: 4px; /* Espacement encore plus réduit sur mobile */
    }
    
    .section-title {
      font-size: 1.5rem;
    }
  }
  </style>
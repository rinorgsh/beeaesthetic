<template>
  <section class="hero-banner">
    <div class="overlay"></div>
    
    <!-- Slideshow d'images pour Desktop -->
    <div class="background-slideshow desktop-slideshow">
      <div v-for="(image, index) in desktopImages" 
           :key="'desktop-'+index" 
           class="slide-bg" 
           :class="{ active: currentDesktopSlide === index }"
           :style="{ backgroundImage: `url(${getOptimizedUrl(image, 'desktop')})` }">
      </div>
    </div>
    
    <!-- Slideshow d'images pour Mobile -->
    <div class="background-slideshow mobile-slideshow">
      <div v-for="(image, index) in mobileImages" 
           :key="'mobile-'+index" 
           class="slide-bg" 
           :class="{ active: currentMobileSlide === index }"
           :style="{ backgroundImage: `url(${getOptimizedUrl(image, 'mobile')})` }">
      </div>
    </div>
    
    <div class="hero-content">
      <h1 class="hero-title">BEE AESTHETIC</h1>
      <p class="hero-subtitle">{{ t.home.hero_subtitle }}</p>
      <a href="/rendez-vous" class="cta-button">{{ t.home.hero_button }}</a>
    </div>
  </section>
</template>

<script setup>
import { ref, onMounted, onBeforeUnmount } from 'vue';
import { useTranslation } from '@/composables/useTranslation';

const { t } = useTranslation();

// Configuration Cloudinary
const CLOUDINARY_CONFIG = {
  cloudName: 'dqljt4ans',
  baseUrl: 'https://res.cloudinary.com/dqljt4ans/image/upload'
};

// Images pour Desktop (public_ids Cloudinary)
const desktopImages = ref([
  'banner_epakca',
  'banner6_hvhrqp',
  'banner7_f07bhd',

  // Vous pouvez ajouter banner2_ipwpes si vous le souhaitez
]);

// Images pour Mobile
const mobileImages = ref([
  'banner_epakca',
  'banner6_hvhrqp',
  'banner7_f07bhd',
  'banner3_f85ria',
  'banner4_ljmqfd',
  'banner5_thgwzu',
  'banner2_ipwpes'
]);

// État pour le suivi des slides actives
const currentDesktopSlide = ref(0);
const currentMobileSlide = ref(0);
const desktopInterval = ref(null);
const mobileInterval = ref(null);
const slideInterval = 2200;

/**
 * Génère une URL Cloudinary optimisée avec transformations automatiques
 * @param {string} publicId - L'identifiant public de l'image sur Cloudinary
 * @param {string} deviceType - 'desktop' ou 'mobile'
 * @returns {string} URL optimisée
 */
function getOptimizedUrl(publicId, deviceType = 'desktop') {
  const transformations = deviceType === 'mobile'
    ? 'f_auto,q_auto:good,w_800,c_fill,g_auto,dpr_auto'   // Mobile: 800px, qualité optimisée
    : 'f_auto,q_auto:good,w_1920,c_fill,g_auto,dpr_auto'; // Desktop: 1920px, qualité optimisée
  
  // Construction de l'URL avec transformations
  return `${CLOUDINARY_CONFIG.baseUrl}/${transformations}/${publicId}`;
}

// Fonctions pour passer à l'image suivante
const nextDesktopSlide = () => {
  currentDesktopSlide.value = (currentDesktopSlide.value + 1) % desktopImages.value.length;
};

const nextMobileSlide = () => {
  currentMobileSlide.value = (currentMobileSlide.value + 1) % mobileImages.value.length;
};

// Fonction pour précharger les images critiques
function preloadImages() {
  // Précharger la première image de chaque slideshow
  const imagesToPreload = [
    getOptimizedUrl(desktopImages.value[0], 'desktop'),
    getOptimizedUrl(mobileImages.value[0], 'mobile'),
  ];
  
  imagesToPreload.forEach(src => {
    const img = new Image();
    img.src = src;
  });
}

// Démarrer les sliders au montage du composant
onMounted(() => {
  preloadImages();
  desktopInterval.value = setInterval(nextDesktopSlide, slideInterval);
  mobileInterval.value = setInterval(nextMobileSlide, slideInterval);
});

// Arrêter les sliders quand le composant est détruit
onBeforeUnmount(() => {
  if (desktopInterval.value) {
    clearInterval(desktopInterval.value);
  }
  if (mobileInterval.value) {
    clearInterval(mobileInterval.value);
  }
});
</script>

<style scoped>
.hero-banner {
  position: relative;
  width: 100%;
  height: 70vh;
  max-height: 700px;
  display: flex;
  justify-content: center;
  align-items: center;
  color: white;
  overflow: hidden;
}

.overlay {
  position: absolute;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background-color: rgba(0, 0, 0, 0.3);
  z-index: 2;
}

/* Styles pour les slideshows d'arrière-plan */
.background-slideshow {
  position: absolute;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
}

/* Affichage conditionnel basé sur la taille de l'écran */
.desktop-slideshow {
  display: block;
}

.mobile-slideshow {
  display: none;
}

.slide-bg {
  position: absolute;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background-size: cover;
  background-position: center;
  background-repeat: no-repeat;
  opacity: 0;
  transition: opacity 1.5s ease;
  background-color: #000;
  /* Optimisation du rendu */
  will-change: opacity;
  backface-visibility: hidden;
  -webkit-backface-visibility: hidden;
}

.slide-bg.active {
  opacity: 1;
}

.hero-content {
  position: relative;
  z-index: 3;
  text-align: center;
  padding: 0 20px;
  max-width: 800px;
  width: 100%;
}

.hero-title {
  font-family: 'Montserrat', 'Raleway', 'Helvetica Neue', sans-serif;
  font-size: 5rem;
  font-weight: 300;
  letter-spacing: 10px;
  text-transform: uppercase;
  margin-bottom: 1.5rem;
  line-height: 1.2;
  color: white;
  text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.3);
}

.hero-subtitle {
  font-family: 'Montserrat', 'Raleway', 'Helvetica Neue', sans-serif;
  font-size: 1.3rem;
  font-weight: 300;
  letter-spacing: 3px;
  opacity: 0.95;
  color: white;
  margin-bottom: 2rem;
  text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.3);
}

.cta-button {
  display: inline-block;
  padding: 15px 40px;
  background-color: #000;
  color: #fff;
  font-family: 'Montserrat', 'Raleway', 'Helvetica Neue', sans-serif;
  font-size: 1rem;
  font-weight: 500;
  text-transform: uppercase;
  letter-spacing: 2px;
  border-radius: 30px;
  transition: all 0.4s ease;
  text-decoration: none;
  margin-top: 3.5rem;
  position: relative;
  border: 2px solid #000;
  outline: none;
}

.cta-button:hover {
  background-color: transparent;
  color: #fff;
  transform: translateY(-3px);
  box-shadow: 0 10px 20px rgba(0,0,0,0.2);
}

.cta-button:active {
  transform: translateY(1px);
  box-shadow: 0 5px 10px rgba(0,0,0,0.3);
}

/* Responsive */
@media (min-width: 1600px) {
  .hero-banner {
    height: 60vh;
  }
}

@media (max-width: 1200px) {
  .hero-title {
    font-size: 4.5rem;
    letter-spacing: 8px;
  }
}

@media (max-width: 991px) {
  .hero-banner {
    height: 70vh;
  }
  
  .hero-title {
    font-size: 4rem;
    letter-spacing: 6px;
  }
  
  .hero-subtitle {
    font-size: 1.3rem;
    letter-spacing: 2px;
  }
}

@media (max-width: 767px) {
  /* Pour appareils mobiles, afficher le slideshow mobile et masquer celui desktop */
  .desktop-slideshow {
    display: none;
  }
  
  .mobile-slideshow {
    display: block;
  }
  
  .hero-banner {
    height: 60vh;
  }
  
  .hero-title {
    font-size: 3rem;
    letter-spacing: 4px;
  }
  
  .hero-subtitle {
    font-size: 1.1rem;
    letter-spacing: 1.5px;
    margin-bottom: 1.5rem;
  }
  
  .cta-button {
    padding: 10px 25px;
    font-size: 1rem;
    margin-top: 10rem;
  }
}

@media (max-width: 480px) {
  .hero-title {
    font-size: 2.5rem;
    letter-spacing: 3px;
  }
  
  .hero-subtitle {
    font-size: 1rem;
    letter-spacing: 1px;
  }
  
  .cta-button {
    padding: 8px 20px;
    font-size: 0.9rem;
  }
}
</style>
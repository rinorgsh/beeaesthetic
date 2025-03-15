<template>
  <section class="hero-banner">
    <div class="overlay"></div>
    
    <!-- Slideshow d'images pour Desktop -->
    <div class="background-slideshow desktop-slideshow">
      <div v-for="(image, index) in desktopImages" 
           :key="'desktop-'+index" 
           class="slide-bg" 
           :class="{ active: currentDesktopSlide === index }"
           :style="{ backgroundImage: `url(${image})` }">
      </div>
    </div>
    
    <!-- Slideshow d'images pour Mobile -->
    <div class="background-slideshow mobile-slideshow">
      <div v-for="(image, index) in mobileImages" 
           :key="'mobile-'+index" 
           class="slide-bg" 
           :class="{ active: currentMobileSlide === index }"
           :style="{ backgroundImage: `url(${image})` }">
      </div>
    </div>
    
    <div class="hero-content">
      <h1 class="hero-title">BEE AESTHETIC</h1>
      <p class="hero-subtitle">Your Nails, Your Signature</p>
      <a href="#" class="cta-button">Rendez-vous</a>
    </div>
  </section>
</template>

<script setup>
import { ref, onMounted, onBeforeUnmount } from 'vue';

// Images pour Desktop
const desktopImages = ref([
  'Images/banner.jpeg',
  'Images/banner6.jpeg',
  'Images/banner7.jpeg',
  'Images/banner9.jpeg',
]);

// Images pour Mobile (iPhone, etc.)
const mobileImages = ref([
  'Images/banner.jpeg',
  'Images/banner4.jpeg',
  'Images/banner5.jpeg',
  'Images/banner3.jpeg',
]);

// État pour le suivi des slides actives
const currentDesktopSlide = ref(0);
const currentMobileSlide = ref(0);
const desktopInterval = ref(null);
const mobileInterval = ref(null);
const slideInterval = 2200; // 5 secondes par image

// Fonctions pour passer à l'image suivante
const nextDesktopSlide = () => {
  currentDesktopSlide.value = (currentDesktopSlide.value + 1) % desktopImages.value.length;
};

const nextMobileSlide = () => {
  currentMobileSlide.value = (currentMobileSlide.value + 1) % mobileImages.value.length;
};

// Fonction pour précharger les images pour de meilleures performances
function preloadImages() {
  // Précharger uniquement les deux premières images de chaque set
  const imagesToPreload = [
    desktopImages.value[0],
    desktopImages.value[1],
    mobileImages.value[0],
    mobileImages.value[1]
  ];
  
  imagesToPreload.forEach(src => {
    const img = new Image();
    img.src = src;
  });
}

// Démarrer les sliders au montage du composant
onMounted(() => {
  // Précharger les images principales
  preloadImages();
  
  // Démarrer les intervalles de défilement
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
  display: block; /* Par défaut visible pour desktop */
}

.mobile-slideshow {
  display: none; /* Par défaut caché pour desktop */
}

.slide-bg {
  position: absolute;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background-size: 100% auto;
  background-position: center;
  background-repeat: no-repeat;
  opacity: 0;
  transition: opacity 1.5s ease;
  background-color: #000;
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
}

.hero-subtitle {
  font-family: 'Montserrat', 'Raleway', 'Helvetica Neue', sans-serif;
  font-size: 1.3rem;
  font-weight: 300;
  letter-spacing: 3px;
  opacity: 0.95;
  color: white;
  margin-bottom: 2rem;
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
    margin-top: 10rem; /* Augmentation supplémentaire de la marge pour mobile */
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
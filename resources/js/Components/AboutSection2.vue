<template>
    <section class="about-section py-5">
      <div class="container-fluid px-4">
        <div class="row align-items-center">
          <!-- Texte à gauche -->
          <div class="col-lg-6 about-text">
            <h1 class="about-title mb-4">Qui sommes-nous ?</h1>
            <p class="about-description">
              Chez Bee Aesthetic, nous sommes passionnés par l'art et la 
              beauté des ongles. Avec plus de 4 ans d'expérience, nous 
              nous engageons à offrir des services haut de gamme, alliant 
              soin, élégance et expertise. Spécialistes du BIAB et des 
              formations professionnelles, notre mission est de sublimer 
              vos mains tout en préservant la santé de vos ongles. Chaque 
              détail compte, car pour nous, votre satisfaction est notre 
              priorité.
            </p>
          </div>
          
          <!-- Slider d'images avec forme organique -->
          <div class="col-lg-6 about-image-container">
            <div class="pear-shape-wrapper">
              <div class="pear-shape">
                <div class="image-slider">
                  <div class="slider-container" ref="sliderContainer">
                    <div v-for="(image, index) in images" :key="index" 
                         class="slide" 
                         :class="{ active: currentSlide === index }">
                      <img :src="image" alt="Soins des ongles professionnels" class="img-fluid">
                    </div>
                  </div>
                  <!-- Indicateurs (optionnels) -->
                  <div class="slider-indicators">
                    <span v-for="(image, index) in images" :key="'indicator-'+index"
                          class="indicator"
                          :class="{ active: currentSlide === index }"
                          @click="setSlide(index)"></span>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </template>
  
  <script setup>
  import { ref, onMounted, onBeforeUnmount } from 'vue';
  
  // Liste des images pour le slider
  const images = ref([
    'Images/ongle.jpeg',
    'Images/ongle2.jpeg',
    'Images/ongle3.jpeg',
    'Images/ongle4.jpeg'
  ]);
  
  const currentSlide = ref(0);
  const sliderInterval = ref(null);
  const slideInterval = 2000; // Temps d'affichage de chaque image en millisecondes (2 secondes)
  
  // Fonction pour passer à l'image suivante
  const nextSlide = () => {
    currentSlide.value = (currentSlide.value + 1) % images.value.length;
  };
  
  // Fonction pour définir une image spécifique
  const setSlide = (index) => {
    currentSlide.value = index;
    // Redémarrer le timer lors d'un clic manuel
    resetInterval();
  };
  
  // Fonction pour réinitialiser l'intervalle
  const resetInterval = () => {
    if (sliderInterval.value) {
      clearInterval(sliderInterval.value);
    }
    sliderInterval.value = setInterval(nextSlide, slideInterval);
  };
  
  // Démarrer le slider au montage du composant
  onMounted(() => {
    resetInterval();
  });
  
  // Arrêter le slider quand le composant est détruit
  onBeforeUnmount(() => {
    if (sliderInterval.value) {
      clearInterval(sliderInterval.value);
    }
  });
  </script>
  
  <style scoped>
  .about-section {
    background-color: #f8f8f8;
    font-family: 'Montserrat', 'Raleway', 'Helvetica Neue', sans-serif;
    font-weight: 300;
    color: #333;
    padding: 3rem 0;
  }
  
  .about-title {
    font-size: 3rem;
    font-weight: 300;
    color: #555;
    letter-spacing: 1px;
    margin-bottom: 2rem;
  }
  
  .about-description {
    font-size: 1rem;
    line-height: 1.8;
    letter-spacing: 0.3px;
    max-width: 90%;
  }
  
  .about-image-container {
    display: flex;
    justify-content: center;
    align-items: center;
  }
  
  .pear-shape-wrapper {
    width: 100%;
    max-width: 450px;
    position: relative;
  }
  
  .pear-shape {
  position: relative;
  width: 100%;
  height: 0;
  padding-bottom: 110%;
  overflow: hidden;
  border-radius: 60% 40% 40% 60% / 40% 50% 50% 60%;
  box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
  transform: rotate(-8deg);
}
  
  /* Styles pour le slider */
  .image-slider {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    overflow: hidden;
  }
  
  .slider-container {
    position: relative;
    width: 100%;
    height: 100%;
  }
  
  .slide {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    opacity: 0;
    transition: opacity 0.8s ease;
  }
  
  .slide.active {
    opacity: 1;
  }
  
  .slide img {
    width: 100%;
    height: 100%;
    object-fit: cover;
  }
  
  /* Indicateurs de slide (petits points en bas) */
  .slider-indicators {
    position: absolute;
    bottom: 20px;
    left: 50%;
    transform: translateX(-50%);
    display: flex;
    gap: 8px;
    z-index: 10;
  }
  
  .indicator {
    width: 8px;
    height: 8px;
    border-radius: 50%;
    background-color: rgba(255, 255, 255, 0.6);
    cursor: pointer;
    transition: all 0.3s ease;
  }
  
  .indicator.active {
    background-color: white;
    transform: scale(1.2);
  }
  
  /* Responsive */
  @media (max-width: 991px) {
    .about-title {
      font-size: 2.5rem;
      margin-bottom: 1.5rem;
    }
    
    .about-description {
      max-width: 100%;
      margin-bottom: 2rem;
    }
    
    .about-text {
      order: 2;
      padding-top: 2rem;
    }
    
    .about-image-container {
      order: 1;
    }
    
    .pear-shape-wrapper {
      max-width: 350px;
    }
  }
  
  @media (max-width: 767px) {
    .about-title {
      font-size: 2rem;
      margin-bottom: 1rem;
    }
    
    .about-section {
      padding: 2rem 0;
    }
    
    .pear-shape-wrapper {
      max-width: 280px;
    }
  }
  </style>
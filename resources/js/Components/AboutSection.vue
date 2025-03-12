<template>
  <section class="about-section py-5">
    <div class="container">
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
]);

const currentSlide = ref(0);
const sliderInterval = ref(null);
const slideInterval = 3000; // Temps d'affichage de chaque image en millisecondes

// Fonction pour passer à l'image suivante
const nextSlide = () => {
  currentSlide.value = (currentSlide.value + 1) % images.value.length;
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
  padding: 4rem 2rem;
  background-color: #f8f8f8;
  font-family: 'Montserrat', 'Raleway', 'Helvetica Neue', sans-serif;
  font-weight: 300;
  color: #333;
}

.container {
  max-width: 1200px;
  margin: 0 auto;
}

.about-text {
  padding-right: 2rem;
}

.about-title {
  font-size: 3rem;
  font-weight: 300;
  color: #555;
  letter-spacing: 1px;
  margin-bottom: 2rem;
  line-height: 1.2;
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
  margin: 0 auto;
}

.pear-shape {
  position: relative;
  width: 100%;
  height: 0;
  padding-bottom: 125%;
  overflow: hidden;
  border-radius: 55% 45% 60% 40% / 35% 45% 55% 65%;
  box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
  transform: rotate(-2deg);
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
  transition: opacity 1.5s ease;
}

.slide.active {
  opacity: 1;
}

.slide img {
  width: 100%;
  height: 100%;
  object-fit: cover;
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
    padding-right: 0;
    padding-top: 2rem;
    text-align: center;
  }
  
  .about-image-container {
    order: 1;
  }
  
  .pear-shape-wrapper {
    max-width: 350px;
  }
  
  .about-description {
    margin-left: auto;
    margin-right: auto;
  }
}

@media (max-width: 767px) {
  .about-section {
    padding: 2.5rem 1rem;
  }
  
  .about-title {
    font-size: 2rem;
    margin-bottom: 1rem;
  }
  
  .pear-shape-wrapper {
    max-width: 280px;
  }
}
</style>
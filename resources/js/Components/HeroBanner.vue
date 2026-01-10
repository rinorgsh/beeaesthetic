<template>
  <section class="hero-banner">
    <div class="overlay"></div>

    <!-- Image de fond unique -->
    <picture>
      <source srcset="/Images/magasin2.webp" type="image/webp">
      <img
        src="/Images/magasin2.jpg"
        alt="Bee Aesthetic Salon"
        class="background-image"
        fetchpriority="high"
        loading="eager"
        width="1920"
        height="1080"
      >
    </picture>

    <div class="hero-content">
      <!-- Logo -->
      <img src="/Images/logo-white.png" alt="Bee Aesthetic Logo" class="hero-logo">

      <!-- Slogan en anglais -->
      <p class="hero-slogan">everything you need, all in one place</p>

      <!-- Bouton CTA -->
      <a href="/rendez-vous" class="cta-button">{{ t.home.hero_button }}</a>
    </div>
  </section>
</template>

<script setup>
import { useTranslation } from '@/composables/useTranslation';

const { t } = useTranslation();
</script>

<style scoped>
/* Import des polices Google Fonts - Test Noto Serif Display */
@import url('https://fonts.googleapis.com/css2?family=Noto+Serif+Display:wght@300;400;500;600;700&family=Cormorant+Garamond:wght@300;400;500&display=swap');

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
  background-color: rgba(0, 0, 0, 0.45);
  z-index: 2;
}

/* Image de fond unique */
.background-image {
  position: absolute;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  object-fit: cover;
  object-position: center;
  z-index: 1;
}

.hero-content {
  position: relative;
  z-index: 3;
  text-align: center;
  padding: 0 20px;
  max-width: 1000px;
  width: 100%;
  display: flex;
  flex-direction: column;
  align-items: center;
  justify-content: center;
  gap: 0.5rem;
}

/* Logo - Beaucoup plus grand et centré */
.hero-logo {
  width: 300px;
  height: auto;
  margin-bottom: 1.5rem;
  filter: drop-shadow(3px 3px 6px rgba(0, 0, 0, 0.4));
}

/* Slogan - Toujours en anglais */
.hero-slogan {
  font-family: 'Montserrat', 'Raleway', 'Helvetica Neue', sans-serif;
  font-size: 1.4rem;
  font-weight: 300;
  letter-spacing: 2px;
  text-transform: lowercase;
  color: white;
  margin-bottom: 2.5rem;
  text-shadow: 2px 2px 6px rgba(0, 0, 0, 0.5);
  font-style: italic;
}

/* Sous-titre - Même style que le bouton (Montserrat) */
.hero-subtitle {
  font-family: 'Montserrat', 'Raleway', 'Helvetica Neue', sans-serif;
  font-size: 1rem;
  font-weight: 400;
  letter-spacing: 1px;
  text-transform: uppercase;
  color: white;
  margin-bottom: 2.5rem;
  text-shadow: 2px 2px 6px rgba(0, 0, 0, 0.5);
  line-height: 1.6;
}

/* Bouton CTA - Plus grand */
.cta-button {
  display: inline-block;
  padding: 16px 50px;
  background-color: #e6cfc2;
  color: #333;
  font-size: 1rem;
  font-weight: 400;
  text-transform: uppercase;
  letter-spacing: 1px;
  border-radius: 30px;
  transition: all 0.3s;
  text-decoration: none;
  margin-top: 1.5rem;
  border: none;
}

.cta-button:hover {
  background-color: #dbbcab;
  transform: translateY(-1px);
  box-shadow: 0 2px 5px rgba(230, 207, 194, 0.3);
}

/* Responsive */
@media (min-width: 1600px) {
  .hero-banner {
    height: 60vh;
  }

  .hero-logo {
    width: 350px;
  }
}

@media (max-width: 1200px) {
  .hero-subtitle {
    font-size: 0.95rem;
  }

  .hero-logo {
    width: 260px;
  }
}

@media (max-width: 991px) {
  .hero-banner {
    height: 70vh;
  }

  .hero-slogan {
    font-size: 1.2rem;
  }

  .hero-subtitle {
    font-size: 0.9rem;
  }

  .hero-logo {
    width: 220px;
    margin-bottom: 1.2rem;
  }

  .cta-button {
    padding: 14px 45px;
    font-size: 0.95rem;
  }
}

@media (max-width: 767px) {
  .hero-banner {
    height: 60vh;
  }

  .hero-slogan {
    font-size: 1.1rem;
    margin-bottom: 2rem;
  }

  .hero-subtitle {
    font-size: 0.85rem;
    margin-bottom: 2rem;
  }

  .hero-logo {
    width: 180px;
    margin-bottom: 1rem;
  }

  .cta-button {
    padding: 12px 35px;
    font-size: 0.9rem;
    margin-top: 1rem;
  }
}

@media (max-width: 480px) {
  .hero-slogan {
    font-size: 0.95rem;
  }

  .hero-subtitle {
    font-size: 0.75rem;
  }

  .hero-logo {
    width: 140px;
  }

  .cta-button {
    padding: 10px 30px;
    font-size: 0.85rem;
  }
}
</style>

<template>
  <div>
    <TopNav />

    <!-- Hero Section -->
    <section class="services-hero">
      <div class="container">
        <h1 class="hero-title">{{ t.services.hero_title }}</h1>
        <p class="hero-subtitle">{{ t.services.hero_subtitle }}</p>
      </div>
    </section>

    <Manicure />

    <Footer />
  </div>
</template>

<script setup>
import TopNav from '@/Components/TopNav.vue';
import Footer from '@/Components/Footer.vue';
import Manicure from '@/Components/Manicure.vue';
import { useTranslation } from '@/composables/useTranslation';

const { t } = useTranslation();
</script>

<style scoped>
/* Hero Section */
.services-hero {
  padding: 4rem 0 2.5rem;
  background-color: #593625;
  font-family: 'Montserrat', 'Raleway', 'Helvetica Neue', sans-serif;
  text-align: center;
}

.container {
  max-width: 1200px;
  margin: 0 auto;
  padding: 0 2rem;
}

.hero-title {
  font-size: 3rem;
  font-weight: 300;
  color: white;
  letter-spacing: 1px;
  margin-bottom: 0.8rem;
}

.hero-subtitle {
  font-size: 1rem;
  font-weight: 300;
  color: white;
  line-height: 1.8;
  max-width: 600px;
  margin: 0 auto;
}

/* Responsive */
@media (max-width: 767px) {
  .services-hero {
    padding: 3rem 0 2rem;
  }

  .hero-title {
    font-size: 2.2rem;
  }

  .hero-subtitle {
    font-size: 0.95rem;
  }
}
</style>

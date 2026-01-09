<template>
  <section class="services-section">
    <!-- Liste des services avec descriptions -->
    <div class="services-container">

      <!-- BIAB -->
      <div class="service-item">
        <h3 class="service-title">{{ t.services.biab_desc_title }}</h3>
        <p class="service-text">{{ t.services.biab_desc_text }}</p>
      </div>

      <!-- Manicure/Pédicure Japonaise -->
      <div class="service-item">
        <h3 class="service-title">{{ t.services.japanese_desc_title }}</h3>
        <p class="service-text">{{ t.services.japanese_desc_text }}</p>
      </div>

      <!-- Pédicure -->
      <div class="service-item">
        <h3 class="service-title">{{ t.services.pedicure_desc_title }}</h3>
        <p class="service-text">{{ t.services.pedicure_desc_intro }}</p>
        <ul class="service-list">
          <li>{{ t.services.pedicure_essential }}</li>
          <li>{{ t.services.pedicure_deep }}</li>
          <li>{{ t.services.pedicure_luxe }}</li>
        </ul>
      </div>

      <!-- Brow Lift -->
      <div class="service-item">
        <h3 class="service-title">{{ t.services.browlift_desc_title }}</h3>
        <p class="service-text">{{ t.services.browlift_desc_text }}</p>
      </div>

      <!-- Lash Lift -->
      <div class="service-item">
        <h3 class="service-title">{{ t.services.lashlift_desc_title }}</h3>
        <p class="service-text">{{ t.services.lashlift_desc_text }}</p>
      </div>

      <!-- Épilation Laser -->
      <div class="service-item">
        <h3 class="service-title">{{ t.services.laser_desc_title }}</h3>
        <p class="service-text">{{ t.services.laser_desc_text }}</p>
      </div>

      <!-- Épilation à la Cire -->
      <div class="service-item">
        <h3 class="service-title">{{ t.services.waxing_desc_title }}</h3>
        <p class="service-text">{{ t.services.waxing_desc_text }}</p>
      </div>

      <!-- Soins Visage -->
      <div class="service-item">
        <h3 class="service-title">{{ t.services.facial_desc_title }}</h3>
        <p class="service-text">{{ t.services.facial_desc_text }}</p>
      </div>

    </div>
  </section>
</template>

<script setup>
import { useTranslation } from '@/composables/useTranslation'

const { t } = useTranslation()
</script>

<style scoped>
.services-section {
  padding: 3rem 0 5rem;
  background-color: #f8f8f8;
  font-family: 'Montserrat', 'Raleway', 'Helvetica Neue', sans-serif;
}

.services-container {
  max-width: 900px;
  margin: 0 auto;
  padding: 0 2rem;
}

.service-item {
  margin-bottom: 4rem;
  padding-bottom: 3rem;
  border-bottom: 1px solid #e6cfc2;
}

.service-item:last-child {
  border-bottom: none;
  margin-bottom: 0;
  padding-bottom: 0;
}

.service-title {
  font-size: 1.8rem;
  font-weight: 400;
  color: #b3a090;
  margin-bottom: 1.5rem;
  letter-spacing: 1px;
}

.service-text {
  font-size: 1.05rem;
  line-height: 1.9;
  color: #555;
  font-weight: 300;
  text-align: justify;
  margin-bottom: 1rem;
}

.service-list {
  list-style: none;
  padding: 0;
  margin: 1.5rem 0 0 0;
}

.service-list li {
  font-size: 1.05rem;
  line-height: 1.9;
  color: #555;
  font-weight: 300;
  margin-bottom: 1rem;
  padding-left: 1.5rem;
  position: relative;
}

.service-list li:before {
  content: "•";
  position: absolute;
  left: 0;
  color: #b3a090;
  font-weight: 600;
  font-size: 1.3rem;
}

/* Responsive */
@media (max-width: 991px) {
  .services-section {
    padding: 4rem 0;
  }

  .section-title {
    font-size: 2.2rem;
  }

  .services-container {
    padding: 0 1.5rem;
  }

  .service-title {
    font-size: 1.6rem;
  }

  .service-text,
  .service-list li {
    font-size: 1rem;
  }
}

@media (max-width: 767px) {
  .services-section {
    padding: 3rem 0;
  }

  .section-header {
    margin-bottom: 3rem;
  }

  .section-title {
    font-size: 1.8rem;
    letter-spacing: 2px;
  }

  .services-container {
    padding: 0 1rem;
  }

  .service-item {
    margin-bottom: 3rem;
    padding-bottom: 2rem;
  }

  .service-title {
    font-size: 1.4rem;
    margin-bottom: 1rem;
  }

  .service-text,
  .service-list li {
    font-size: 0.95rem;
    line-height: 1.8;
    text-align: left;
  }
}

@media (max-width: 480px) {
  .section-title {
    font-size: 1.5rem;
  }

  .service-title {
    font-size: 1.3rem;
  }

  .service-text,
  .service-list li {
    font-size: 0.9rem;
  }
}
</style>

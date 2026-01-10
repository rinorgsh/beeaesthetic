<template>
  <section class="services-section">
    <div class="container">
      <div class="section-header">
        <h2 class="section-title">{{ t.services.section_title }}</h2>
        <div class="separator"><span></span></div>
      </div>

      <div class="services-grid">
        <!-- Service 1: Manucure/BIAB -->
        <div class="service-card">
          <div class="service-image-wrapper">
            <div class="service-image">
              <img src="/Images/manicure.jpeg" :alt="t.services.manicure_title">
            </div>
          </div>
          <div class="service-content">
            <h3 class="service-title">{{ t.services.manicure_title }}</h3>
            <p class="service-description">{{ t.services.manicure_desc }}</p>
            <a href="/services" class="service-link">{{ t.services.discover }}</a>
          </div>
        </div>

        <!-- Service 2: Cils & Sourcils -->
        <div class="service-card">
          <div class="service-image-wrapper">
            <div class="service-image">
              <img src="/Images/cils.jpg" :alt="t.services.lashes_title">
            </div>
          </div>
          <div class="service-content">
            <h3 class="service-title">{{ t.services.lashes_title }}</h3>
            <p class="service-description">{{ t.services.lashes_desc }}</p>
            <a href="/services" class="service-link">{{ t.services.discover }}</a>
          </div>
        </div>

        <!-- Service 3: Laser -->
        <div class="service-card">
          <div class="service-image-wrapper">
            <div class="service-image">
              <img src="/Images/laser.jpeg" :alt="t.services.laser_title">
            </div>
          </div>
          <div class="service-content">
            <h3 class="service-title">{{ t.services.laser_title }}</h3>
            <p class="service-description">{{ t.services.laser_desc }}</p>
            <a href="/services" class="service-link">{{ t.services.discover }}</a>
          </div>
        </div>

        <!-- Service 4: Épilation -->
        <div class="service-card">
          <div class="service-image-wrapper">
            <div class="service-image">
              <img src="/Images/epi.jpg" :alt="t.services.waxing_title">
            </div>
          </div>
          <div class="service-content">
            <h3 class="service-title">{{ t.services.waxing_title }}</h3>
            <p class="service-description">{{ t.services.waxing_desc }}</p>
            <a href="/services" class="service-link">{{ t.services.discover }}</a>
          </div>
        </div>

        <!-- Service 5: Soins du Visage -->
        <div class="service-card">
          <div class="service-image-wrapper">
            <div class="service-image">
              <img src="/Images/soin.jpg" :alt="t.services.facial_title">
            </div>
          </div>
          <div class="service-content">
            <h3 class="service-title">{{ t.services.facial_title }}</h3>
            <p class="service-description">{{ t.services.facial_desc }}</p>
            <a href="/services" class="service-link">{{ t.services.discover }}</a>
          </div>
        </div>
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
  padding: 6rem 0;
  background-color: #fff;
  font-family: 'Montserrat', 'Raleway', 'Helvetica Neue', sans-serif;
}

.container {
  max-width: 1200px;
  margin: 0 auto;
  padding: 0 2rem;
}

.section-header {
  text-align: center;
  margin-bottom: 5rem;
}

.section-title {
  font-size: 2.5rem;
  font-weight: 300;
  text-transform: uppercase;
  letter-spacing: 3px;
  color: #333;
  margin-bottom: 1rem;
}

.separator {
  display: flex;
  justify-content: center;
  align-items: center;
  margin: 1.5rem 0;
}

.separator span {
  display: block;
  width: 60px;
  height: 1px;
  background-color: #b3a090;
}

.services-grid {
  display: grid;
  grid-template-columns: repeat(2, 1fr);
  gap: 4rem 3rem;
  max-width: 1000px;
  margin: 0 auto;
}

.service-card {
  display: flex;
  flex-direction: column;
  align-items: center;
  text-align: center;
}

/* Image en forme de poire/goutte élégante */
.service-image-wrapper {
  width: 280px;
  height: 320px;
  margin-bottom: 2rem;
  position: relative;
}

.service-image {
  width: 100%;
  height: 100%;
  border-radius: 50% 50% 50% 50% / 60% 60% 40% 40%;
  overflow: hidden;
  box-shadow: 0 10px 40px rgba(0, 0, 0, 0.12);
  transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
  position: relative;
}

.service-image::after {
  content: '';
  position: absolute;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background: linear-gradient(180deg, transparent 0%, rgba(0, 0, 0, 0.1) 100%);
  opacity: 0;
  transition: opacity 0.4s ease;
}

.service-card:hover .service-image {
  transform: translateY(-8px);
  box-shadow: 0 20px 50px rgba(179, 160, 144, 0.3);
  border-radius: 50% 50% 50% 50% / 55% 55% 45% 45%;
}

.service-card:hover .service-image::after {
  opacity: 1;
}

.service-image img {
  width: 100%;
  height: 100%;
  object-fit: cover;
  transition: transform 0.6s cubic-bezier(0.4, 0, 0.2, 1);
}

.service-card:hover .service-image img {
  transform: scale(1.08);
}

.service-content {
  display: flex;
  flex-direction: column;
  align-items: center;
  flex: 1;
}

.service-title {
  font-size: 1.5rem;
  font-weight: 400;
  color: #333;
  margin-bottom: 1rem;
  letter-spacing: 0.5px;
}

.service-description {
  font-size: 0.95rem;
  line-height: 1.7;
  color: #666;
  margin-bottom: 1.8rem;
  max-width: 320px;
  flex-grow: 1;
}

.service-link {
  display: inline-block;
  padding: 12px 40px;
  background-color: #593625;
  color: white;
  text-decoration: none;
  border-radius: 30px;
  font-size: 0.85rem;
  font-weight: 400;
  letter-spacing: 1px;
  text-transform: uppercase;
  transition: all 0.3s;
}

.service-link:hover {
  background-color: #442a1d;
  transform: translateY(-2px);
  box-shadow: 0 4px 12px rgba(89, 54, 37, 0.4);
}

/* Responsive */
@media (max-width: 991px) {
  .services-section {
    padding: 4rem 0;
  }

  .section-header {
    margin-bottom: 4rem;
  }

  .section-title {
    font-size: 2.2rem;
  }

  .services-grid {
    gap: 3.5rem 2.5rem;
  }

  .service-image-wrapper {
    width: 240px;
    height: 280px;
  }

  .service-title {
    font-size: 1.3rem;
  }

  .service-description {
    font-size: 0.9rem;
  }
}

@media (max-width: 767px) {
  .services-section {
    padding: 3rem 0;
  }

  .container {
    padding: 0 1rem;
  }

  .section-header {
    margin-bottom: 3rem;
  }

  .section-title {
    font-size: 1.8rem;
    letter-spacing: 2px;
  }

  .services-grid {
    gap: 3rem 1.5rem;
  }

  .service-image-wrapper {
    width: 100%;
    max-width: 200px;
    height: 240px;
  }

  .service-title {
    font-size: 1.2rem;
  }

  .service-description {
    font-size: 0.85rem;
    max-width: 100%;
    line-height: 1.6;
  }

  .service-link {
    font-size: 0.75rem;
    padding: 10px 30px;
  }
}

@media (max-width: 480px) {
  .section-title {
    font-size: 1.5rem;
  }

  .services-grid {
    gap: 2.5rem 1rem;
  }

  .service-image-wrapper {
    max-width: 160px;
    height: 200px;
  }

  .service-title {
    font-size: 1.1rem;
  }

  .service-description {
    font-size: 0.8rem;
  }

  .service-link {
    font-size: 0.7rem;
    padding: 8px 25px;
  }
}
</style>

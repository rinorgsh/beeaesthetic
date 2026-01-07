<template>
  <section class="services-section">
    <!-- Titre de la section -->
    <div class="section-title-container">
      <h2 class="section-title">{{ t.services.title }}</h2>
    </div>
    
    <!-- Contenu des services -->
    <div class="services-container">
      <div class="row">
        <!-- Manucure, Pédicure & BIAB -->
        <div class="col-lg-6 col-md-6 service-col">
          <div class="service-content">
            <div class="service-image">
              <img src="Images/service2.jpeg" :alt="t.services.manicure_title" class="img-fluid">
            </div>
            <h3 class="service-title">{{ t.services.manicure_title }}</h3>
            <p class="service-description">
              {{ t.services.manicure_desc }}
            </p>
            <div class="service-btn-container">
              <a href="/services" class="service-btn">{{ t.services.discover }}</a>
            </div>
          </div>
        </div>
        
        <!-- Cils & Sourcils -->
        <div class="col-lg-6 col-md-6 service-col">
          <div class="service-content">
            <div class="service-image service-image-alt">
              <img src="Images/cils.jpg" :alt="t.services.lashes_title" class="img-fluid">
            </div>
            <h3 class="service-title">{{ t.services.lashes_title }}</h3>
            <p class="service-description">
              {{ t.services.lashes_desc }}
            </p>
            <div class="service-btn-container">
              <a href="/services" class="service-btn">{{ t.services.discover }}</a>
            </div>
          </div>
        </div>

        <!-- Épilation -->
        <div class="col-lg-6 col-md-6 service-col">
          <div class="service-content">
            <div class="service-image">
              <img src="Images/epi.jpg" :alt="t.services.waxing_title" class="img-fluid">
            </div>
            <h3 class="service-title">{{ t.services.waxing_title }}</h3>
            <p class="service-description">
              {{ t.services.waxing_desc }}
            </p>
            <div class="service-btn-container">
              <a href="/services" class="service-btn">{{ t.services.discover }}</a>
            </div>
          </div>
        </div>

        <!-- Soins du Visage -->
        <div class="col-lg-6 col-md-6 service-col">
          <div class="service-content">
            <div class="service-image service-image-alt">
              <img src="Images/soin.jpg" :alt="t.services.facial_title" class="img-fluid">
            </div>
            <h3 class="service-title">{{ t.services.facial_title }}</h3>
            <p class="service-description">
              {{ t.services.facial_desc }}
            </p>
            <div class="service-btn-container">
              <a href="/services" class="service-btn">{{ t.services.discover }}</a>
            </div>
          </div>
        </div>
        
        <!-- Formation -->
        <div class="col-lg-12 service-col service-col-full">
          <div class="service-content service-content-horizontal">
            <div class="service-image-horizontal">
              <img src="Images/service.jpeg" :alt="t.services.training_title" class="img-fluid">
            </div>
            <div class="service-text-horizontal">
              <h3 class="service-title">{{ t.services.training_title }}</h3>
              <p class="service-description">
                {{ t.services.training_desc }}
              </p>
              <div class="service-btn-container">
                <a href="/formation" class="service-btn">{{ t.services.learn_more }}</a>
              </div>
            </div>
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
  padding: 3rem 0 5rem;
  background-color: #f8f8f8;
  font-family: 'Montserrat', 'Raleway', 'Helvetica Neue', sans-serif;
}

.section-title-container {
  padding: 1rem 2rem 3rem;
}

.section-title {
  font-size: 3rem;
  font-weight: 300;
  color: #555;
  letter-spacing: 1px;
  margin-left: 2rem;
}

.services-container {
  max-width: 1200px;
  margin: 0 auto;
  padding: 0 1rem;
}

.service-col {
  padding: 1rem 2rem;
  margin-bottom: 2rem;
}

.service-col-full {
  margin-top: 2rem;
}

.service-content {
  display: flex;
  flex-direction: column;
  height: 100%;
}

/* Service horizontal (Formation) */
.service-content-horizontal {
  flex-direction: row;
  align-items: center;
  gap: 3rem;
  padding: 3rem;
  background: transparent;     
  padding: 3rem 0;
}

.service-image-horizontal {
  flex: 0 0 300px;
  position: relative;
  width: 300px;
  height: 300px;
  border-radius: 50%;
  overflow: hidden;
}

.service-image-horizontal img {
  width: 100%;
  height: 100%;
  object-fit: cover;
  transition: transform 0.5s ease;
}

.service-image-horizontal:hover img {
  transform: scale(1.05);
}

.service-text-horizontal {
  flex: 1;
}

/* Images des services réguliers */
.service-image {
  margin-bottom: 2rem;
  overflow: hidden;
  position: relative;
  width: 100%;
  padding-top: 100%;
  border-radius: 70% 30% 30% 70% / 40% 50% 50% 60%;
}

.service-image-alt {
  border-radius: 40% 60% 60% 40% / 50% 40% 60% 50%;
}

.service-image img {
  position: absolute;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  object-fit: cover;
  transition: transform 0.5s ease;
}

.service-image:hover img {
  transform: scale(1.03);
}

.service-title {
  font-size: 1.8rem;
  font-weight: 300;
  color: #b3a090;
  margin-bottom: 1.5rem;
  letter-spacing: 0.5px;
}

.service-description {
  font-size: 1rem;
  line-height: 1.8;
  color: #555;
  margin-bottom: 2rem;
  flex-grow: 1;
}

.service-btn-container {
  margin-top: auto;
}

.service-btn {
  display: inline-block;
  padding: 0.8rem 2rem;
  border: 1px solid #999;
  border-radius: 50px;
  color: #555;
  text-decoration: none;
  font-size: 0.9rem;
  letter-spacing: 0.5px;
  transition: all 0.3s ease;
}

.service-btn:hover {
  background-color: rgba(0, 0, 0, 0.05);
  transform: translateY(-2px);
}

/* Limite la taille maximale des images sur desktop */
@media (min-width: 992px) {
  .service-image {
    max-width: 320px;
    padding-top: 320px;
    margin-left: auto;
    margin-right: auto;
  }
}

/* Tablettes */
@media (min-width: 768px) and (max-width: 991px) {
  .service-image {
    max-width: 280px;
    padding-top: 280px;
    margin-left: auto;
    margin-right: auto;
  }

  .service-content-horizontal {
    flex-direction: column;
    gap: 2rem;
    text-align: center;
  }

  .service-image-horizontal {
    flex: 0 0 250px;
    width: 250px;
    height: 250px;
  }
}

@media (max-width: 991px) {
  .section-title {
    font-size: 2.5rem;
    margin-left: 1rem;
  }
  
  .service-col {
    padding: 1rem;
  }
}

@media (max-width: 767px) {
  .section-title-container {
    padding: 1rem 1rem 2rem;
  }
  
  .section-title {
    font-size: 2rem;
    margin-left: 0.5rem;
  }
  
  .service-title {
    font-size: 1.5rem;
  }
  
  .service-btn {
    width: 100%;
    text-align: center;
  }

  .service-content-horizontal {
    flex-direction: column;
    padding: 2rem 1.5rem;
    gap: 2rem;
    text-align: center;
  }

  .service-image-horizontal {
    flex: 0 0 200px;
    width: 200px;
    height: 200px;
    margin: 0 auto;
  }

  .service-image {
    max-width: 280px;
    padding-top: 280px;
    margin-left: auto;
    margin-right: auto;
  }
}

@media (max-width: 480px) {
  .service-image {
    max-width: 250px;
    padding-top: 250px;
  }

  .service-content-horizontal {
    padding: 1.5rem 1rem;
  }

  .service-image-horizontal {
    flex: 0 0 180px;
    width: 180px;
    height: 180px;
  }
}
</style>
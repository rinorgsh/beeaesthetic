<template>
  <section class="services-section">
    <!-- Hero Section -->
    <div class="services-hero">
      <h1 class="hero-title">{{ t.services.hero_title }}</h1>
      <p class="hero-subtitle">{{ t.services.hero_subtitle }}</p>
    </div>

    <!-- Navigation par catégories -->
    <div class="categories-nav">
      <button 
        v-for="category in categories" 
        :key="category.id"
        @click="activeCategory = category.id"
        :class="['category-btn', { active: activeCategory === category.id }]"
      >
        {{ category.name }}
      </button>
    </div>

    <!-- Pédicure -->
    <div v-show="activeCategory === 'pedicure'" class="category-section">
      <div class="category-header">
        <h2 class="category-title">{{ t.services.pedicure_title }}</h2>
        <p class="category-intro">{{ t.services.pedicure_intro }}</p>
      </div>

      <div class="services-list">
        <div class="service-row" v-for="(service, index) in pedicureServices" :key="index">
          <div class="service-info">
            <h3 class="service-name">{{ service.name }}</h3>
            <p class="service-duration">{{ service.duration }}</p>
          </div>
          <div class="service-pricing">
            <span class="service-price">{{ service.price }}</span>
            <a href="/rendez-vous" class="service-btn-small">{{ t.services.book_button }}</a>
          </div>
        </div>
      </div>
    </div>

    <!-- Manucure -->
    <div v-show="activeCategory === 'manicure'" class="category-section">
      <div class="category-header">
        <h2 class="category-title">{{ t.services.manicure_cat_title }}</h2>
        <p class="category-intro">{{ t.services.manicure_intro }}</p>
      </div>

      <div class="services-list">
        <div class="service-row" v-for="(service, index) in manicureServices" :key="index">
          <div class="service-info">
            <h3 class="service-name">{{ service.name }}</h3>
            <p class="service-duration">{{ service.duration }}</p>
          </div>
          <div class="service-pricing">
            <span class="service-price">{{ service.price }}</span>
            <a href="/rendez-vous" class="service-btn-small">{{ t.services.book_button }}</a>
          </div>
        </div>
      </div>
    </div>

    <!-- BIAB -->
    <div v-show="activeCategory === 'biab'" class="category-section">
      <div class="category-header">
        <h2 class="category-title">{{ t.services.biab_title }}</h2>
        <p class="category-intro">{{ t.services.biab_intro }}</p>
      </div>

      <div class="services-grid">
        <div class="service-card" v-for="(service, index) in biabServices" :key="index">
          <div class="service-card-image">
            <img :src="service.image" :alt="service.title" class="img-fluid">
          </div>
          <div class="service-card-content">
            <h3 class="service-card-title">{{ service.title }}</h3>
            <p class="service-card-price">{{ service.price }}</p>
            <p class="service-card-duration">{{ service.duration }}</p>
            <p class="service-card-description">{{ service.description }}</p>
            <a href="/rendez-vous" class="service-card-button">{{ t.services.book_button }}</a>
          </div>
        </div>
      </div>
    </div>

    <!-- Cils & Sourcils -->
    <div v-show="activeCategory === 'lashes'" class="category-section">
      <div class="category-header">
        <h2 class="category-title">{{ t.services.lashes_cat_title }}</h2>
        <p class="category-intro">{{ t.services.lashes_intro }}</p>
      </div>

      <div class="services-list">
        <div class="service-row" v-for="(service, index) in lashesServices" :key="index">
          <div class="service-info">
            <h3 class="service-name">{{ service.name }}</h3>
            <p class="service-duration">{{ service.duration }}</p>
          </div>
          <div class="service-pricing">
            <span class="service-price">{{ service.price }}</span>
            <a href="/rendez-vous" class="service-btn-small">{{ t.services.book_button }}</a>
          </div>
        </div>
      </div>
    </div>

    <!-- Épilation -->
    <div v-show="activeCategory === 'epilation'" class="category-section">
      <div class="category-header">
        <h2 class="category-title">{{ t.services.waxing_cat_title }}</h2>
        <p class="category-intro">{{ t.services.waxing_intro }}</p>
      </div>

      <!-- Sous-catégories d'épilation -->
      <div class="epilation-subcategories">
        <div class="subcategory" v-for="(subcat, key) in epilationCategories" :key="key">
          <h3 class="subcategory-title">{{ subcat.title }}</h3>
          <div class="services-list">
            <div class="service-row" v-for="(service, index) in subcat.services" :key="index">
              <div class="service-info">
                <h4 class="service-name">{{ service.name }}</h4>
                <p class="service-duration">{{ service.duration }}</p>
              </div>
              <div class="service-pricing">
                <span class="service-price">{{ service.price }}</span>
                <a href="/rendez-vous" class="service-btn-small">{{ t.services.book_button }}</a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Soins du Visage -->
    <div v-show="activeCategory === 'facial'" class="category-section">
      <div class="category-header">
        <h2 class="category-title">{{ t.services.facial_cat_title }}</h2>
        <p class="category-intro">{{ t.services.facial_intro }}</p>
      </div>

      <div class="facial-service-highlight">
        <div class="facial-content">
          <h3 class="facial-title">{{ t.services.facial_complete_title }}</h3>
          <p class="facial-price">60 €</p>
          <p class="facial-duration">1h30</p>
          <p class="facial-description">
            {{ t.services.facial_complete_desc }}
          </p>
          <ul class="facial-benefits">
            <li>{{ t.services.facial_benefit_1 }}</li>
            <li>{{ t.services.facial_benefit_2 }}</li>
            <li>{{ t.services.facial_benefit_3 }}</li>
            <li>{{ t.services.facial_benefit_4 }}</li>
            <li>{{ t.services.facial_benefit_5 }}</li>
          </ul>
          <a href="/rendez-vous" class="service-card-button">{{ t.services.book_facial }}</a>
        </div>
        <div class="facial-image">
          <img src="/Images/skincare.jpg" :alt="t.services.facial_cat_title" class="img-fluid">
        </div>
      </div>
    </div>
  </section>
</template>

<script setup>
import { ref, computed } from 'vue';
import { useTranslation } from '@/composables/useTranslation';

const { t } = useTranslation();

const activeCategory = ref('biab');

const categories = computed(() => [
  { id: 'biab', name: t.value.services.cat_biab },
  { id: 'manicure', name: t.value.services.cat_manicure },
  { id: 'pedicure', name: t.value.services.cat_pedicure },
  { id: 'lashes', name: t.value.services.cat_lashes },
  { id: 'epilation', name: t.value.services.cat_epilation },
  { id: 'facial', name: t.value.services.cat_facial }
]);

const pedicureServices = computed(() => [
  { name: t.value.services.pedicure_classic, price: '60 €', duration: '90 min' },
  { name: t.value.services.pedicure_japanese, price: '60 €', duration: '90 min' }
]);

const manicureServices = computed(() => [
  { name: t.value.services.gel_removal, price: '10 €', duration: '20 min' },
  { name: t.value.services.manicure_classic, price: '40 €', duration: '60 min' },
  { name: t.value.services.japanese_manicure, price: '55 €', duration: '60 min' }
]);

const biabServices = computed(() => [
  {
    title: t.value.services.biab_simple_title,
    price: '70 €',
    duration: '90 min',
    description: t.value.services.biab_simple_desc,
    image: '/Images/manicure.jpeg'
  },
  {
    title: t.value.services.biab_color_title,
    price: '75 €',
    duration: '105 min',
    description: t.value.services.biab_color_desc,
    image: '/Images/manicure3.jpeg'
  },
  {
    title: t.value.services.biab_french_title,
    price: '75 €',
    duration: '105 min',
    description: t.value.services.biab_french_desc,
    image: '/Images/manicure5.jpeg'
  },
  {
    title: t.value.services.biab_effect_title,
    price: '75 €',
    duration: '110 min',
    description: t.value.services.biab_effect_desc,
    image: '/Images/manicure4.jpg'
  },
  {
    title: t.value.services.biab_french_effect_title,
    price: '85 €',
    duration: '110 min',
    description: t.value.services.biab_french_effect_desc,
    image: '/Images/manicure4.jpg'
  },
  {
    title: t.value.services.biab_color_effect_title,
    price: '85 €',
    duration: '110 min',
    description: t.value.services.biab_color_effect_desc,
    image: '/Images/manicure4.jpg'
  }
]);

const lashesServices = computed(() => [
  { name: t.value.services.lash_lift, price: '55 €', duration: '50 min' },
  { name: t.value.services.brow_lift, price: '55 €', duration: '60 min' },
  { name: t.value.services.restructuration, price: '25 €', duration: '50 min' },
  { name: t.value.services.duvet, price: '5 €', duration: '-' }
]);

const epilationCategories = computed(() => ({
  visage: {
    title: t.value.services.waxing_face,
    services: [
      { name: t.value.services.waxing_sideburns, price: '10 €', duration: '-' },
      { name: t.value.services.waxing_chin, price: '10 €', duration: '-' }
    ]
  },
  corps: {
    title: t.value.services.waxing_body,
    services: [
      { name: t.value.services.waxing_shoulder, price: '20 €', duration: '30 min' },
      { name: t.value.services.waxing_full_arms, price: '25 €', duration: '35 min' },
      { name: t.value.services.waxing_half_arms, price: '15 €', duration: '20 min' },
      { name: t.value.services.waxing_armpits, price: '15 €', duration: '15 min' },
      { name: t.value.services.waxing_chest, price: '30 €', duration: '35 min' },
      { name: t.value.services.waxing_back, price: '30 €', duration: '35 min' },
      { name: t.value.services.waxing_inter_glute, price: '5 €', duration: '-' }
    ]
  },
  jambes: {
    title: t.value.services.waxing_legs,
    services: [
      { name: t.value.services.waxing_full_legs, price: '30 €', duration: '40 min' },
      { name: t.value.services.waxing_3_4_legs, price: '25 €', duration: '30 min' },
      { name: t.value.services.waxing_half_legs, price: '20 €', duration: '30 min' }
    ]
  },
  bikini: {
    title: t.value.services.waxing_bikini,
    services: [
      { name: t.value.services.bikini_classic, price: '15 €', duration: '20 min' },
      { name: t.value.services.bikini_extended, price: '20 €', duration: '25 min' },
      { name: t.value.services.bikini_brazilian, price: '25 €', duration: '25 min' },
      { name: t.value.services.bikini_full, price: '30 €', duration: '40 min' }
    ]
  }
}));
</script>

<style scoped>
.services-section {
  font-family: 'Montserrat', 'Raleway', 'Helvetica Neue', sans-serif;
  background-color: #fafafa;
}

/* Hero Section */
.services-hero {
  padding: 6rem 2rem 4rem;
  text-align: center;
  background: linear-gradient(135deg, #f8f8f8 0%, #fafafa 100%);
}

.hero-title {
  font-size: 3.5rem;
  font-weight: 300;
  color: #333;
  letter-spacing: 2px;
  margin-bottom: 1rem;
}

.hero-subtitle {
  font-size: 1.2rem;
  font-weight: 300;
  color: #666;
  letter-spacing: 1px;
}

/* Navigation par catégories */
.categories-nav {
  display: flex;
  justify-content: center;
  gap: 1rem;
  padding: 3rem 2rem;
  flex-wrap: wrap;
}

.category-btn {
  padding: 0.8rem 2rem;
  border: 1px solid #d0d0d0;
  background-color: transparent;
  color: #555;
  font-size: 0.9rem;
  letter-spacing: 1px;
  text-transform: uppercase;
  border-radius: 30px;
  cursor: pointer;
  transition: all 0.3s ease;
  font-weight: 400;
}

.category-btn:hover {
  border-color: #333;
  color: #333;
  transform: translateY(-2px);
}

.category-btn.active {
  background-color: #333;
  color: #fff;
  border-color: #333;
}

/* Section de catégorie */
.category-section {
  padding: 2rem 4rem 6rem;
  animation: fadeIn 0.5s ease-in;
}

@keyframes fadeIn {
  from {
    opacity: 0;
    transform: translateY(20px);
  }
  to {
    opacity: 1;
    transform: translateY(0);
  }
}

.category-header {
  text-align: center;
  margin-bottom: 4rem;
}

.category-title {
  font-size: 2.5rem;
  font-weight: 300;
  color: #333;
  letter-spacing: 1px;
  margin-bottom: 1rem;
}

.category-intro {
  font-size: 1.1rem;
  font-weight: 300;
  color: #666;
  font-style: italic;
}

/* Grille de services (BIAB) */
.services-grid {
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
  gap: 3rem;
  max-width: 1400px;
  margin: 0 auto;
}

.service-card {
  background: white;
  border-radius: 20px;
  overflow: hidden;
  box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
  transition: transform 0.3s ease, box-shadow 0.3s ease;
  display: flex;
  flex-direction: column;
  justify-content: space-between;
  height: 100%;
}

.service-card:hover {
  transform: translateY(-5px);
  box-shadow: 0 8px 30px rgba(0, 0, 0, 0.12);
}

.service-card-image {
  width: 100%;
  height: 250px;
  overflow: hidden;
}

.service-card-image img {
  width: 100%;
  height: 100%;
  object-fit: cover;
  transition: transform 0.5s ease;
}

.service-card:hover .service-card-image img {
  transform: scale(1.1);
}

.service-card-content {
  display: flex;
  flex-direction: column;
  justify-content: space-between;
  flex: 1;
  padding: 2rem;
}

.service-card-title {
  font-size: 1.5rem;
  font-weight: 400;
  color: #333;
  margin-bottom: 0.5rem;
  letter-spacing: 0.5px;
}

.service-card-price {
  font-size: 1.3rem;
  font-weight: 300;
  color: #b3a090;
  margin-bottom: 0.5rem;
}

.service-card-duration {
  font-size: 0.9rem;
  color: #999;
  font-style: italic;
  margin-bottom: 1rem;
}

.service-card-description {
  font-size: 0.95rem;
  line-height: 1.7;
  color: #666;
  margin-bottom: 1.5rem;
}

.service-card-button {
  display: inline-block;
  padding: 0.7rem 2rem;
  border: 1px solid #333;
  border-radius: 30px;
  color: #333;
  text-decoration: none;
  font-size: 0.85rem;
  letter-spacing: 1px;
  text-transform: uppercase;
  transition: all 0.3s ease;
  text-align: center;
}

.service-card-button:hover {
  background-color: #333;
  color: #fff;
}

/* Liste de services (Pédicure, Manucure, Cils, Épilation) */
.services-list {
  max-width: 900px;
  margin: 0 auto;
}

.service-row {
  display: flex;
  justify-content: space-between;
  align-items: center;
  padding: 1.5rem 2rem;
  margin-bottom: 1rem;
  background: white;
  border-radius: 15px;
  box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
  transition: all 0.3s ease;
}

.service-row:hover {
  transform: translateX(5px);
  box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
}

.service-info {
  flex: 1;
}

.service-name {
  font-size: 1.1rem;
  font-weight: 400;
  color: #333;
  margin-bottom: 0.3rem;
}

.service-duration {
  font-size: 0.85rem;
  color: #999;
  font-style: italic;
}

.service-pricing {
  display: flex;
  align-items: center;
  gap: 1.5rem;
}

.service-price {
  font-size: 1.2rem;
  font-weight: 400;
  color: #b3a090;
  min-width: 70px;
  text-align: right;
}

.service-btn-small {
  padding: 0.5rem 1.5rem;
  border: 1px solid #333;
  border-radius: 20px;
  color: #333;
  text-decoration: none;
  font-size: 0.8rem;
  letter-spacing: 0.5px;
  transition: all 0.3s ease;
  white-space: nowrap;
}

.service-btn-small:hover {
  background-color: #333;
  color: #fff;
}

/* Sous-catégories d'épilation */
.epilation-subcategories {
  display: grid;
  gap: 3rem;
}

.subcategory {
  background: white;
  padding: 2rem;
  border-radius: 20px;
  box-shadow: 0 4px 20px rgba(0, 0, 0, 0.06);
}

.subcategory-title {
  font-size: 1.5rem;
  font-weight: 400;
  color: #333;
  margin-bottom: 1.5rem;
  padding-bottom: 1rem;
  border-bottom: 2px solid #f0f0f0;
  letter-spacing: 1px;
}

/* Soin du visage highlight */
.facial-service-highlight {
  display: flex;
  max-width: 1200px;
  margin: 0 auto;
  background: white;
  border-radius: 30px;
  overflow: hidden;
  box-shadow: 0 8px 40px rgba(0, 0, 0, 0.1);
  gap: 2rem;
}

.facial-content {
  flex: 1;
  padding: 4rem;
}

.facial-title {
  font-size: 2rem;
  font-weight: 400;
  color: #333;
  margin-bottom: 1rem;
  letter-spacing: 0.5px;
}

.facial-price {
  font-size: 1.8rem;
  font-weight: 300;
  color: #b3a090;
  margin-bottom: 0.5rem;
}

.facial-duration {
  font-size: 1rem;
  color: #999;
  margin-bottom: 2rem;
  font-style: italic;
}

.facial-description {
  font-size: 1rem;
  line-height: 1.8;
  color: #666;
  margin-bottom: 2rem;
}

.facial-benefits {
  list-style: none;
  padding: 0;
  margin-bottom: 2rem;
}

.facial-benefits li {
  padding: 0.5rem 0;
  color: #555;
  position: relative;
  padding-left: 1.5rem;
}

.facial-benefits li::before {
  content: '✓';
  position: absolute;
  left: 0;
  color: #b3a090;
  font-weight: bold;
}

.facial-image {
  flex: 1;
  min-height: 400px;
  position: relative;
  overflow: hidden;
}

.facial-image img {
  width: 100%;
  height: 100%;
  object-fit: cover;
}

/* Responsive */
@media (max-width: 1024px) {
  .category-section {
    padding: 2rem 2rem 4rem;
  }

  .facial-service-highlight {
    flex-direction: column;
  }

  .facial-content {
    padding: 3rem 2rem;
  }

  .facial-image {
    min-height: 300px;
  }
}

@media (max-width: 768px) {
  .hero-title {
    font-size: 2.5rem;
  }

  .hero-subtitle {
    font-size: 1rem;
  }

  .categories-nav {
    padding: 2rem 1rem;
    gap: 0.5rem;
  }

  .category-btn {
    padding: 0.6rem 1.2rem;
    font-size: 0.8rem;
  }

  .category-section {
    padding: 2rem 1rem 4rem;
  }

  .category-title {
    font-size: 2rem;
  }

  .services-grid {
    grid-template-columns: 1fr;
    gap: 2rem;
  }

  .service-card {
    height: auto;
  }

  .service-card-image {
    height: 200px;
  }

  .service-card-content {
    padding: 1.5rem;
  }

  .service-card-title {
    font-size: 1.3rem;
  }

  .service-card-price {
    font-size: 1.1rem;
  }

  .service-card-description {
    font-size: 0.9rem;
  }

  .service-card-button {
    width: 100%;
    padding: 0.7rem 0;
    text-align: center;
  }

  .service-row {
    flex-direction: column;
    align-items: flex-start;
    gap: 1rem;
  }

  .service-pricing {
    width: 100%;
    justify-content: space-between;
  }

  .service-btn-small {
    padding: 0.6rem 1.2rem;
  }

  .subcategory {
    padding: 1.5rem;
  }

  .facial-content {
    padding: 2rem 1.5rem;
  }

  .facial-title {
    font-size: 1.7rem;
  }
}
</style>
<template>
  <div>
    <TopNav />

    <!-- Hero Section -->
    <section class="pricing-hero">
      <div class="container">
        <h1 class="hero-title">{{ t.pricing.hero_title }}</h1>
        <p class="hero-subtitle">{{ t.pricing.hero_subtitle }}</p>
      </div>
    </section>

    <!-- Pricing Section -->
    <section class="pricing-section">
      <div class="container">
        <!-- First Row: Manucure, BIAB -->
        <div class="pricing-row">
          <div class="pricing-column">
            <h3 class="category-title">{{ t.pricing.cat_manicure }}</h3>
            <div class="price-item">
              <span class="service-name">{{ t.pricing.manicure_removal }}</span>
              <span class="service-price">€ 10</span>
            </div>
            <div class="price-item">
              <span class="service-name">{{ t.pricing.manicure_classic }}</span>
              <span class="service-price">€ 40</span>
            </div>
            <div class="price-item">
              <span class="service-name">{{ t.pricing.manicure_japanese }}</span>
              <span class="service-price">€ 55</span>
            </div>
          </div>

          <div class="pricing-column">
            <h3 class="category-title">{{ t.pricing.cat_biab }}</h3>
            <div class="price-item">
              <span class="service-name">{{ t.pricing.biab_simple }}</span>
              <span class="service-price">€ 70</span>
            </div>
            <div class="price-item">
              <span class="service-name">{{ t.pricing.biab_color }}</span>
              <span class="service-price">€ 75</span>
            </div>
            <div class="price-item">
              <span class="service-name">{{ t.pricing.biab_french }}</span>
              <span class="service-price">€ 75</span>
            </div>
            <div class="price-item">
              <span class="service-name">{{ t.pricing.biab_effect }}</span>
              <span class="service-price">€ 75</span>
            </div>
            <div class="price-item">
              <span class="service-name">{{ t.pricing.biab_french_effect }}</span>
              <span class="service-price">€ 85</span>
            </div>
            <div class="price-item">
              <span class="service-name">{{ t.pricing.biab_color_effect }}</span>
              <span class="service-price">€ 85</span>
            </div>
          </div>
        </div>

        <!-- Second Row: Pédicure, Visage -->
        <div class="pricing-row">
          <div class="pricing-column">
            <h3 class="category-title">{{ t.pricing.cat_pedicure }}</h3>
            <div class="price-item">
              <span class="service-name">{{ t.pricing.pedicure_essential }}</span>
              <span class="service-price">€ 50</span>
            </div>
            <div class="price-item">
              <span class="service-name">{{ t.pricing.pedicure_japanese }}</span>
              <span class="service-price">€ 60</span>
            </div>
            <div class="price-item">
              <span class="service-name">{{ t.pricing.pedicure_deep }}</span>
              <span class="service-price">€ 70</span>
            </div>
            <div class="price-item">
              <span class="service-name">{{ t.pricing.pedicure_luxe }}</span>
              <span class="service-price">€ 90</span>
            </div>
          </div>

          <div class="pricing-column">
            <h3 class="category-title">{{ t.pricing.cat_facial }}</h3>
            <div class="price-item">
              <span class="service-name">{{ t.pricing.facial_treatment }}</span>
              <span class="service-price">€ 60</span>
            </div>
            <div class="price-item">
              <span class="service-name">{{ t.pricing.facial_brows }}</span>
              <span class="service-price">€ 25</span>
            </div>

            <h3 class="category-title" style="margin-top: 2.5rem;">{{ t.pricing.cat_brows }}</h3>
            <div class="price-item">
              <span class="service-name">{{ t.pricing.brows_lift }}</span>
              <span class="service-price">€ 45</span>
            </div>
            <div class="price-item">
              <span class="service-name">{{ t.pricing.brows_lift_wax }}</span>
              <span class="service-price">€ 60</span>
            </div>
            <div class="price-item">
              <span class="service-name">{{ t.pricing.brows_lift_wax_tint }}</span>
              <span class="service-price">€ 65</span>
            </div>

            <h3 class="category-title" style="margin-top: 2.5rem;">{{ t.pricing.cat_lashes }}</h3>
            <div class="price-item">
              <span class="service-name">{{ t.pricing.lashes_lift }}</span>
              <span class="service-price">€ 60</span>
            </div>
          </div>
        </div>

        <!-- Third Row: Épilation Femme -->
        <div class="pricing-row">
          <div class="pricing-column">
            <h3 class="category-title">{{ t.pricing.cat_waxing_women }}</h3>
            <div class="price-item">
              <span class="service-name">{{ t.pricing.wax_duvet }}</span>
              <span class="service-price">€ 5</span>
            </div>
            <div class="price-item">
              <span class="service-name">{{ t.pricing.wax_sideburns }}</span>
              <span class="service-price">€ 10</span>
            </div>
            <div class="price-item">
              <span class="service-name">{{ t.pricing.wax_chin }}</span>
              <span class="service-price">€ 10</span>
            </div>
            <div class="price-item">
              <span class="service-name">{{ t.pricing.wax_underarms }}</span>
              <span class="service-price">€ 15</span>
            </div>
            <div class="price-item">
              <span class="service-name">{{ t.pricing.wax_shoulders }}</span>
              <span class="service-price">€ 20</span>
            </div>
            <div class="price-item">
              <span class="service-name">{{ t.pricing.wax_full_arms }}</span>
              <span class="service-price">€ 25</span>
            </div>
            <div class="price-item">
              <span class="service-name">{{ t.pricing.wax_half_arms }}</span>
              <span class="service-price">€ 20</span>
            </div>
            <div class="price-item">
              <span class="service-name">{{ t.pricing.wax_full_legs }}</span>
              <span class="service-price">€ 35</span>
            </div>
            <div class="price-item">
              <span class="service-name">{{ t.pricing.wax_three_quarter_legs }}</span>
              <span class="service-price">€ 30</span>
            </div>
            <div class="price-item">
              <span class="service-name">{{ t.pricing.wax_half_legs }}</span>
              <span class="service-price">€ 25</span>
            </div>
            <div class="price-item">
              <span class="service-name">{{ t.pricing.wax_chest }}</span>
              <span class="service-price">€ 30</span>
            </div>
            <div class="price-item">
              <span class="service-name">{{ t.pricing.wax_back }}</span>
              <span class="service-price">€ 30</span>
            </div>
            <div class="price-item">
              <span class="service-name">{{ t.pricing.wax_intergluteal }}</span>
              <span class="service-price">€ 5</span>
            </div>

            <h4 class="subcategory-title">Bikini</h4>
            <div class="price-item">
              <span class="service-name">{{ t.pricing.wax_bikini_classic }}</span>
              <span class="service-price">€ 15</span>
            </div>
            <div class="price-item">
              <span class="service-name">{{ t.pricing.wax_bikini_extended }}</span>
              <span class="service-price">€ 20</span>
            </div>
            <div class="price-item">
              <span class="service-name">{{ t.pricing.wax_bikini_brazilian }}</span>
              <span class="service-price">€ 25</span>
            </div>
            <div class="price-item">
              <span class="service-name">{{ t.pricing.wax_bikini_full }}</span>
              <span class="service-price">€ 30</span>
            </div>
          </div>

          <div class="pricing-column">
            <h3 class="category-title">{{ t.pricing.cat_waxing_men }}</h3>
            <div class="price-item">
              <span class="service-name">{{ t.pricing.wax_men_chest }}</span>
              <span class="service-price">€ 35</span>
            </div>
            <div class="price-item">
              <span class="service-name">{{ t.pricing.wax_men_back }}</span>
              <span class="service-price">€ 35</span>
            </div>
            <div class="price-item">
              <span class="service-name">{{ t.pricing.wax_men_full_arms }}</span>
              <span class="service-price">€ 30</span>
            </div>
            <div class="price-item">
              <span class="service-name">{{ t.pricing.wax_men_full_legs }}</span>
              <span class="service-price">€ 40</span>
            </div>
            <div class="price-item">
              <span class="service-name">{{ t.pricing.wax_men_bikini }}</span>
              <span class="service-price">€ 40</span>
            </div>
            <div class="price-item">
              <span class="service-name">{{ t.pricing.wax_men_underarms }}</span>
              <span class="service-price">€ 15</span>
            </div>
            <div class="price-item">
              <span class="service-name">{{ t.pricing.wax_men_shoulders }}</span>
              <span class="service-price">€ 25</span>
            </div>
          </div>
        </div>

        <!-- Combined Packages Section -->
        <div class="packages-section">
          <h2 class="packages-title">{{ t.pricing.cat_packages }}</h2>

          <div class="pricing-row">
            <div class="pricing-column">
              <div class="price-item">
                <span class="service-name">Lèvre supérieure et menton</span>
                <span class="service-price">€ 40</span>
              </div>
              <div class="price-item">
                <span class="service-name">Ligne de bikini et aisselles</span>
                <span class="service-price">€ 100</span>
              </div>
              <div class="price-item">
                <span class="service-name">Bikini intégral et aisselles</span>
                <span class="service-price">€ 115</span>
              </div>
              <div class="price-item">
                <span class="service-name">Jambes complètes, bikini complet, aisselles</span>
                <span class="service-price">€ 270</span>
              </div>
            </div>

            <div class="pricing-column">
              <div class="price-item">
                <span class="service-name">Jambes complètes, ligne de bikini, aisselles</span>
                <span class="service-price">€ 250</span>
              </div>
              <div class="price-item">
                <span class="service-name">Corps complet</span>
                <span class="service-price">€ 350</span>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>

    <Footer />
  </div>
</template>

<script setup>
import TopNav from '@/Components/TopNav.vue'
import Footer from '@/Components/Footer.vue'
import { useTranslation } from '@/composables/useTranslation'

const { t } = useTranslation()

defineProps({
  title: String,
})
</script>

<style scoped>
.pricing-hero {
  padding: 4rem 0 2.5rem;
  background-color: #f5e6db;
  text-align: center;
  font-family: 'Montserrat', 'Raleway', 'Helvetica Neue', sans-serif;
}

.container {
  max-width: 1200px;
  margin: 0 auto;
  padding: 0 2rem;
}

.hero-title {
  font-size: 3rem;
  font-weight: 300;
  color: #333;
  letter-spacing: 1px;
  margin-bottom: 0.8rem;
}

.hero-subtitle {
  font-size: 1rem;
  font-weight: 300;
  color: #555;
  line-height: 1.8;
  max-width: 600px;
  margin: 0 auto;
}

.pricing-section {
  padding: 5rem 0;
  background-color: #fff;
  font-family: 'Montserrat', 'Raleway', 'Helvetica Neue', sans-serif;
}

.pricing-row {
  display: grid;
  grid-template-columns: 1fr 1fr;
  gap: 5rem;
  margin-bottom: 5rem;
}

.pricing-column {
  display: flex;
  flex-direction: column;
}

.category-title {
  font-size: 1.3rem;
  font-weight: 400;
  color: #b3a090;
  letter-spacing: 1px;
  margin-bottom: 2rem;
  text-transform: uppercase;
}

.subcategory-title {
  font-size: 1.1rem;
  font-weight: 400;
  color: #b3a090;
  letter-spacing: 0.5px;
  margin-top: 2rem;
  margin-bottom: 1.5rem;
}

.price-item {
  display: flex;
  justify-content: space-between;
  align-items: baseline;
  padding: 1rem 0;
  border-bottom: 1px solid #e6cfc2;
  transition: all 0.3s ease;
}

.price-item:hover {
  background-color: #fafafa;
  padding-left: 0.5rem;
  padding-right: 0.5rem;
}

.service-name {
  font-size: 0.95rem;
  font-weight: 300;
  color: #555;
  letter-spacing: 0.3px;
  flex: 1;
}

.service-price {
  font-size: 0.95rem;
  font-weight: 400;
  color: #b3a090;
  letter-spacing: 0.5px;
  margin-left: 2rem;
}

.packages-section {
  margin-top: 4rem;
  padding-top: 3rem;
  border-top: 2px solid #e6cfc2;
}

.packages-title {
  font-size: 1.8rem;
  font-weight: 300;
  color: #b3a090;
  letter-spacing: 1.5px;
  text-align: center;
  margin-bottom: 3rem;
  text-transform: uppercase;
}

/* Responsive */
@media (max-width: 991px) {
  .pricing-hero {
    padding: 5rem 0;
  }

  .hero-title {
    font-size: 2.5rem;
  }

  .hero-subtitle {
    font-size: 1rem;
  }

  .pricing-section {
    padding: 4rem 0;
  }

  .pricing-row {
    gap: 4rem;
    margin-bottom: 4rem;
  }

  .category-title {
    font-size: 1.2rem;
  }

  .service-name,
  .service-price {
    font-size: 0.9rem;
  }
}

@media (max-width: 767px) {
  .container {
    padding: 0 1.5rem;
  }

  .pricing-hero {
    padding: 4rem 0;
  }

  .hero-title {
    font-size: 2.2rem;
  }

  .hero-subtitle {
    font-size: 0.95rem;
  }

  .pricing-section {
    padding: 3rem 0;
  }

  .pricing-row {
    grid-template-columns: 1fr;
    gap: 3rem;
    margin-bottom: 3rem;
  }

  .category-title {
    font-size: 1.1rem;
    margin-bottom: 1.5rem;
  }

  .subcategory-title {
    font-size: 1rem;
    margin-top: 1.5rem;
    margin-bottom: 1rem;
  }

  .price-item {
    padding: 0.8rem 0;
  }

  .service-name,
  .service-price {
    font-size: 0.85rem;
  }

  .service-price {
    margin-left: 1rem;
  }

  .packages-section {
    margin-top: 2rem;
    padding-top: 2rem;
  }

  .packages-title {
    font-size: 1.5rem;
    margin-bottom: 2rem;
  }
}

@media (max-width: 480px) {
  .pricing-hero {
    padding: 3rem 0;
  }

  .hero-title {
    font-size: 1.8rem;
  }

  .category-title {
    font-size: 1rem;
  }

  .service-name,
  .service-price {
    font-size: 0.8rem;
  }

  .packages-title {
    font-size: 1.3rem;
  }
}
</style>

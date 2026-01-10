<template>
  <div>
    <TopNav />
    
    <!-- Hero Section -->
    <section class="shop-hero">
      <div class="container">
        <h1 class="hero-title">La Boutique</h1>
        <p class="hero-subtitle">
          Découvrez nos e-books et produits exclusifs pour sublimer vos ongles
        </p>
      </div>
    </section>

    <!-- Notification -->
    <div v-if="notification" class="notification">
      <div class="notification-content">
        <svg class="notification-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
        </svg>
        <span>{{ notification }}</span>
      </div>
    </div>

    <!-- Products Section -->
    <section class="products-section">
      <div class="container">
        <div v-if="products.length === 0" class="empty-state">
          <p>Aucun produit disponible pour le moment.</p>
          <p class="empty-subtitle">Revenez bientôt découvrir nos nouveautés !</p>
        </div>

        <div v-else class="products-grid">
          <div
            v-for="product in products"
            :key="product.id"
            class="product-card"
          >
            <!-- Image -->
            <div class="product-image-wrapper">
              <img
                v-if="product.image_url"
                :src="product.image_url"
                :alt="product.name"
                class="product-image"
              />
              <div v-else class="no-image">
                <span>📦</span>
              </div>
            </div>

            <!-- Content -->
            <div class="product-content">
              <h3 class="product-name">{{ product.name }}</h3>
              
              <p class="product-description">
                {{ product.short_description || product.description.substring(0, 100) + '...' }}
              </p>
              
              <div class="product-actions">
                <button
                  @click="addToCart(product)"
                  class="btn-add-cart"
                >
                  🛒 Ajouter · {{ formatPrice(product.price) }}
                </button>
                
                <Link
                  :href="`/shop/${product.slug}`"
                  class="btn-details"
                >
                  Voir plus
                </Link>
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
import { ref } from 'vue';
import { Link } from '@inertiajs/vue3';
import TopNav from '@/Components/TopNav.vue';
import Footer from '@/Components/Footer.vue';
import { useCart } from '@/composables/useCart';

defineProps({
  products: Array
});

const { addToCart: addToCartComposable } = useCart();
const notification = ref('');

const formatPrice = (price) => {
  return new Intl.NumberFormat('fr-BE', {
    style: 'currency',
    currency: 'EUR'
  }).format(price);
};

const addToCart = (product) => {
  addToCartComposable(product);
  notification.value = `${product.name} ajouté au panier !`;
  setTimeout(() => {
    notification.value = '';
  }, 3000);
};
</script>

<style scoped>
/* Image - VERSION OPTIMISÉE POUR AFFICHAGE COMPLET */
.product-image-wrapper {
  width: 100%;
  height: 250px;
  background: #ffffff;
  display: flex;
  align-items: center;
  justify-content: center;
  border-bottom: 1px solid #f0f0f0;
  padding: 1rem; /* ✅ Espace blanc autour pour que l'image ne touche pas les bords */
}

.product-image {
  max-width: 100%;
  max-height: 100%;
  width: auto;
  height: auto;
  object-fit: contain; /* ✅ Garde les proportions SANS rogner */
  transition: transform 0.3s ease;
}

.product-card:hover .product-image {
  transform: scale(1.05);
}

.no-image {
  width: calc(100% - 2rem);
  height: calc(100% - 2rem);
  display: flex;
  align-items: center;
  justify-content: center;
  background: linear-gradient(135deg, #f8f8f8 0%, #e8e8e8 100%);
  font-size: 4rem;
  border-radius: 8px;
}

/* Notification */
.notification {
  position: fixed;
  top: 100px;
  right: 20px;
  z-index: 1000;
  animation: slideIn 0.3s ease;
}

@keyframes slideIn {
  from {
    transform: translateX(400px);
    opacity: 0;
  }
  to {
    transform: translateX(0);
    opacity: 1;
  }
}

.notification-content {
  background: #333;
  color: white;
  padding: 1rem 1.5rem;
  border-radius: 50px;
  display: flex;
  align-items: center;
  gap: 0.5rem;
  box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
  font-family: 'Montserrat', sans-serif;
  font-size: 0.9rem;
  font-weight: 300;
}

.notification-icon {
  width: 20px;
  height: 20px;
  color: #4ade80;
}

/* Hero Section */
.shop-hero {
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

/* Products Section */
.products-section {
  padding: 3rem 0 5rem;
  background-color: #f8f8f8;
  font-family: 'Montserrat', 'Raleway', 'Helvetica Neue', sans-serif;
}

.empty-state {
  text-align: center;
  padding: 4rem 2rem;
  color: #777;
}

.empty-state p {
  font-size: 1.2rem;
  font-weight: 300;
  margin-bottom: 1rem;
}

.empty-subtitle {
  font-size: 1rem;
  color: #999;
}

.products-grid {
  display: grid;
  grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
  gap: 2rem;
  margin-top: 2rem;
}

/* Product Card */
.product-card {
  background: #fff;
  border-radius: 8px;
  overflow: hidden;
  transition: transform 0.3s ease, box-shadow 0.3s ease;
  box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
}

.product-card:hover {
  transform: translateY(-5px);
  box-shadow: 0 8px 25px rgba(0, 0, 0, 0.1);
}

/* Product Content */
.product-content {
  padding: 1.5rem;
}

.product-name {
  font-size: 1.4rem;
  font-weight: 300;
  color: #333;
  letter-spacing: 0.5px;
  line-height: 1.3;
  margin-bottom: 1rem;
  min-height: 2.6em;
}

.product-description {
  font-size: 0.9rem;
  font-weight: 300;
  color: #666;
  line-height: 1.6;
  margin-bottom: 1.5rem;
  min-height: 3.2em;
  display: -webkit-box;
  -webkit-line-clamp: 2;
  -webkit-box-orient: vertical;
  overflow: hidden;
}

/* Product Actions */
.product-actions {
  display: flex;
  gap: 0.5rem;
}

.btn-add-cart {
  flex: 1;
  padding: 0.85rem 1rem;
  background: #593625;
  color: white;
  border: none;
  border-radius: 50px;
  font-size: 0.8rem;
  font-weight: 300;
  letter-spacing: 0.3px;
  cursor: pointer;
  transition: all 0.3s ease;
  font-family: 'Montserrat', sans-serif;
  white-space: normal;
  text-align: center;
  line-height: 1.3;
}

.btn-add-cart:hover {
  background: #442a1d;
  transform: translateY(-2px);
  box-shadow: 0 4px 12px rgba(89, 54, 37, 0.3);
}

.btn-details {
  padding: 0.85rem 1.2rem;
  border: 1px solid #593625;
  border-radius: 50px;
  color: #593625;
  text-decoration: none;
  font-size: 0.85rem;
  letter-spacing: 0.5px;
  transition: all 0.3s ease;
  font-weight: 300;
  white-space: nowrap;
}

.btn-details:hover {
  background-color: #593625;
  border-color: #593625;
  color: #fff;
}

/* Responsive */
@media (max-width: 991px) {
  .hero-title {
    font-size: 2.5rem;
  }

  .products-grid {
    grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
    gap: 1.5rem;
  }

  .product-image-wrapper {
    height: 220px;
  }
}

@media (max-width: 767px) {
  .shop-hero {
    padding: 3rem 0 2rem;
  }

  .hero-title {
    font-size: 2rem;
  }

  .hero-subtitle {
    font-size: 0.95rem;
  }

  .products-section {
    padding: 2.5rem 0 4rem;
  }

  .products-grid {
    grid-template-columns: 1fr;
    gap: 1.5rem;
  }

  .product-image-wrapper {
    height: 200px;
    padding: 0.75rem; /* ✅ Padding réduit sur mobile */
  }

  .product-name {
    font-size: 1.2rem;
  }

  .product-actions {
    flex-direction: column;
  }

  .btn-add-cart,
  .btn-details {
    width: 100%;
    text-align: center;
  }

  .notification {
    right: 10px;
    left: 10px;
  }

  .notification-content {
    width: 100%;
    justify-content: center;
  }
}
</style>
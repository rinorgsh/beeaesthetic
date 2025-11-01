<template>
    <div>
      <TopNav />
      
      <section class="success-section">
        <div class="container">
          <!-- Success Icon -->
          <div class="success-icon">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
            </svg>
          </div>
  
          <h1 class="page-title">Commande validée</h1>
          <div class="page-divider"></div>
  
          <p class="success-subtitle">Merci pour votre confiance</p>
  
          <!-- Produits achetés -->
          <div class="products-section">
            <h2 class="section-title">Vos produits</h2>
            
            <div class="products-list">
              <div v-for="item in items" :key="item.id" class="product-item">
                <div class="product-image">
                  <img
                    v-if="item.product.image_url"
                    :src="item.product.image_url"
                    :alt="item.product.name"
                  />
                  <div v-else class="no-image">📦</div>
                </div>
  
                <div class="product-info">
                  <h3 class="product-name">{{ item.product.name }}</h3>
                  <p class="product-quantity">Quantité : {{ item.quantity }}</p>
                  <span :class="['product-badge', item.product.type]">
                    {{ item.product.type === 'digital' ? 'Digital' : 'Physique' }}
                  </span>
                </div>
  
                <div class="product-action">
                  <a 
                    v-if="item.product.type === 'digital' && item.download_token"
                    :href="`/download/token/${item.download_token}`"
                    class="btn-download"
                    target="_blank"
                  >
                    📥 Télécharger
                  </a>
                  <div v-else-if="item.product.type === 'physical'" class="shipping-info">
                    <span class="status">En préparation</span>
                    <span class="eta">2-3 jours</span>
                  </div>
                </div>
              </div>
            </div>
          </div>
  
          <!-- Info selon type de produits -->
          <div class="info-boxes">
            <!-- Digital uniquement -->
            <div v-if="hasOnlyDigital" class="info-box digital">
              <p>
                Un email avec les liens de téléchargement a été envoyé à<br>
                <strong>{{ order.customer_email }}</strong>
              </p>
            </div>
  
            <!-- Physique uniquement -->
            <div v-else-if="hasOnlyPhysical" class="info-box physical">
              <p class="info-label">Adresse de livraison</p>
              <div class="address">
                {{ order.shipping_name }}<br>
                {{ order.shipping_address }}<br>
                {{ order.shipping_postal_code }} {{ order.shipping_city }}<br>
                {{ order.shipping_country }}
              </div>
              <p class="info-note">
                Confirmation envoyée à <strong>{{ order.customer_email }}</strong>
              </p>
            </div>
  
            <!-- Mixte -->
            <div v-else class="info-boxes-mixed">
              <div class="info-box digital">
                <p><strong>Produits digitaux</strong> : Disponibles immédiatement</p>
              </div>
              <div class="info-box physical">
                <p class="info-label">Livraison prévue</p>
                <div class="address">
                  {{ order.shipping_name }}<br>
                  {{ order.shipping_address }}<br>
                  {{ order.shipping_postal_code }} {{ order.shipping_city }}
                </div>
              </div>
            </div>
          </div>
  
          <!-- Numéro de commande -->
          <p class="order-number">Commande N° {{ order.order_number }}</p>
  
          <!-- Retour boutique -->
          <div class="back-section">
            <Link href="/shop" class="back-link">
              ← Retour à la boutique
            </Link>
          </div>
        </div>
      </section>
  
      <Footer />
    </div>
  </template>
  
  <script setup>
  import { computed } from 'vue';
  import { Link } from '@inertiajs/vue3';
  import TopNav from '@/Components/TopNav.vue';
  import Footer from '@/Components/Footer.vue';
  
  const props = defineProps({
    order: Object,
    items: Array
  });
  
  const hasOnlyDigital = computed(() => {
    return props.items.every(item => item.product.type === 'digital');
  });
  
  const hasOnlyPhysical = computed(() => {
    return props.items.every(item => item.product.type === 'physical');
  });
  </script>
  
  <style scoped>
  .success-section {
    padding: 4rem 0 6rem;
    background-color: #f8f8f8;
    font-family: 'Montserrat', 'Raleway', 'Helvetica Neue', sans-serif;
    min-height: 80vh;
  }
  
  .container {
    max-width: 900px;
    margin: 0 auto;
    padding: 0 2rem;
  }
  
  /* Success Icon */
  .success-icon {
    width: 80px;
    height: 80px;
    margin: 0 auto 2rem;
    background: white;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.08);
  }
  
  .success-icon svg {
    width: 40px;
    height: 40px;
    color: #b3a090;
    stroke-width: 2.5;
  }
  
  .page-title {
    font-size: 2.5rem;
    font-weight: 300;
    color: #333;
    letter-spacing: 1px;
    text-align: center;
    margin-bottom: 1rem;
  }
  
  .page-divider {
    width: 60px;
    height: 1px;
    background: #b3a090;
    margin: 0 auto 2rem;
  }
  
  .success-subtitle {
    font-size: 1.1rem;
    font-weight: 300;
    color: #666;
    text-align: center;
    margin-bottom: 3rem;
    letter-spacing: 0.5px;
  }
  
  /* Products Section */
  .products-section {
    background: white;
    padding: 2.5rem;
    margin-bottom: 2rem;
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
  }
  
  .section-title {
    font-size: 1.2rem;
    font-weight: 300;
    color: #555;
    margin-bottom: 2rem;
    letter-spacing: 0.5px;
    text-transform: uppercase;
  }
  
  .products-list {
    display: flex;
    flex-direction: column;
    gap: 1.5rem;
  }
  
  .product-item {
    display: grid;
    grid-template-columns: 80px 1fr auto;
    gap: 1.5rem;
    align-items: center;
    padding-bottom: 1.5rem;
    border-bottom: 1px solid #f0f0f0;
  }
  
  .product-item:last-child {
    border-bottom: none;
    padding-bottom: 0;
  }
  
  .product-image {
    width: 80px;
    height: 80px;
    overflow: hidden;
    background: #f5f5f5;
    border-radius: 4px;
  }
  
  .product-image img {
    width: 100%;
    height: 100%;
    object-fit: cover;
  }
  
  .no-image {
    width: 100%;
    height: 100%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 2rem;
    background: linear-gradient(135deg, #f5f5f5 0%, #e0e0e0 100%);
  }
  
  .product-info {
    flex: 1;
  }
  
  .product-name {
    font-size: 1.1rem;
    font-weight: 300;
    color: #333;
    margin-bottom: 0.5rem;
  }
  
  .product-quantity {
    font-size: 0.9rem;
    font-weight: 300;
    color: #999;
    margin-bottom: 0.5rem;
  }
  
  .product-badge {
    display: inline-block;
    padding: 0.3rem 0.8rem;
    font-size: 0.75rem;
    font-weight: 400;
    border-radius: 3px;
    letter-spacing: 0.3px;
    text-transform: uppercase;
  }
  
  .product-badge.digital {
    background: #e3f2fd;
    color: #1976d2;
  }
  
  .product-badge.physical {
    background: #f3e5f5;
    color: #7b1fa2;
  }
  
  /* Actions */
  .product-action {
    text-align: right;
  }
  
  .btn-download {
    display: inline-block;
    padding: 0.7rem 1.5rem;
    background: #333;
    color: white;
    text-decoration: none;
    border-radius: 50px;
    font-size: 0.85rem;
    font-weight: 300;
    letter-spacing: 0.5px;
    transition: all 0.3s ease;
  }
  
  .btn-download:hover {
    background: #000;
    transform: translateY(-2px);
  }
  
  .shipping-info {
    display: flex;
    flex-direction: column;
    gap: 0.3rem;
    text-align: right;
  }
  
  .status {
    font-size: 0.9rem;
    font-weight: 400;
    color: #555;
  }
  
  .eta {
    font-size: 0.8rem;
    font-weight: 300;
    color: #999;
  }
  
  /* Info Boxes */
  .info-boxes {
    margin-bottom: 2rem;
  }
  
  .info-boxes-mixed {
    display: flex;
    flex-direction: column;
    gap: 1rem;
  }
  
  .info-box {
    background: white;
    padding: 2rem;
    border-left: 3px solid;
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
  }
  
  .info-box.digital {
    border-color: #1976d2;
  }
  
  .info-box.physical {
    border-color: #7b1fa2;
  }
  
  .info-box p {
    font-size: 0.95rem;
    font-weight: 300;
    color: #555;
    line-height: 1.6;
  }
  
  .info-label {
    font-size: 0.85rem;
    font-weight: 400;
    color: #999;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    margin-bottom: 1rem;
  }
  
  .address {
    font-size: 0.95rem;
    font-weight: 300;
    color: #333;
    line-height: 1.8;
    margin-bottom: 1rem;
  }
  
  .info-note {
    font-size: 0.85rem;
    color: #666;
    margin-top: 1rem;
  }
  
  /* Order Number */
  .order-number {
    text-align: center;
    font-size: 0.85rem;
    font-weight: 300;
    color: #999;
    margin-bottom: 2rem;
    letter-spacing: 0.3px;
  }
  
  /* Back Section */
  .back-section {
    text-align: center;
  }
  
  .back-link {
    color: #666;
    text-decoration: none;
    font-size: 0.9rem;
    font-weight: 300;
    letter-spacing: 0.5px;
    transition: color 0.3s ease;
  }
  
  .back-link:hover {
    color: #333;
  }
  
  /* Responsive */
  @media (max-width: 767px) {
    .success-section {
      padding: 3rem 0 4rem;
    }
  
    .page-title {
      font-size: 2rem;
    }
  
    .products-section {
      padding: 1.5rem;
    }
  
    .product-item {
      grid-template-columns: 60px 1fr;
      gap: 1rem;
    }
  
    .product-action {
      grid-column: 1 / -1;
      text-align: center;
      margin-top: 1rem;
    }
  
    .btn-download {
      width: 100%;
      text-align: center;
    }
  
    .info-box {
      padding: 1.5rem;
    }
  }
  </style>
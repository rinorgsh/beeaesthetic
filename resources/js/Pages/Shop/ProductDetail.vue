<template>
    <div>
      <TopNav />
      
      <!-- Product Detail Section -->
      <section class="product-detail-section">
        <div class="container">
          <!-- Breadcrumb -->
          <div class="breadcrumb">
            <Link href="/shop" class="breadcrumb-link">Boutique</Link>
            <span class="breadcrumb-separator">/</span>
            <span class="breadcrumb-current">{{ product.name }}</span>
          </div>
  
          <div class="product-grid">
            <!-- Image -->
            <div class="product-image-section">
              <div class="main-image">
                <img
                  v-if="product.image"
                  :src="`/storage/${product.image}`"
                  :alt="product.name"
                />
                <div v-else class="no-image">
                  <span>📦</span>
                </div>
              </div>
            </div>
  
            <!-- Product Info -->
            <div class="product-info-section">
              <h1 class="product-title">{{ product.name }}</h1>
              
              <div class="price-section">
                <span class="product-price">{{ formatPrice(product.price) }}</span>
              </div>
  
              <div class="product-divider"></div>
  
              <div class="product-description">
                <p>{{ product.description }}</p>
              </div>
  
              <div class="product-divider"></div>
  
              <!-- Quantity -->
              <div class="quantity-section">
                <label class="quantity-label">Quantité</label>
                <div class="quantity-controls">
                  <button
                    @click="quantity = Math.max(1, quantity - 1)"
                    class="qty-btn"
                  >
                    −
                  </button>
                  <span class="qty-display">{{ quantity }}</span>
                  <button
                    @click="quantity++"
                    class="qty-btn"
                  >
                    +
                  </button>
                </div>
              </div>
  
              <!-- Action Buttons -->
              <div class="action-buttons">
                <button
                  @click="handleAddToCart"
                  class="btn-add-to-cart"
                >
                  Ajouter au panier
                </button>
  
                <button
                  @click="handleBuyNow"
                  class="btn-buy-now"
                >
                  Acheter maintenant
                </button>
              </div>
  
              <!-- Success Message -->
              <div v-if="addedToCart" class="success-message">
                <svg class="success-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                </svg>
                <span>Ajouté au panier !</span>
                <Link href="/panier" class="view-cart-link">Voir →</Link>
              </div>
  
              <!-- Additional Info -->
              <div class="additional-info">
                <div class="info-item">
                  <span class="info-icon">🔒</span>
                  <span>Paiement sécurisé</span>
                </div>
                <div class="info-item">
                  <span class="info-icon">📧</span>
                  <span>Livraison email</span>
                </div>
              </div>
            </div>
          </div>
  
          <!-- Back to Shop -->
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
  import { ref } from 'vue';
  import { Link, router } from '@inertiajs/vue3';
  import TopNav from '@/Components/TopNav.vue';
  import Footer from '@/Components/Footer.vue';
  import { useCart } from '@/composables/useCart';
  
  const props = defineProps({
    product: Object
  });
  
  const { addToCart } = useCart();
  const quantity = ref(1);
  const addedToCart = ref(false);
  
  const formatPrice = (price) => {
    return new Intl.NumberFormat('fr-BE', {
      style: 'currency',
      currency: 'EUR'
    }).format(price);
  };
  
  const handleAddToCart = () => {
    addToCart(props.product, quantity.value);
    addedToCart.value = true;
    
    setTimeout(() => {
      addedToCart.value = false;
    }, 4000);
  };
  
  const handleBuyNow = () => {
    addToCart(props.product, quantity.value);
    router.visit('/panier');
  };
  </script>
  
  <style scoped>
  /* Product Detail Section */
  .product-detail-section {
    padding: 2rem 0 4rem;
    background-color: #f8f8f8;
    font-family: 'Montserrat', 'Raleway', 'Helvetica Neue', sans-serif;
    min-height: 70vh;
  }
  
  .container {
    max-width: 1200px;
    margin: 0 auto;
    padding: 0 1.5rem;
  }
  
  /* Breadcrumb */
  .breadcrumb {
    display: flex;
    align-items: center;
    gap: 0.5rem;
    margin-bottom: 2rem;
    font-size: 0.8rem;
    color: #999;
    font-weight: 300;
  }
  
  .breadcrumb-link {
    color: #666;
    text-decoration: none;
    transition: color 0.3s ease;
  }
  
  .breadcrumb-link:hover {
    color: #333;
  }
  
  .breadcrumb-separator {
    color: #ccc;
  }
  
  .breadcrumb-current {
    color: #333;
    overflow: hidden;
    text-overflow: ellipsis;
    white-space: nowrap;
  }
  
  /* Product Grid */
  .product-grid {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 3rem;
    background: white;
    padding: 2rem;
    box-shadow: 0 2px 12px rgba(0, 0, 0, 0.05);
  }
  
  /* Image Section */
  .product-image-section {
    position: sticky;
    top: 2rem;
    align-self: start;
  }
  
  .main-image {
    width: 100%;
    overflow: hidden;
    background: #fafafa;
    border-radius: 4px;
  }
  
  .main-image img {
    width: 100%;
    height: auto;
    display: block;
    transition: transform 0.6s ease;
  }
  
  .main-image:hover img {
    transform: scale(1.05);
  }
  
  .no-image {
    width: 100%;
    height: 400px;
    display: flex;
    align-items: center;
    justify-content: center;
    background: linear-gradient(135deg, #f9f9f9 0%, #efefef 100%);
    font-size: 4rem;
  }
  
  /* Product Info Section */
  .product-info-section {
    display: flex;
    flex-direction: column;
  }
  
  .product-title {
    font-size: 1.8rem;
    font-weight: 300;
    color: #333;
    letter-spacing: 0.5px;
    margin-bottom: 1.5rem;
    line-height: 1.3;
  }
  
  .price-section {
    margin-bottom: 1.5rem;
  }
  
  .product-price {
    font-size: 1.8rem;
    font-weight: 300;
    color: #b3a090;
    letter-spacing: 0.5px;
  }
  
  .product-divider {
    width: 100%;
    height: 1px;
    background: linear-gradient(to right, transparent, #e0e0e0, transparent);
    margin: 1.5rem 0;
  }
  
  .product-description {
    font-size: 0.95rem;
    font-weight: 300;
    color: #666;
    line-height: 1.7;
    margin-bottom: 1.5rem;
  }
  
  .product-description p {
    white-space: pre-line;
  }
  
  /* Quantity Section */
  .quantity-section {
    margin-bottom: 1.5rem;
  }
  
  .quantity-label {
    display: block;
    font-size: 0.85rem;
    font-weight: 300;
    color: #666;
    letter-spacing: 0.3px;
    margin-bottom: 0.8rem;
  }
  
  .quantity-controls {
    display: flex;
    align-items: center;
    gap: 1rem;
  }
  
  .qty-btn {
    width: 35px;
    height: 35px;
    border: 1px solid #ddd;
    background: white;
    color: #555;
    cursor: pointer;
    font-size: 1.3rem;
    font-weight: 200;
    transition: all 0.2s ease;
    display: flex;
    align-items: center;
    justify-content: center;
    border-radius: 4px;
  }
  
  .qty-btn:hover {
    border-color: #999;
    background: #f9f9f9;
  }
  
  .qty-display {
    font-size: 1.1rem;
    font-weight: 300;
    color: #333;
    min-width: 35px;
    text-align: center;
  }
  
  /* Action Buttons */
  .action-buttons {
    display: flex;
    flex-direction: column;
    gap: 0.8rem;
    margin-bottom: 1.5rem;
  }
  
  .btn-add-to-cart,
  .btn-buy-now {
    width: 100%;
    padding: 0.85rem 1.5rem;
    border: none;
    border-radius: 50px;
    font-size: 0.85rem;
    font-weight: 300;
    letter-spacing: 0.5px;
    text-transform: uppercase;
    cursor: pointer;
    transition: all 0.3s ease;
    font-family: 'Montserrat', sans-serif;
  }
  
  .btn-add-to-cart {
    background: #333;
    color: white;
  }
  
  .btn-add-to-cart:hover {
    background: #000;
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
  }
  
  .btn-buy-now {
    background: white;
    color: #333;
    border: 1px solid #999;
  }
  
  .btn-buy-now:hover {
    background: #f5f5f5;
    border-color: #666;
  }
  
  /* Success Message */
  .success-message {
    padding: 1rem;
    background: white;
    border-left: 3px solid #b3a090;
    display: flex;
    align-items: center;
    gap: 0.8rem;
    font-size: 0.85rem;
    font-weight: 300;
    color: #555;
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
    margin-bottom: 1.5rem;
    animation: slideDown 0.3s ease;
    border-radius: 4px;
  }
  
  @keyframes slideDown {
    from {
      opacity: 0;
      transform: translateY(-10px);
    }
    to {
      opacity: 1;
      transform: translateY(0);
    }
  }
  
  .success-icon {
    width: 18px;
    height: 18px;
    color: #b3a090;
    flex-shrink: 0;
  }
  
  .view-cart-link {
    color: #b3a090;
    text-decoration: none;
    font-weight: 400;
    margin-left: auto;
    white-space: nowrap;
    transition: color 0.3s ease;
    font-size: 0.85rem;
  }
  
  .view-cart-link:hover {
    color: #333;
  }
  
  /* Additional Info */
  .additional-info {
    display: flex;
    gap: 1.5rem;
    padding-top: 1.5rem;
    border-top: 1px solid #f0f0f0;
  }
  
  .info-item {
    display: flex;
    align-items: center;
    gap: 0.4rem;
    font-size: 0.8rem;
    font-weight: 300;
    color: #666;
  }
  
  .info-icon {
    font-size: 1rem;
  }
  
  /* Back Section */
  .back-section {
    margin-top: 2rem;
    text-align: center;
  }
  
  .back-link {
    color: #666;
    text-decoration: none;
    font-size: 0.85rem;
    font-weight: 300;
    letter-spacing: 0.3px;
    transition: color 0.3s ease;
    display: inline-block;
  }
  
  .back-link:hover {
    color: #333;
  }
  
  /* Responsive */
  @media (max-width: 991px) {
    .product-grid {
      grid-template-columns: 1fr;
      gap: 2rem;
      padding: 1.5rem;
    }
  
    .product-title {
      font-size: 1.6rem;
    }
  
    .product-price {
      font-size: 1.6rem;
    }
  
    .product-image-section {
      position: static;
    }
  
    .no-image {
      height: 300px;
      font-size: 3rem;
    }
  }
  
  @media (max-width: 767px) {
    .product-detail-section {
      padding: 1.5rem 0 3rem;
    }
  
    .container {
      padding: 0 1rem;
    }
  
    .breadcrumb {
      margin-bottom: 1.5rem;
      font-size: 0.75rem;
    }
  
    .product-grid {
      padding: 1.2rem;
      gap: 1.5rem;
    }
  
    .product-title {
      font-size: 1.4rem;
      margin-bottom: 1rem;
    }
  
    .price-section {
      margin-bottom: 1rem;
    }
  
    .product-price {
      font-size: 1.4rem;
    }
  
    .product-divider {
      margin: 1rem 0;
    }
  
    .product-description {
      font-size: 0.9rem;
      margin-bottom: 1rem;
    }
  
    .quantity-section {
      margin-bottom: 1.2rem;
    }
  
    .qty-btn {
      width: 32px;
      height: 32px;
      font-size: 1.2rem;
    }
  
    .qty-display {
      font-size: 1rem;
    }
  
    .action-buttons {
      gap: 0.6rem;
      margin-bottom: 1.2rem;
    }
  
    .btn-add-to-cart,
    .btn-buy-now {
      padding: 0.75rem 1.2rem;
      font-size: 0.8rem;
    }
  
    .additional-info {
      flex-direction: column;
      gap: 0.8rem;
      padding-top: 1rem;
    }
  
    .info-item {
      font-size: 0.75rem;
    }
  
    .success-message {
      padding: 0.8rem;
      font-size: 0.8rem;
      gap: 0.5rem;
    }
  
    .success-icon {
      width: 16px;
      height: 16px;
    }
  
    .view-cart-link {
      font-size: 0.8rem;
    }
  
    .no-image {
      height: 250px;
      font-size: 2.5rem;
    }
  
    .back-section {
      margin-top: 1.5rem;
    }
  
    .back-link {
      font-size: 0.8rem;
    }
  }
  </style>
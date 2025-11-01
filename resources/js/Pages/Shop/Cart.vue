<template>
    <div>
      <TopNav />
      
      <!-- Hero Section -->
      <section class="cart-hero">
        <div class="container">
          <h1 class="hero-title">Votre Panier</h1>
          <div class="hero-divider"></div>
        </div>
      </section>
  
      <!-- Cart Content -->
      <section class="cart-section">
        <div class="container">
          <!-- Panier vide -->
          <div v-if="cartItems.length === 0" class="empty-cart">
            <div class="empty-icon">🛍️</div>
            <p class="empty-text">Votre panier est vide</p>
            <p class="empty-subtext">Découvrez nos produits exclusifs</p>
            <Link href="/shop" class="btn-shop">
              Découvrir la boutique
            </Link>
          </div>
  
          <!-- Panier avec produits -->
          <div v-else class="cart-grid">
            <!-- Liste des produits -->
            <div class="cart-items">
              <div
                v-for="item in cartItems"
                :key="item.id"
                class="cart-item"
              >
              <div class="item-image">
                <img
                  v-if="item.image_url"
                  :src="item.image_url"
                  :alt="item.name"
                />
                <div v-else class="no-image">📦</div>
              </div>
  
                <div class="item-details">
                  <h3 class="item-name">{{ item.name }}</h3>
                  <p class="item-price">{{ formatPrice(item.price) }}</p>
                </div>
  
                <div class="item-quantity">
                  <button
                    @click="updateQuantity(item.id, item.quantity - 1)"
                    class="qty-btn"
                  >
                    −
                  </button>
                  <span class="qty-value">{{ item.quantity }}</span>
                  <button
                    @click="updateQuantity(item.id, item.quantity + 1)"
                    class="qty-btn"
                  >
                    +
                  </button>
                </div>
  
                <div class="item-total">
                  <p class="total-price">{{ formatPrice(item.price * item.quantity) }}</p>
                </div>
  
                <button
                  @click="removeFromCart(item.id)"
                  class="item-remove"
                  title="Retirer"
                >
                  ×
                </button>
              </div>
            </div>
  
            <!-- Résumé et formulaire -->
            <div class="cart-summary-wrapper">
              <div class="cart-summary">
                <h2 class="summary-title">Résumé</h2>
                
                <div class="summary-line">
                  <span>Sous-total</span>
                  <span>{{ formatPrice(cartTotal) }}</span>
                </div>
                
                <div class="summary-line">
                  <span>Articles</span>
                  <span>{{ cartCount }}</span>
                </div>
                
                <div v-if="hasPhysicalProducts" class="summary-line">
                  <span>Livraison</span>
                  <span>{{ formatPrice(shippingCost) }}</span>
                </div>
  
                <div class="summary-divider"></div>
  
                <div class="summary-total">
                  <span>Total</span>
                  <span>{{ formatPrice(cartTotal + shippingCost) }}</span>
                </div>
  
                <!-- Formulaire -->
                <form @submit.prevent="handleCheckout" class="checkout-form">
                  <h3 class="form-section-title">Informations</h3>
                  
                  <div class="form-group">
                    <label>Nom complet</label>
                    <input
                      v-model="form.customer_name"
                      type="text"
                      required
                      placeholder="Prénom Nom"
                    />
                  </div>
  
                  <div class="form-group">
                    <label>Email</label>
                    <input
                      v-model="form.customer_email"
                      type="email"
                      required
                      placeholder="votre@email.com"
                    />
                  </div>
  
                  <!-- Adresse de livraison (si produits physiques) -->
                  <div v-if="hasPhysicalProducts" class="shipping-section">
                    <h3 class="form-section-title">Adresse de livraison</h3>
                    
                    <div class="form-group">
                      <label>Nom du destinataire</label>
                      <input
                        v-model="form.shipping_name"
                        type="text"
                        required
                        placeholder="Prénom Nom"
                      />
                    </div>
  
                    <div class="form-group">
                      <label>Adresse</label>
                      <input
                        v-model="form.shipping_address"
                        type="text"
                        required
                        placeholder="Rue et numéro"
                      />
                    </div>
  
                    <div class="form-row">
                      <div class="form-group">
                        <label>Code postal</label>
                        <input
                          v-model="form.shipping_postal_code"
                          type="text"
                          required
                          placeholder="1000"
                        />
                      </div>
                      <div class="form-group">
                        <label>Ville</label>
                        <input
                          v-model="form.shipping_city"
                          type="text"
                          required
                          placeholder="Bruxelles"
                        />
                      </div>
                    </div>
  
                    <div class="form-group">
                      <label>Pays</label>
                      <select v-model="form.shipping_country" required>
                        <option value="BE">🇧🇪 Belgique</option>
                        <option value="FR">🇫🇷 France</option>
                        <option value="NL">🇳🇱 Pays-Bas</option>
                        <option value="LU">🇱🇺 Luxembourg</option>
                        <option value="DE">🇩🇪 Allemagne</option>
                      </select>
                    </div>
  
                    <div class="form-group">
                      <label>Téléphone</label>
                      <input
                        v-model="form.shipping_phone"
                        type="tel"
                        required
                        placeholder="+32 123 45 67 89"
                      />
                    </div>
  
                    <div class="form-group">
                      <label>Notes (optionnel)</label>
                      <textarea
                        v-model="form.shipping_notes"
                        rows="2"
                        placeholder="Instructions spéciales..."
                      ></textarea>
                    </div>
                  </div>
  
                  <button
                    type="submit"
                    :disabled="loading"
                    class="btn-checkout"
                  >
                    <span v-if="loading">Traitement en cours...</span>
                    <span v-else>Procéder au paiement</span>
                  </button>
  
                  <p class="secure-text">🔒 Paiement sécurisé par Stripe</p>
                </form>
  
                <!-- Message d'erreur -->
                <div v-if="error" class="error-message">
                  {{ error }}
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
  import { ref, computed } from 'vue';
  import { Link } from '@inertiajs/vue3';
  import TopNav from '@/Components/TopNav.vue';
  import Footer from '@/Components/Footer.vue';
  import { useCart } from '@/composables/useCart';
  
  const { cartItems, cartTotal, cartCount, updateQuantity, removeFromCart, clearCart } = useCart();
  
  const form = ref({
    customer_name: '',
    customer_email: '',
    shipping_name: '',
    shipping_address: '',
    shipping_postal_code: '',
    shipping_city: '',
    shipping_country: 'BE',
    shipping_phone: '',
    shipping_notes: ''
  });
  
  const loading = ref(false);
  const error = ref(null);
  
  const hasPhysicalProducts = computed(() => {
    return cartItems.value.some(item => item.type === 'physical');
  });
  
  const shippingCost = computed(() => {
    if (!hasPhysicalProducts.value) return 0;
    return form.value.shipping_country === 'BE' ? 5.00 : 10.00;
  });
  
  const formatPrice = (price) => {
    return new Intl.NumberFormat('fr-BE', {
      style: 'currency',
      currency: 'EUR'
    }).format(price);
  };
  
  const getCsrfToken = () => {
    const token = document.querySelector('meta[name="csrf-token"]');
    return token ? token.getAttribute('content') : null;
  };
  
  const handleCheckout = async () => {
    loading.value = true;
    error.value = null;
  
    const csrfToken = getCsrfToken();
    if (!csrfToken) {
      error.value = 'Erreur de sécurité. Veuillez rafraîchir la page.';
      loading.value = false;
      return;
    }
  
    try {
      const response = await fetch('/checkout/cart', {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json',
          'Accept': 'application/json',
          'X-CSRF-TOKEN': csrfToken,
          'X-Requested-With': 'XMLHttpRequest'
        },
        body: JSON.stringify({
          items: cartItems.value,
          customer_name: form.value.customer_name,
          customer_email: form.value.customer_email,
          ...(hasPhysicalProducts.value && {
            shipping_name: form.value.shipping_name,
            shipping_address: form.value.shipping_address,
            shipping_postal_code: form.value.shipping_postal_code,
            shipping_city: form.value.shipping_city,
            shipping_country: form.value.shipping_country,
            shipping_phone: form.value.shipping_phone,
            shipping_notes: form.value.shipping_notes,
            shipping_cost: shippingCost.value
          })
        })
      });
  
      if (!response.ok) {
        const errorData = await response.json();
        throw new Error(errorData.message || 'Erreur lors de la création de la session de paiement');
      }
  
      const data = await response.json();
  
      if (data.url) {
        clearCart();
        window.location.href = data.url;
      } else {
        throw new Error('URL de paiement non reçue');
      }
    } catch (err) {
      console.error('Erreur:', err);
      error.value = err.message || 'Une erreur est survenue. Veuillez réessayer.';
      loading.value = false;
    }
  };
  </script>
  
  <style scoped>
  /* Hero Section */
  .cart-hero {
    padding: 4rem 0 2.5rem;
    background-color: #f8f8f8;
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
    color: #555;
    letter-spacing: 2px;
    margin-bottom: 1rem;
  }
  
  .hero-divider {
    width: 60px;
    height: 1px;
    background: #b3a090;
    margin: 0 auto;
  }
  
  /* Cart Section */
  .cart-section {
    padding: 4rem 0 6rem;
    background-color: #f8f8f8;
    font-family: 'Montserrat', 'Raleway', 'Helvetica Neue', sans-serif;
  }
  
  /* Empty Cart */
  .empty-cart {
    text-align: center;
    padding: 5rem 2rem;
  }
  
  .empty-icon {
    font-size: 5rem;
    margin-bottom: 2rem;
  }
  
  .empty-text {
    font-size: 1.5rem;
    font-weight: 300;
    color: #555;
    margin-bottom: 0.5rem;
  }
  
  .empty-subtext {
    font-size: 1rem;
    font-weight: 300;
    color: #777;
    margin-bottom: 2.5rem;
  }
  
  .btn-shop {
    display: inline-block;
    padding: 0.9rem 2.5rem;
    background: #333;
    color: white;
    text-decoration: none;
    border-radius: 50px;
    font-size: 0.9rem;
    font-weight: 300;
    letter-spacing: 1px;
    transition: all 0.3s ease;
  }
  
  .btn-shop:hover {
    background: #000;
    transform: translateY(-2px);
  }
  
  /* Cart Grid */
  .cart-grid {
    display: grid;
    grid-template-columns: 1fr 400px;
    gap: 3rem;
  }
  
  /* Cart Items */
  .cart-items {
    display: flex;
    flex-direction: column;
    gap: 1.5rem;
  }
  
  .cart-item {
    background: white;
    padding: 2rem;
    display: grid;
    grid-template-columns: 100px 1fr auto auto auto;
    align-items: center;
    gap: 2rem;
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
    transition: box-shadow 0.3s ease;
  }
  
  .cart-item:hover {
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
  }
  
  .item-image {
    width: 100px;
    height: 100px;
    overflow: hidden;
  }
  
  .item-image img {
    width: 100%;
    height: 100%;
    object-fit: cover;
  }
  
  .no-image {
    width: 100%;
    height: 100%;
    background: #f5f5f5;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 2.5rem;
  }
  
  .item-details {
    flex: 1;
  }
  
  .item-name {
    font-size: 1.1rem;
    font-weight: 300;
    color: #333;
    margin-bottom: 0.5rem;
    letter-spacing: 0.5px;
  }
  
  .item-price {
    font-size: 0.95rem;
    font-weight: 300;
    color: #777;
  }
  
  /* Quantity Controls */
  .item-quantity {
    display: flex;
    align-items: center;
    gap: 1rem;
  }
  
  .qty-btn {
    width: 32px;
    height: 32px;
    border: 1px solid #ddd;
    background: white;
    color: #555;
    cursor: pointer;
    font-size: 1.2rem;
    font-weight: 300;
    transition: all 0.2s ease;
    display: flex;
    align-items: center;
    justify-content: center;
  }
  
  .qty-btn:hover {
    border-color: #999;
    background: #f9f9f9;
  }
  
  .qty-value {
    font-size: 1rem;
    font-weight: 300;
    color: #333;
    min-width: 30px;
    text-align: center;
  }
  
  .item-total {
    min-width: 100px;
    text-align: right;
  }
  
  .total-price {
    font-size: 1.2rem;
    font-weight: 300;
    color: #b3a090;
    letter-spacing: 0.5px;
  }
  
  .item-remove {
    width: 32px;
    height: 32px;
    border: none;
    background: transparent;
    color: #999;
    cursor: pointer;
    font-size: 2rem;
    font-weight: 200;
    line-height: 1;
    transition: color 0.2s ease;
  }
  
  .item-remove:hover {
    color: #333;
  }
  
  /* Cart Summary */
  .cart-summary-wrapper {
    position: sticky;
    top: 2rem;
  }
  
  .cart-summary {
    background: white;
    padding: 2rem;
    box-shadow: 0 2px 15px rgba(0, 0, 0, 0.06);
  }
  
  .summary-title {
    font-size: 1.5rem;
    font-weight: 300;
    color: #333;
    margin-bottom: 1.5rem;
    letter-spacing: 1px;
  }
  
  .summary-line {
    display: flex;
    justify-content: space-between;
    padding: 0.8rem 0;
    font-size: 0.95rem;
    font-weight: 300;
    color: #666;
  }
  
  .summary-divider {
    height: 1px;
    background: linear-gradient(to right, transparent, #e0e0e0, transparent);
    margin: 1.5rem 0;
  }
  
  .summary-total {
    display: flex;
    justify-content: space-between;
    padding: 1rem 0;
    font-size: 1.3rem;
    font-weight: 300;
    color: #333;
    letter-spacing: 0.5px;
  }
  
  /* Checkout Form */
  .checkout-form {
    margin-top: 2rem;
  }
  
  .form-section-title {
    font-size: 1.1rem;
    font-weight: 300;
    color: #555;
    margin: 2rem 0 1.5rem;
    letter-spacing: 0.5px;
    padding-bottom: 0.5rem;
    border-bottom: 1px solid #f0f0f0;
  }
  
  .form-section-title:first-child {
    margin-top: 0;
  }
  
  .form-group {
    margin-bottom: 1.2rem;
  }
  
  .form-group label {
    display: block;
    font-size: 0.85rem;
    font-weight: 300;
    color: #666;
    margin-bottom: 0.5rem;
    letter-spacing: 0.3px;
  }
  
  .form-group input,
  .form-group select,
  .form-group textarea {
    width: 100%;
    padding: 0.8rem 1rem;
    border: 1px solid #e0e0e0;
    background: #fafafa;
    font-size: 0.9rem;
    font-weight: 300;
    color: #333;
    transition: all 0.3s ease;
    font-family: 'Montserrat', sans-serif;
  }
  
  .form-group input:focus,
  .form-group select:focus,
  .form-group textarea:focus {
    outline: none;
    border-color: #b3a090;
    background: white;
  }
  
  .form-row {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 1rem;
  }
  
  .shipping-section {
    margin-top: 1.5rem;
    padding-top: 1.5rem;
    border-top: 1px solid #f0f0f0;
  }
  
  .btn-checkout {
    width: 100%;
    padding: 1rem;
    background: #333;
    color: white;
    border: none;
    border-radius: 50px;
    font-size: 0.9rem;
    font-weight: 300;
    letter-spacing: 1px;
    cursor: pointer;
    transition: all 0.3s ease;
    margin-top: 1.5rem;
    font-family: 'Montserrat', sans-serif;
    text-transform: uppercase;
  }
  
  .btn-checkout:hover:not(:disabled) {
    background: #000;
    transform: translateY(-2px);
  }
  
  .btn-checkout:disabled {
    opacity: 0.6;
    cursor: not-allowed;
  }
  
  .secure-text {
    text-align: center;
    font-size: 0.8rem;
    color: #999;
    margin-top: 1rem;
    font-weight: 300;
  }
  
  .error-message {
    margin-top: 1rem;
    padding: 1rem;
    background: #fee;
    border-left: 3px solid #c33;
    color: #c33;
    font-size: 0.85rem;
    font-weight: 300;
  }
  
  /* Responsive */
  @media (max-width: 991px) {
    .hero-title {
      font-size: 2.5rem;
    }
  
    .cart-grid {
      grid-template-columns: 1fr;
      gap: 2rem;
    }
  
    .cart-item {
      grid-template-columns: 80px 1fr;
      gap: 1rem;
    }
  
    .item-quantity {
      grid-column: 1 / -1;
      justify-content: center;
      margin-top: 1rem;
    }
  
    .item-total {
      position: absolute;
      top: 1rem;
      right: 3rem;
    }
  
    .item-remove {
      position: absolute;
      top: 1rem;
      right: 1rem;
    }
  
    .cart-summary-wrapper {
      position: static;
    }
  }
  
  @media (max-width: 767px) {
    .hero-title {
      font-size: 2rem;
    }
  
    .cart-section {
      padding: 3rem 0 4rem;
    }
  
    .cart-item {
      padding: 1.5rem;
      position: relative;
    }
  
    .item-image {
      width: 70px;
      height: 70px;
    }
  
    .item-name {
      font-size: 1rem;
    }
  
    .form-row {
      grid-template-columns: 1fr;
    }
  }
  </style>
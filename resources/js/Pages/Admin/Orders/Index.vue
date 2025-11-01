<template>
    <div>
      <TopNav />
      
      <section class="admin-section">
        <div class="container">
          <!-- Header -->
          <div class="page-header">
            <Link href="/admin" class="back-link">← Retour</Link>
            <h1 class="page-title">Commandes</h1>
          </div>
          <div class="page-divider"></div>
  
          <!-- Filtres -->
          <div class="filters">
            <Link 
              :href="`/admin/orders?filter=all`"
              :class="['filter-btn', filter === 'all' && 'active']"
            >
              Toutes
            </Link>
            
            <Link 
              :href="`/admin/orders?filter=to_ship`"
              :class="['filter-btn', filter === 'to_ship' && 'active']"
            >
              À expédier
            </Link>
            
            <Link 
              :href="`/admin/orders?filter=physical`"
              :class="['filter-btn', filter === 'physical' && 'active']"
            >
              Physiques
            </Link>
            
            <Link 
              :href="`/admin/orders?filter=digital`"
              :class="['filter-btn', filter === 'digital' && 'active']"
            >
              Digitales
            </Link>
          </div>
  
          <!-- Message succès -->
          <div v-if="$page.props.flash?.success" class="success-message">
            {{ $page.props.flash.success }}
          </div>
  
          <!-- Liste des commandes -->
          <div v-if="orders.data.length === 0" class="empty-state">
            <p>Aucune commande</p>
          </div>
  
          <div v-else class="orders-list">
            <div v-for="order in orders.data" :key="order.id" class="order-card">
              <div class="order-header">
                <div>
                  <h3 class="order-number">#{{ order.order_number }}</h3>
                  <p class="order-customer">{{ order.customer_name }}</p>
                </div>
                <span class="order-price">{{ formatPrice(order.amount) }}</span>
              </div>
  
              <div class="order-divider"></div>
  
              <!-- Produits -->
              <div class="order-products">
                <p class="section-label">Produits</p>
                <ul>
                  <li v-for="item in order.items" :key="item.id" class="product-item">
                    {{ item.product.name }} ×{{ item.quantity }}
                    <span class="product-type">
                      {{ item.product.type === 'digital' ? 'Digital' : 'Physique' }}
                    </span>
                  </li>
                </ul>
              </div>
  
              <!-- Adresse si physique -->
              <div v-if="hasPhysicalProducts(order)" class="order-address">
                <p class="section-label">Adresse</p>
                <p class="address-text">
                  {{ order.shipping_name }}<br>
                  {{ order.shipping_address }}<br>
                  {{ order.shipping_postal_code }} {{ order.shipping_city }}
                </p>
              </div>
  
              <!-- Actions -->
              <div class="order-actions">
                <button
                  v-if="hasPhysicalProducts(order) && !order.shipped_at"
                  @click="openShippingModal(order)"
                  class="btn-ship"
                >
                  Marquer expédiée
                </button>
                
                <Link :href="`/admin/orders/${order.id}`" class="btn-details">
                  Détails
                </Link>
              </div>
            </div>
          </div>
        </div>
      </section>
  
      <!-- Modal Tracking -->
      <div v-if="showShippingModal" class="modal-overlay" @click="closeShippingModal">
        <div class="modal-content" @click.stop>
          <h3 class="modal-title">Marquer comme expédiée</h3>
          
          <form @submit.prevent="submitShipping">
            <div class="form-group">
              <label>Numéro de suivi</label>
              <input
                v-model="trackingNumber"
                type="text"
                required
                placeholder="3SBEL123456789"
              />
            </div>
  
            <div class="modal-actions">
              <button type="button" @click="closeShippingModal" class="btn-cancel">
                Annuler
              </button>
              <button type="submit" class="btn-confirm">
                Confirmer
              </button>
            </div>
          </form>
        </div>
      </div>
  
      <Footer />
    </div>
  </template>
  
  <script setup>
  import { ref } from 'vue';
  import { Link, router } from '@inertiajs/vue3';
  import TopNav from '@/Components/TopNav.vue';
  import Footer from '@/Components/Footer.vue';
  
  defineProps({
    orders: Object,
    filter: String
  });
  
  const showShippingModal = ref(false);
  const selectedOrder = ref(null);
  const trackingNumber = ref('');
  
  const hasPhysicalProducts = (order) => {
    return order.items.some(item => item.product.type === 'physical');
  };
  
  const formatPrice = (price) => {
    return new Intl.NumberFormat('fr-BE', {
      style: 'currency',
      currency: 'EUR'
    }).format(price);
  };
  
  const openShippingModal = (order) => {
    selectedOrder.value = order;
    trackingNumber.value = '';
    showShippingModal.value = true;
  };
  
  const closeShippingModal = () => {
    showShippingModal.value = false;
    selectedOrder.value = null;
    trackingNumber.value = '';
  };
  
  const submitShipping = () => {
    router.post(`/admin/orders/${selectedOrder.value.id}/ship`, {
      tracking_number: trackingNumber.value
    }, {
      onSuccess: () => {
        closeShippingModal();
      }
    });
  };
  </script>
  
  <style scoped>
  .admin-section {
    padding: 3rem 0 6rem;
    background-color: #f8f8f8;
    font-family: 'Montserrat', 'Raleway', 'Helvetica Neue', sans-serif;
    min-height: 80vh;
  }
  
  .container {
    max-width: 1200px;
    margin: 0 auto;
    padding: 0 2rem;
  }
  
  .page-header {
    display: flex;
    align-items: center;
    gap: 1.5rem;
    margin-bottom: 1rem;
  }
  
  .back-link {
    color: #666;
    text-decoration: none;
    font-size: 0.9rem;
    font-weight: 300;
    transition: color 0.3s ease;
  }
  
  .back-link:hover {
    color: #333;
  }
  
  .page-title {
    font-size: 2.5rem;
    font-weight: 300;
    color: #333;
    letter-spacing: 1px;
  }
  
  .page-divider {
    width: 60px;
    height: 1px;
    background: #b3a090;
    margin-bottom: 3rem;
  }
  
  /* Filtres */
  .filters {
    display: flex;
    gap: 1rem;
    margin-bottom: 2rem;
    flex-wrap: wrap;
  }
  
  .filter-btn {
    padding: 0.7rem 1.5rem;
    background: white;
    color: #666;
    text-decoration: none;
    font-size: 0.9rem;
    font-weight: 300;
    letter-spacing: 0.5px;
    transition: all 0.3s ease;
  }
  
  .filter-btn.active {
    background: #333;
    color: white;
  }
  
  .filter-btn:hover {
    background: #f5f5f5;
  }
  
  .filter-btn.active:hover {
    background: #000;
  }
  
  /* Success Message */
  .success-message {
    padding: 1rem 1.5rem;
    background: white;
    border-left: 3px solid #b3a090;
    color: #555;
    margin-bottom: 2rem;
    font-size: 0.9rem;
    font-weight: 300;
  }
  
  /* Empty State */
  .empty-state {
    text-align: center;
    padding: 4rem 2rem;
    background: white;
  }
  
  .empty-state p {
    font-size: 1.1rem;
    font-weight: 300;
    color: #999;
  }
  
  /* Orders List */
  .orders-list {
    display: flex;
    flex-direction: column;
    gap: 1.5rem;
  }
  
  .order-card {
    background: white;
    padding: 2rem;
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
  }
  
  .order-header {
    display: flex;
    justify-content: space-between;
    align-items: flex-start;
    margin-bottom: 1.5rem;
  }
  
  .order-number {
    font-size: 1.2rem;
    font-weight: 300;
    color: #333;
    margin-bottom: 0.3rem;
  }
  
  .order-customer {
    font-size: 0.9rem;
    font-weight: 300;
    color: #666;
  }
  
  .order-price {
    font-size: 1.3rem;
    font-weight: 300;
    color: #b3a090;
  }
  
  .order-divider {
    height: 1px;
    background: #f0f0f0;
    margin: 1.5rem 0;
  }
  
  .section-label {
    font-size: 0.85rem;
    font-weight: 400;
    color: #999;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    margin-bottom: 0.8rem;
  }
  
  /* Products */
  .order-products {
    margin-bottom: 1.5rem;
  }
  
  .order-products ul {
    list-style: none;
    padding: 0;
    margin: 0;
  }
  
  .product-item {
    padding: 0.5rem 0;
    font-size: 0.9rem;
    font-weight: 300;
    color: #666;
    border-bottom: 1px solid #f5f5f5;
  }
  
  .product-type {
    font-size: 0.8rem;
    color: #999;
    margin-left: 0.5rem;
  }
  
  /* Address */
  .order-address {
    margin-bottom: 1.5rem;
  }
  
  .address-text {
    font-size: 0.9rem;
    font-weight: 300;
    color: #666;
    line-height: 1.6;
  }
  
  /* Actions */
  .order-actions {
    display: flex;
    gap: 0.8rem;
  }
  
  .btn-ship,
  .btn-details {
    padding: 0.7rem 1.5rem;
    font-size: 0.85rem;
    font-weight: 300;
    letter-spacing: 0.5px;
    text-decoration: none;
    border: none;
    cursor: pointer;
    transition: all 0.3s ease;
  }
  
  .btn-ship {
    background: #333;
    color: white;
  }
  
  .btn-ship:hover {
    background: #000;
  }
  
  .btn-details {
    background: white;
    color: #666;
    border: 1px solid #ddd;
  }
  
  .btn-details:hover {
    background: #f5f5f5;
  }
  
  /* Modal */
  .modal-overlay {
    position: fixed;
    inset: 0;
    background: rgba(0, 0, 0, 0.5);
    display: flex;
    align-items: center;
    justify-content: center;
    z-index: 1000;
  }
  
  .modal-content {
    background: white;
    padding: 2.5rem;
    max-width: 500px;
    width: 90%;
  }
  
  .modal-title {
    font-size: 1.5rem;
    font-weight: 300;
    color: #333;
    margin-bottom: 2rem;
  }
  
  .form-group {
    margin-bottom: 2rem;
  }
  
  .form-group label {
    display: block;
    font-size: 0.9rem;
    font-weight: 300;
    color: #666;
    margin-bottom: 0.8rem;
  }
  
  .form-group input {
    width: 100%;
    padding: 0.8rem 1rem;
    border: 1px solid #ddd;
    font-size: 0.9rem;
    font-weight: 300;
    font-family: 'Montserrat', sans-serif;
  }
  
  .form-group input:focus {
    outline: none;
    border-color: #b3a090;
  }
  
  .modal-actions {
    display: flex;
    gap: 1rem;
    justify-content: flex-end;
  }
  
  .btn-cancel,
  .btn-confirm {
    padding: 0.8rem 1.5rem;
    font-size: 0.9rem;
    font-weight: 300;
    border: none;
    cursor: pointer;
    transition: all 0.3s ease;
    font-family: 'Montserrat', sans-serif;
  }
  
  .btn-cancel {
    background: white;
    color: #666;
    border: 1px solid #ddd;
  }
  
  .btn-cancel:hover {
    background: #f5f5f5;
  }
  
  .btn-confirm {
    background: #333;
    color: white;
  }
  
  .btn-confirm:hover {
    background: #000;
  }
  
  /* Responsive */
  @media (max-width: 767px) {
    .page-title {
      font-size: 2rem;
    }
  
    .filters {
      flex-direction: column;
    }
  
    .filter-btn {
      text-align: center;
    }
  
    .order-header {
      flex-direction: column;
      gap: 0.5rem;
    }
  
    .order-actions {
      flex-direction: column;
    }
  }
  </style>
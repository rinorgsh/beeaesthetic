<template>
    <div>
      <TopNav />
      
      <section class="purchases-section">
        <div class="container">
          <h1 class="page-title">Mes achats</h1>
          <div class="page-divider"></div>
          
          <div v-if="purchases.length === 0" class="empty-state">
            <p>Vous n'avez pas encore acheté de produits.</p>
            <Link href="/products" class="btn-primary">Voir les produits</Link>
          </div>
          
          <div v-else class="purchases-grid">
            <div v-for="purchase in purchases" :key="purchase.id" class="purchase-card">
              <img 
                :src="purchase.product.image_url" 
                :alt="purchase.product.name"
                class="product-image"
              />
              
              <div class="purchase-info">
                <h3>{{ purchase.product.name }}</h3>
                <p class="purchase-date">Acheté le {{ formatDate(purchase.created_at) }}</p>
                <p class="purchase-price">{{ purchase.amount }} €</p>
                
                <div class="download-section">
                  <p class="download-count">
                    Téléchargements : {{ purchase.download_count }} / {{ purchase.max_downloads }}
                  </p>
                  
                  <button 
                    @click="downloadProduct(purchase.product.id)"
                    :disabled="!canDownload(purchase) || isDownloading"
                    class="btn-download"
                  >
                    <span v-if="isDownloading">⏳ Génération du lien...</span>
                    <span v-else-if="!canDownload(purchase)">❌ Limite atteinte</span>
                    <span v-else>📥 Télécharger</span>
                  </button>
                </div>
  
                <p v-if="downloadError" class="error-message">{{ downloadError }}</p>
                <p v-if="downloadSuccess" class="success-message">{{ downloadSuccess }}</p>
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
  import axios from 'axios';
  
  const props = defineProps({
    purchases: {
      type: Array,
      required: true
    }
  });
  
  const isDownloading = ref(false);
  const downloadError = ref('');
  const downloadSuccess = ref('');
  
  const canDownload = (purchase) => {
    if (purchase.download_count >= purchase.max_downloads) {
      return false;
    }
    if (purchase.expires_at && new Date(purchase.expires_at) < new Date()) {
      return false;
    }
    return true;
  };
  
  const formatDate = (dateString) => {
    const date = new Date(dateString);
    return date.toLocaleDateString('fr-FR', {
      year: 'numeric',
      month: 'long',
      day: 'numeric'
    });
  };
  
  const downloadProduct = async (productId) => {
    isDownloading.value = true;
    downloadError.value = '';
    downloadSuccess.value = '';
    
    try {
      const response = await axios.get(`/products/${productId}/download`);
      
      if (response.data.success && response.data.download_url) {
        // Ouvrir le lien de téléchargement dans un nouvel onglet
        window.open(response.data.download_url, '_blank');
        
        downloadSuccess.value = response.data.message;
        
        // Recharger la page après 2 secondes pour mettre à jour le compteur
        setTimeout(() => {
          window.location.reload();
        }, 2000);
      }
    } catch (error) {
      console.error('Erreur de téléchargement:', error);
      downloadError.value = error.response?.data?.error || 'Une erreur est survenue lors du téléchargement.';
    } finally {
      isDownloading.value = false;
    }
  };
  </script>
  
  <style scoped>
  .purchases-section {
    padding: 4rem 0 6rem;
    background-color: #f8f8f8;
    font-family: 'Montserrat', sans-serif;
    min-height: 80vh;
  }
  
  .container {
    max-width: 1200px;
    margin: 0 auto;
    padding: 0 2rem;
  }
  
  .page-title {
    font-size: 2.5rem;
    font-weight: 300;
    color: #333;
    letter-spacing: 1px;
    margin-bottom: 1rem;
  }
  
  .page-divider {
    width: 60px;
    height: 1px;
    background: #b3a090;
    margin-bottom: 3rem;
  }
  
  .empty-state {
    text-align: center;
    padding: 4rem 2rem;
    background: white;
    border-radius: 8px;
  }
  
  .empty-state p {
    font-size: 1.1rem;
    color: #666;
    margin-bottom: 2rem;
  }
  
  .btn-primary {
    display: inline-block;
    padding: 1rem 2rem;
    background: #333;
    color: white;
    text-decoration: none;
    border-radius: 50px;
    transition: all 0.3s ease;
  }
  
  .btn-primary:hover {
    background: #000;
    transform: translateY(-2px);
  }
  
  .purchases-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
    gap: 2rem;
  }
  
  .purchase-card {
    background: white;
    border-radius: 8px;
    overflow: hidden;
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
    transition: transform 0.3s ease;
  }
  
  .purchase-card:hover {
    transform: translateY(-5px);
  }
  
  .product-image {
    width: 100%;
    height: 200px;
    object-fit: cover;
  }
  
  .purchase-info {
    padding: 1.5rem;
  }
  
  .purchase-info h3 {
    font-size: 1.3rem;
    font-weight: 400;
    color: #333;
    margin-bottom: 0.5rem;
  }
  
  .purchase-date {
    font-size: 0.9rem;
    color: #999;
    margin-bottom: 0.5rem;
  }
  
  .purchase-price {
    font-size: 1.2rem;
    font-weight: 600;
    color: #b3a090;
    margin-bottom: 1rem;
  }
  
  .download-section {
    margin-top: 1.5rem;
    padding-top: 1.5rem;
    border-top: 1px solid #f0f0f0;
  }
  
  .download-count {
    font-size: 0.9rem;
    color: #666;
    margin-bottom: 1rem;
  }
  
  .btn-download {
    width: 100%;
    padding: 0.9rem;
    background: #333;
    color: white;
    border: none;
    border-radius: 50px;
    cursor: pointer;
    font-size: 0.95rem;
    font-weight: 500;
    transition: all 0.3s ease;
    font-family: 'Montserrat', sans-serif;
  }
  
  .btn-download:hover:not(:disabled) {
    background: #000;
  }
  
  .btn-download:disabled {
    background: #ccc;
    cursor: not-allowed;
    opacity: 0.6;
  }
  
  .error-message {
    color: #e74c3c;
    font-size: 0.85rem;
    margin-top: 0.5rem;
  }
  
  .success-message {
    color: #27ae60;
    font-size: 0.85rem;
    margin-top: 0.5rem;
  }
  
  @media (max-width: 768px) {
    .purchases-grid {
      grid-template-columns: 1fr;
    }
    
    .page-title {
      font-size: 2rem;
    }
  }
  </style>
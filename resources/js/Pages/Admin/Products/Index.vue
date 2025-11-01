<template>
    <div>
      <TopNav />
      
      <section class="admin-section">
        <div class="container">
          <!-- Header -->
          <div class="page-header">
            <Link href="/admin" class="back-link">← Retour</Link>
            <h1 class="page-title">Produits</h1>
            <Link href="/admin/products/create" class="btn-add">
              + Ajouter
            </Link>
          </div>
          <div class="page-divider"></div>
  
          <!-- Message succès -->
          <div v-if="$page.props.flash?.success" class="success-message">
            {{ $page.props.flash.success }}
          </div>
  
          <!-- Liste des produits -->
          <div v-if="products.length === 0" class="empty-state">
            <p>Aucun produit</p>
            <Link href="/admin/products/create" class="btn-create-first">
              Créer le premier produit
            </Link>
          </div>
  
          <div v-else class="products-grid">
            <div v-for="product in products" :key="product.id" class="product-card">
              <!-- Image -->
              <div class="product-image-wrapper">
                <img
                  v-if="product.image"
                  :src="`/storage/${product.image}`"
                  :alt="product.name"
                  class="product-image"
                />
                <div v-else class="no-image">📦</div>
              </div>
  
              <!-- Info -->
              <div class="product-info">
                <h3 class="product-name">{{ product.name }}</h3>
                <p class="product-price">{{ product.formatted_price }}</p>
                
                <div class="product-badges">
                  <span :class="['badge', product.type === 'digital' ? 'badge-digital' : 'badge-physical']">
                    {{ product.type === 'digital' ? 'Digital' : 'Physique' }}
                  </span>
                  <span :class="['badge', product.is_active ? 'badge-active' : 'badge-inactive']">
                    {{ product.is_active ? 'Actif' : 'Inactif' }}
                  </span>
                </div>
  
                <!-- Actions -->
                <div class="product-actions">
                  <Link :href="`/admin/products/${product.id}/edit`" class="btn-edit">
                    Modifier
                  </Link>
                  <button @click="deleteProduct(product.id)" class="btn-delete">
                    Supprimer
                  </button>
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
  import { Link, router } from '@inertiajs/vue3';
  import TopNav from '@/Components/TopNav.vue';
  import Footer from '@/Components/Footer.vue';
  
  defineProps({
    products: Array
  });
  
  const deleteProduct = (id) => {
    if (confirm('Supprimer ce produit ?')) {
      router.delete(`/admin/products/${id}`);
    }
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
    flex: 1;
  }
  
  .btn-add {
    padding: 0.8rem 2rem;
    background: #333;
    color: white;
    text-decoration: none;
    font-size: 0.9rem;
    font-weight: 300;
    letter-spacing: 0.5px;
    border-radius: 50px;
    transition: all 0.3s ease;
  }
  
  .btn-add:hover {
    background: #000;
    transform: translateY(-2px);
  }
  
  .page-divider {
    width: 60px;
    height: 1px;
    background: #b3a090;
    margin-bottom: 3rem;
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
    margin-bottom: 2rem;
  }
  
  .btn-create-first {
    display: inline-block;
    padding: 0.8rem 2rem;
    background: #333;
    color: white;
    text-decoration: none;
    font-size: 0.9rem;
    font-weight: 300;
    border-radius: 50px;
    transition: all 0.3s ease;
  }
  
  .btn-create-first:hover {
    background: #000;
  }
  
  /* Products Grid */
  .products-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
    gap: 2rem;
  }
  
  .product-card {
    background: white;
    overflow: hidden;
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
    transition: transform 0.3s ease, box-shadow 0.3s ease;
  }
  
  .product-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 8px 25px rgba(0, 0, 0, 0.1);
  }
  
  .product-image-wrapper {
    width: 100%;
    height: 200px;
    overflow: hidden;
    background: #f5f5f5;
  }
  
  .product-image {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform 0.5s ease;
  }
  
  .product-card:hover .product-image {
    transform: scale(1.05);
  }
  
  .no-image {
    width: 100%;
    height: 100%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 3rem;
    background: linear-gradient(135deg, #f5f5f5 0%, #e0e0e0 100%);
  }
  
  /* Product Info */
  .product-info {
    padding: 1.5rem;
  }
  
  .product-name {
    font-size: 1.2rem;
    font-weight: 300;
    color: #333;
    margin-bottom: 0.8rem;
    line-height: 1.3;
  }
  
  .product-price {
    font-size: 1.3rem;
    font-weight: 300;
    color: #b3a090;
    margin-bottom: 1rem;
  }
  
  /* Badges */
  .product-badges {
    display: flex;
    gap: 0.5rem;
    margin-bottom: 1.2rem;
  }
  
  .badge {
    padding: 0.3rem 0.8rem;
    font-size: 0.75rem;
    font-weight: 400;
    letter-spacing: 0.3px;
    text-transform: uppercase;
  }
  
  .badge-digital {
    background: #e3f2fd;
    color: #1976d2;
  }
  
  .badge-physical {
    background: #f3e5f5;
    color: #7b1fa2;
  }
  
  .badge-active {
    background: #e8f5e9;
    color: #2e7d32;
  }
  
  .badge-inactive {
    background: #ffebee;
    color: #c62828;
  }
  
  /* Actions */
  .product-actions {
    display: flex;
    gap: 0.5rem;
  }
  
  .btn-edit,
  .btn-delete {
    flex: 1;
    padding: 0.7rem 1rem;
    font-size: 0.85rem;
    font-weight: 300;
    text-decoration: none;
    text-align: center;
    border: none;
    cursor: pointer;
    transition: all 0.3s ease;
    font-family: 'Montserrat', sans-serif;
  }
  
  .btn-edit {
    background: #333;
    color: white;
  }
  
  .btn-edit:hover {
    background: #000;
  }
  
  .btn-delete {
    background: white;
    color: #c62828;
    border: 1px solid #ddd;
  }
  
  .btn-delete:hover {
    background: #ffebee;
    border-color: #c62828;
  }
  
  /* Responsive */
  @media (max-width: 767px) {
    .page-header {
      flex-wrap: wrap;
    }
  
    .page-title {
      font-size: 2rem;
      flex: none;
      width: 100%;
    }
  
    .btn-add {
      width: 100%;
      text-align: center;
    }
  
    .products-grid {
      grid-template-columns: 1fr;
    }
  }
  </style>
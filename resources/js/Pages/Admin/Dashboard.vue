<template>
  <div>
    <TopNav />
    
    <section class="admin-section">
      <div class="container">
        <!-- Header avec titre et bouton logout -->
        <div class="admin-header">
          <h1 class="page-title">Dashboard Admin</h1>
          <form @submit.prevent="logout" class="logout-form">
            <button type="submit" class="logout-btn">
              <span class="logout-icon">🔓</span>
              Se déconnecter
            </button>
          </form>
        </div>
        
        <div class="page-divider"></div>

        <!-- Statistiques -->
        <div class="stats-grid">
          <div class="stat-card">
            <span class="stat-number">{{ stats.total_products }}</span>
            <span class="stat-label">Produits</span>
          </div>
          
          <div class="stat-card">
            <span class="stat-number">{{ stats.active_products }}</span>
            <span class="stat-label">Actifs</span>
          </div>
          
          <div class="stat-card">
            <span class="stat-number">{{ stats.inactive_products }}</span>
            <span class="stat-label">Inactifs</span>
          </div>
        </div>

        <!-- Cartes principales -->
        <div class="cards-grid">
          <Link href="/admin/products" class="admin-card">
            <h2 class="card-title">Produits</h2>
            <p class="card-description">Gérez vos e-books et produits</p>
          </Link>

          <Link href="/admin/orders" class="admin-card">
            <h2 class="card-title">Commandes</h2>
            <p class="card-description">Suivez les commandes et expéditions</p>
          </Link>

          <Link href="/" class="admin-card">
            <h2 class="card-title">Retour au site</h2>
            <p class="card-description">Voir le site public</p>
          </Link>
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
  stats: Object
});

const logout = () => {
  router.post(route('logout'));
};
</script>

<style scoped>
.admin-section {
  padding: 4rem 0 6rem;
  background-color: #f8f8f8;
  font-family: 'Montserrat', 'Raleway', 'Helvetica Neue', sans-serif;
  min-height: 80vh;
}

.container {
  max-width: 1200px;
  margin: 0 auto;
  padding: 0 2rem;
}

/* Header avec logout */
.admin-header {
  display: flex;
  justify-content: space-between;
  align-items: center;
  margin-bottom: 1rem;
  flex-wrap: wrap;
  gap: 1rem;
}

.page-title {
  font-size: 2.5rem;
  font-weight: 300;
  color: #333;
  letter-spacing: 1px;
  margin: 0;
}

.logout-form {
  margin: 0;
}

.logout-btn {
  display: inline-flex;
  align-items: center;
  gap: 0.5rem;
  padding: 0.8rem 1.8rem;
  border: 1px solid #999;
  border-radius: 50px;
  background: transparent;
  color: #555;
  font-size: 0.9rem;
  font-weight: 400;
  letter-spacing: 0.5px;
  cursor: pointer;
  transition: all 0.3s ease;
  font-family: 'Montserrat', sans-serif;
}

.logout-btn:hover {
  background-color: rgba(0, 0, 0, 0.05);
  transform: translateY(-2px);
}

.logout-icon {
  font-size: 1rem;
}

.page-divider {
  width: 60px;
  height: 1px;
  background: #b3a090;
  margin: 0 auto 3rem;
}

/* Stats Grid */
.stats-grid {
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
  gap: 1.5rem;
  margin-bottom: 3rem;
}

.stat-card {
  background: white;
  padding: 2rem;
  text-align: center;
  box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
  transition: transform 0.3s ease;
}

.stat-card:hover {
  transform: translateY(-3px);
}

.stat-number {
  display: block;
  font-size: 2.5rem;
  font-weight: 300;
  color: #b3a090;
  margin-bottom: 0.5rem;
}

.stat-label {
  display: block;
  font-size: 0.9rem;
  font-weight: 300;
  color: #666;
  text-transform: uppercase;
  letter-spacing: 1px;
}

/* Cards Grid */
.cards-grid {
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
  gap: 2rem;
}

.admin-card {
  background: white;
  padding: 3rem 2rem;
  text-align: center;
  text-decoration: none;
  box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
  transition: all 0.3s ease;
}

.admin-card:hover {
  transform: translateY(-5px);
  box-shadow: 0 8px 25px rgba(0, 0, 0, 0.1);
}

.card-title {
  font-size: 1.5rem;
  font-weight: 300;
  color: #333;
  margin-bottom: 1rem;
  letter-spacing: 0.5px;
}

.card-description {
  font-size: 0.95rem;
  font-weight: 300;
  color: #666;
  line-height: 1.6;
}

/* Responsive */
@media (max-width: 767px) {
  .admin-header {
    flex-direction: column;
    align-items: flex-start;
  }

  .page-title {
    font-size: 2rem;
  }

  .logout-btn {
    width: 100%;
    justify-content: center;
  }

  .stats-grid {
    grid-template-columns: 1fr;
  }

  .cards-grid {
    grid-template-columns: 1fr;
  }
}
</style>
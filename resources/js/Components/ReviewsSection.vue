<template>
    <section class="reviews-section">
      <div class="container">
        <!-- En-tête de la section -->
        <div class="reviews-header">
          <h2 class="reviews-title">{{ t.reviews.title }}</h2>
          <p class="reviews-subtitle">{{ t.reviews.subtitle }}</p>
        </div>
        
        <!-- Widget Google Reviews (Elfsight ou autre) -->
        <div class="reviews-widget-container">
          <!--
            INSTRUCTIONS :
            1. Créez votre widget sur Elfsight.com ou POWR.io
            2. Copiez le code fourni (2 lignes généralement)
            3. Collez-le ici en remplacement de ce commentaire

            Exemple Elfsight :
            <script src="https://static.elfsight.com/platform/platform.js" async></script>
            <div class="elfsight-app-xxxxx-xxxxx"></div>

            Exemple POWR :
            <script src="https://www.powr.io/powr.js"></script>
            <div class="powr-google-reviews" id="xxxxx"></div>
          -->

          <!-- Elfsight Google Reviews -->
          <div class="elfsight-app-0d6471fc-81c6-4051-b5fd-d00fe316727e" data-elfsight-app-lazy></div>
        </div>
        
        <!-- Bouton pour voir plus d'avis ou laisser un avis -->
        <div class="reviews-button-container">
        <button @click="openModal" class="reviews-button">{{ t.reviews.share_experience }}</button>
      </div>
      <div class="modal-overlay" v-if="isModalOpen" @click="closeModal">
      <div class="modal-container" @click.stop>
        <button class="modal-close" @click="closeModal">&times;</button>
        <div class="modal-content">
          <h3 class="modal-title">{{ t.reviews.share_experience }}</h3>
          <!-- Conteneur pour le widget Salonized -->
          <div id="salonized-reviews-container"></div>
        </div>
      </div>
    </div>
      </div>
    </section>
  </template>
  
  <script setup>
import { ref, onMounted } from 'vue';
import { useTranslation } from '@/composables/useTranslation';

const { t } = useTranslation();
const isModalOpen = ref(false);

// Charger le script Elfsight au montage du composant
onMounted(() => {
  loadElfsightScript();
});

const loadElfsightScript = () => {
  // Vérifier si le script Elfsight n'est pas déjà chargé
  if (!document.getElementById('elfsight-platform-script')) {
    const script = document.createElement('script');
    script.src = 'https://elfsightcdn.com/platform.js';
    script.id = 'elfsight-platform-script';
    script.async = true;
    document.body.appendChild(script);
  }
};

const openModal = () => {
  isModalOpen.value = true;
  // Charger le script Salonized lorsque le modal est ouvert
  setTimeout(() => {
    loadSalonizedWidget();
  }, 100);
};

const closeModal = () => {
  isModalOpen.value = false;
};

const loadSalonizedWidget = () => {
  // Vérifier si le script est déjà chargé
  if (!document.getElementById('salonized-widget-script')) {
    const script = document.createElement('script');
    script.src = 'https://cdn.salonized.com/widget.js';
    script.setAttribute('data-name', 'salonized');
    script.setAttribute('data-microsite-url', 'https://bee-aesthetic.salonized.com');
    script.id = 'salonized-widget-script';
    script.async = true;
    document.body.appendChild(script);

    // Créer le conteneur pour les reviews
    const container = document.getElementById('salonized-reviews-container');
    if (container) {
      const reviewsDiv = document.createElement('div');
      reviewsDiv.className = 'salonized-reviews-mini';
      reviewsDiv.setAttribute('data-link', 'https://bee-aesthetic.salonized.com/reviews');
      container.appendChild(reviewsDiv);
    }
  }
};
</script>
  
  <style scoped>

.modal-overlay {
  position: fixed;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background-color: rgba(0, 0, 0, 0.7);
  display: flex;
  justify-content: center;
  align-items: center;
  z-index: 1000;
  backdrop-filter: blur(3px);
}

.modal-container {
  background-color: white;
  border-radius: 8px;
  width: 90%;
  max-width: 700px;
  max-height: 90vh;
  overflow-y: auto;
  position: relative;
  box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
}

.modal-close {
  position: absolute;
  top: 15px;
  right: 20px;
  font-size: 28px;
  background: transparent;
  border: none;
  cursor: pointer;
  color: #555;
  transition: color 0.3s;
}

.modal-close:hover {
  color: #000;
}

.modal-content {
  padding: 2.5rem;
}

.modal-title {
  font-size: 1.8rem;
  font-weight: 300;
  color: #555;
  margin-bottom: 2rem;
  text-align: center;
}

#salonized-reviews-container {
  min-height: 400px;
}

/* Responsive pour le modal */
@media (max-width: 767px) {
  .modal-container {
    width: 95%;
  }
  
  .modal-content {
    padding: 1.5rem;
  }
  
  .modal-title {
    font-size: 1.5rem;
    margin-bottom: 1.5rem;
  }
}
  .reviews-section {
    padding: 5rem 0;
    background-color: #f8f8f8;
    font-family: 'Montserrat', 'Raleway', 'Helvetica Neue', sans-serif;
  }
  
  .container {
    max-width: 1200px;
    margin: 0 auto;
    padding: 0 1.5rem;
  }
  
  .reviews-header {
    text-align: center;
    margin-bottom: 4rem;
  }
  
  .reviews-title {
    font-size: 2.5rem;
    font-weight: 300;
    color: #555;
    margin-bottom: 1rem;
    letter-spacing: 1px;
  }
  
  .reviews-subtitle {
    font-size: 1.1rem;
    color: #888;
    font-weight: 300;
    max-width: 600px;
    margin: 0 auto;
    letter-spacing: 0.5px;
  }
  
  .reviews-widget-container {
    max-width: 1200px;
    margin: 0 auto 4rem;
    padding: 0 1rem;
  }

  .widget-placeholder {
    text-align: center;
    padding: 4rem 2rem;
    background-color: white;
    border-radius: 8px;
    border: 2px dashed #e0e0e0;
    color: #888;
    font-size: 1rem;
    line-height: 1.8;
  }
  
  .reviews-button-container {
    text-align: center;
    margin-top: 2rem;
  }
  
  .reviews-button {
    display: inline-block;
    padding: 0.8rem 2.5rem;
    border: 1px solid #b3a090;
    border-radius: 50px;
    color: #b3a090;
    text-decoration: none;
    font-size: 0.9rem;
    letter-spacing: 0.5px;
    transition: all 0.3s ease;
  }
  
  .reviews-button:hover {
    background-color: #b3a090;
    color: white;
    transform: translateY(-2px);
  }
  
  /* Media queries pour responsive */
  @media (max-width: 767px) {
    .reviews-section {
      padding: 3rem 0;
    }

    .reviews-title {
      font-size: 2rem;
    }

    .reviews-subtitle {
      font-size: 1rem;
    }

    .widget-placeholder {
      padding: 2rem 1rem;
      font-size: 0.9rem;
    }
  }
  </style>
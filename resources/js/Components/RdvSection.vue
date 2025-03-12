<template>
  <section class="booking-section">
    <div class="container">
      <div class="row align-items-center">
        <!-- Colonne gauche avec le titre et texte -->
        <div class="col-lg-6 booking-content">
          <h2 class="booking-title">Prendre un rendez-vous</h2>
          <p class="booking-text">
            Prenez rendez-vous dès aujourd'hui et offrez à vos ongles le soin qu'ils
            méritent. Réservez votre moment de beauté en quelques clics !
          </p>
        </div>
        
        <!-- Colonne droite avec le bouton -->
        <div class="col-lg-6 booking-button-container">
          <a href="/rendez-vous" class="booking-button">Rendez-vous</a>
        </div>
      </div>
    </div>
  </section>
</template>

<script setup>
// Aucune logique spécifique nécessaire
</script>

<style scoped>
.booking-section {
  padding: 4rem 2rem;
  background-color: #000; /* Fond noir */
  font-family: 'Montserrat', 'Raleway', 'Helvetica Neue', sans-serif;
  color: #fff; /* Texte blanc par défaut */
}

.container {
  max-width: 1200px;
  margin: 0 auto;
}

.booking-content {
  padding-right: 2rem;
}

.booking-title {
  font-size: 3.5rem;
  font-weight: 300;
  color: #fff; /* Texte blanc */
  margin-bottom: 1.5rem;
  line-height: 1.2;
  letter-spacing: 0.5px;
  white-space: nowrap; /* Empêche le retour à la ligne */
}

/* Ajustez la taille du texte pour les écrans plus petits pour éviter le débordement */
@media (max-width: 1200px) {
  .booking-title {
    font-size: 3rem;
  }
}

@media (max-width: 991px) {
  .booking-title {
    font-size: 2.8rem;
    white-space: normal; /* Permet le retour à la ligne sur tablette pour éviter le débordement */
  }
}

.booking-text {
  font-size: 1rem;
  line-height: 1.8;
  color: #eee; /* Texte légèrement moins blanc pour meilleur contraste */
  max-width: 90%;
}

.booking-button-container {
  display: flex;
  justify-content: flex-end;
  align-items: center;
}

.booking-button {
  display: inline-block;
  background-color: #fff; /* Bouton blanc */
  color: #000; /* Texte noir */
  text-decoration: none;
  padding: 1rem 3rem;
  border-radius: 50px;
  font-size: 1rem;
  transition: all 0.3s ease;
  text-align: center;
  min-width: 200px;
}

.booking-button:hover {
  transform: translateY(-2px);
  box-shadow: 0 4px 8px rgba(255, 255, 255, 0.2); /* Ombre blanche */
  background-color: #f0f0f0; /* Légère variation au survol */
}

/* Responsive */
@media (max-width: 991px) {
  .booking-section {
    padding: 3rem 1.5rem;
  }
  
  .booking-content {
    padding-right: 0;
    margin-bottom: 2rem;
  }
  
  .booking-button-container {
    justify-content: flex-start;
  }
}

@media (max-width: 767px) {
  .booking-section {
    padding: 2.5rem 1rem;
  }
  
  .booking-button {
    width: 100%;
    padding: 0.8rem 1.5rem;
  }
}
</style>
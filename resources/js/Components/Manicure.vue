<template>
    <section class="services-packages">
      <!-- Service 1: Less is always more -->
      <div class="service-item">
        <div class="service-image">
          <img src="Images/manicure.jpeg" alt="Manucure BIAB blanche" class="img-fluid">
        </div>
        <div class="service-content">
          <h2 class="service-title">Less is always more</h2>
          <p class="service-price">70 €</p>
          <p class="service-description">
            Avant un traitement BIAB, une manucure russe est réalisée, comprenant
            le nettoyage des cuticules, le limage des ongles et l'application du gel
            fortifiant BIAB.
          </p>
          <div class="service-button-container">
            <a href="/rendez-vous" class="service-button">Réserver</a>
          </div>
        </div>
      </div>
  
      <!-- Service 2: Add a color -->
      <div class="service-item reverse">
        <div class="service-image">
          <img src="Images/manicure3.jpeg" alt="Manucure BIAB colorée" class="img-fluid">
        </div>
        <div class="service-content">
          <h2 class="service-title">Add a color</h2>
          <p class="service-price">75 €</p>
          <p class="service-description">
            Disponible dans une gamme limitée de couleurs, le BIAB peut être utilisé
            seul ou comme base pour un vernis semi-permanent.
          </p>
          <div class="service-button-container">
            <a href="/rendez-vous" class="service-button">Réserver</a>
          </div>
        </div>
      </div>
  
      <!-- Service 3: Nail Art -->
      <div class="service-item">
        <div class="service-image">
          <img src="Images/manicure4.jpg" alt="Nail Art Design" class="img-fluid">
        </div>
        <div class="service-content">
          <h2 class="service-title">Nail Art</h2>
          <p class="service-price"> Sur demande</p>
          <p class="service-description">
            Faites de vos ongles la chose la plus spéciale chez vous !
          </p>
          <div class="service-button-container">
            <a href="/rendez-vous" class="service-button">Réserver</a>
          </div>
        </div>
      </div>
  
      <!-- Service 4: French nails -->
      <div class="service-item reverse">
        <div class="service-image">
          <img src="Images/manicure5.jpeg" alt="French Nails" class="img-fluid">
        </div>
        <div class="service-content">
          <h2 class="service-title">French nails</h2>
          <p class="service-price">75 €</p>
          <p class="service-description">
            Obtenez un look parfait et raffiné avec une french de la couleur de votre
            choix.
          </p>
          <div class="service-button-container">
            <a href="/rendez-vous" class="service-button">Réserver</a>
          </div>
        </div>
      </div>
    </section>
  </template>
  
  <script setup>
  // Aucune logique spécifique nécessaire
  </script>
  
  <style scoped>
  .services-packages {
    padding: 4rem 0;
    background-color: #f8f8f8;
    font-family: 'Montserrat', 'Raleway', 'Helvetica Neue', sans-serif;
  }
  
  .service-item {
    display: flex;
    margin-bottom: 8rem;
    align-items: center;
  }
  
  .service-item.reverse {
    flex-direction: row-reverse;
  }
  
  .service-image {
  flex: 1;
  padding: 0 2rem;
  max-width: 50%;
  display: flex;
  justify-content: center;
  align-items: center;
}

.service-image img {
  width: 80%; /* Réduit la taille de l'image */
  height: auto;
  max-width: 400px; /* Taille maximale pour l'image */
  aspect-ratio: 1/1; /* Maintient un format carré */
  object-fit: cover;
  border-radius: 60% 40% 40% 60% / 40% 50% 50% 60%; /* Forme ondulée asymétrique */
  box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
  transition: transform 0.5s ease;
}

/* Image à droite avec forme différente */
.service-item.reverse .service-image img {
  border-radius: 40% 60% 60% 40% / 50% 40% 60% 50%; /* Forme ondulée différente */
}

/* Ajoutez un effet de survol si souhaité */
.service-image img:hover {
  transform: scale(1.03);
}

/* Responsivité pour tablettes */
@media (max-width: 991px) {
  .service-image {
    max-width: 100%;
    padding: 0 2rem;
  }
  
  .service-image img {
    width: 70%;
    max-width: 350px;
  }
}

/* Responsivité pour mobile */
@media (max-width: 767px) {
  .service-image img {
    width: 80%;
    max-width: 280px;
  }
}
  
  .service-content {
    flex: 1;
    padding: 0 3rem;
    max-width: 50%;
  }
  
  .service-title {
    font-size: 3rem;
    font-weight: 300;
    color: #555;
    margin-bottom: 1rem;
    letter-spacing: 0.5px;
  }
  
  .service-price {
    font-size: 1.2rem;
    font-weight: 300;
    color: #555;
    margin-bottom: 1.5rem;
  }
  
  .service-description {
    font-size: 1rem;
    line-height: 1.8;
    color: #555;
    margin-bottom: 2rem;
  }
  
  .service-button-container {
    margin-top: 1rem;
  }
  
  .service-button {
    display: inline-block;
    padding: 0.8rem 2.5rem;
    border: 1px solid #333;
    border-radius: 50px;
    color: #333;
    text-decoration: none;
    font-size: 0.9rem;
    letter-spacing: 0.5px;
    transition: all 0.3s ease;
  }
  
  .service-button:hover {
    background-color: rgba(0, 0, 0, 0.05);
    transform: translateY(-2px);
  }
  
  /* Media queries pour responsive */
  @media (max-width: 991px) {
    .service-item, 
    .service-item.reverse {
      flex-direction: column;
      margin-bottom: 5rem;
    }
    
    .service-image,
    .service-content {
      max-width: 100%;
      padding: 0 2rem;
    }
    
    .service-image {
      margin-bottom: 2rem;
    }
    
    .service-title {
      font-size: 2.5rem;
    }
  }
  
  @media (max-width: 767px) {
    .services-packages {
      padding: 3rem 0;
    }
    
    .service-item {
      margin-bottom: 4rem;
    }
    
    .service-image,
    .service-content {
      padding: 0 1.5rem;
    }
    
    .service-title {
      font-size: 2rem;
    }
    
    .service-button {
      display: block;
      width: 100%;
      text-align: center;
    }
  }
  @media (min-width: 768px) and (max-width: 991px) {
  /* Assurer que tout le contenu est aligné de la même façon sur iPad */
  .service-content {
    text-align: center;
    padding: 0;
    margin: 0 auto;
    max-width: 90%;
  }
  
  /* Centrer le bouton */
  .service-button-container {
    display: flex;
    justify-content: center;
  }
  
  /* Assurer que le bouton a une largeur fixe pour une apparence uniforme */
  .service-button {
    min-width: 200px;
    text-align: center;
  }
  
  /* Pour les descriptions, assurer que l'espacement est uniforme */
  .service-description {
    margin-left: auto;
    margin-right: auto;
    max-width: 90%;
  }
}
  </style>
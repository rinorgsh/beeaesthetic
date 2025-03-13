<template>
    <section class="services-section">
      <!-- Titre de la section -->
      <div class="section-title-container">
        <h2 class="section-title">Nos services</h2>
      </div>
      
      <!-- Contenu des services -->
      <div class="services-container">
        <div class="row">
          <!-- Première colonne - Manucure & BIAB -->
          <div class="col-lg-6 service-col">
            <div class="service-content">
              <div class="service-image">
                <img src="Images/service2.jpeg" alt="Manucure & BIAB" class="img-fluid">
              </div>
              <h3 class="service-title">Manucure & BIAB</h3>
              <p class="service-description">
                Sublimez vos mains avec nos soins professionnels
                alliant élégance et durabilité. Chez Bee Aesthetic, nous
                utilisons des techniques modernes telles que le BIAB
                (Builder in a Bottle) pour renforcer vos ongles tout en
                préservant leur santé naturelle.
              </p>
              <div class="service-btn-container">
                <a href="/manicure" class="service-btn">En savoir plus</a>
              </div>
            </div>
          </div>
          
          <!-- Deuxième colonne - Formation -->
          <div class="col-lg-6 service-col">
            <div class="service-content">
              <div class="service-image">
                <img src="Images/service.jpeg" alt="Formation" class="img-fluid">
              </div>
              <h3 class="service-title">Formation</h3>
              <p class="service-description">
                Perfectionnez votre maîtrise du BIAB et des techniques
                d'onglerie avec nos formations professionnelles
                complètes. Que vous soyez débutant ou déjà
                expérimenté, nos cours sont conçus pour développer vos
                compétences et vous guider vers l'excellence.
              </p>
              <div class="service-btn-container">
                <a href="/formation" class="service-btn">En savoir plus</a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </template>
  
  <script setup>
  // Aucune logique spécifique nécessaire
  </script>
  
  <style scoped>

.service-image {
  margin-bottom: 2rem;
  overflow: hidden;
  position: relative;
  width: 100%;
  padding-top: 100%;
  border-radius: 70% 30% 30% 70% / 40% 50% 50% 60%; /* Forme organique asymétrique */
}

.service-image img {
  position: absolute;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  object-fit: cover;
  transition: transform 0.5s ease;
}

/* Ajustement pour limiter la taille maximale des images sur desktop */
@media (min-width: 992px) {
  .service-image {
    max-width: 350px; /* Limite la largeur maximale */
    padding-top: 350px; /* Hauteur fixe correspondante pour maintenir le carré */
    margin-left: auto;
    margin-right: auto;
  }
}
  .services-section {
    padding: 3rem 0 5rem;
    background-color: #f8f8f8;
    font-family: 'Montserrat', 'Raleway', 'Helvetica Neue', sans-serif;
  }
  
  .section-title-container {
    padding: 1rem 2rem 3rem;
  }
  
  .section-title {
    font-size: 3rem;
    font-weight: 300;
    color: #555;
    letter-spacing: 1px;
    margin-left: 2rem;
  }
  
  .services-container {
    max-width: 1200px;
    margin: 0 auto;
    padding: 0 1rem;
  }
  
  .service-col {
    padding: 1rem 2rem;
    margin-bottom: 2rem;
  }
  
  .service-content {
    display: flex;
    flex-direction: column;
    height: 100%;
  }
  
  .service-image {
    margin-bottom: 2rem;
    overflow: hidden;
  }
  
  .service-image img {
    width: 100%;
    transition: transform 0.5s ease;
  }
  
  .service-image:hover img {
    transform: scale(1.03);
  }
  
  .service-title {
    font-size: 1.8rem;
    font-weight: 300;
    color: #b3a090;
    margin-bottom: 1.5rem;
    letter-spacing: 0.5px;
  }
  
  .service-description {
    font-size: 1rem;
    line-height: 1.8;
    color: #555;
    margin-bottom: 2rem;
    flex-grow: 1;
  }
  
  .service-btn-container {
    margin-top: auto;
  }
  
  .service-btn {
    display: inline-block;
    padding: 0.8rem 2rem;
    border: 1px solid #999;
    border-radius: 50px;
    color: #555;
    text-decoration: none;
    font-size: 0.9rem;
    letter-spacing: 0.5px;
    transition: all 0.3s ease;
  }
  
  .service-btn:hover {
    background-color: rgba(0, 0, 0, 0.05);
    transform: translateY(-2px);
  }
  
  @media (max-width: 991px) {
    .section-title {
      font-size: 2.5rem;
      margin-left: 1rem;
    }
    
    .service-col {
      padding: 1rem;
    }
  }
  
  @media (max-width: 767px) {
    .section-title-container {
      padding: 1rem 1rem 2rem;
    }
    
    .section-title {
      font-size: 2rem;
      margin-left: 0.5rem;
    }
    
    .service-title {
      font-size: 1.5rem;
    }
    
    .service-btn {
      width: 100%;
      text-align: center;
    }
  }
  @media (min-width: 992px) {
  .service-image {
    max-width: 350px; /* Limite la largeur maximale */
    padding-top: 350px; /* Hauteur fixe correspondante pour maintenir le carré */
    margin-left: auto;
    margin-right: auto;
  }
}

/* Ajustement spécifique pour iPad et tablettes */
@media (min-width: 768px) and (max-width: 991px) {
  .service-image {
    max-width: 280px; /* Taille réduite pour iPad */
    padding-top: 280px; /* Hauteur correspondante pour maintenir le carré */
    margin-left: auto;
    margin-right: auto;
  }
}
  </style>
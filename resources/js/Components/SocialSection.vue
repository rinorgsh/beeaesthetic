<template>
    <section class="social-section">
      <div class="container">
        <!-- Titre de la section -->
        <div class="social-title-container">
          <h2 class="social-title">Suivez-nous sur les réseaux sociaux</h2>
        </div>
        
        <!-- Galerie d'images -->
        <div class="social-gallery">
          <div class="social-image">
            <img src="Images/social1.jpeg" alt="Ongles élégants" class="img-fluid">
          </div>
          <div class="social-image">
            <img src="Images/social2.jpeg" alt="Style et ongles" class="img-fluid">
          </div>
          <div class="social-image">
            <img src="Images/social3.jpeg" alt="Ongles naturels" class="img-fluid">
          </div>
          <div class="social-image">
            <img src="Images/social4.jpeg" alt="Ongles design" class="img-fluid">
          </div>
        </div>
        
        <!-- Bouton réseaux sociaux -->
        <div class="social-button-container">
          <a href="https://instagram.com/beeaesthetic" target="_blank" class="social-button">Réseaux sociaux</a>
        </div>
      </div>
    </section>
  </template>
  
  <script setup>
  // Aucune logique spécifique nécessaire
  </script>
  
  <style scoped>
  .social-section {
    padding: 5rem 0;
    background-color: #f8f8f8;
    font-family: 'Montserrat', 'Raleway', 'Helvetica Neue', sans-serif;
  }
  
  .container {
    max-width: 1400px;
    margin: 0 auto;
    padding: 0 1rem;
  }
  
  .social-title-container {
    text-align: center;
    margin-bottom: 3rem;
  }
  
  .social-title {
    font-size: 2.5rem;
    font-weight: 300;
    color: #555;
    letter-spacing: 0.5px;
  }
  
  .social-gallery {
    display: flex;
    flex-wrap: nowrap;
    gap: 1rem;
    margin-bottom: 3rem;
    overflow-x: auto;
    padding-bottom: 1rem;
    scrollbar-width: thin;
    scrollbar-color: #ccc #f8f8f8;
  }
  
  .social-gallery::-webkit-scrollbar {
    height: 6px;
  }
  
  .social-gallery::-webkit-scrollbar-track {
    background: #f8f8f8;
  }
  
  .social-gallery::-webkit-scrollbar-thumb {
    background-color: #ccc;
    border-radius: 6px;
  }
  
  .social-image {
    flex: 0 0 auto;
    width: calc(25% - 0.75rem);
    aspect-ratio: 1/1;
    overflow: hidden;
  }
  
  .social-image img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform 0.5s ease;
  }
  
  .social-image:hover img {
    transform: scale(1.05);
  }
  
  .social-button-container {
    display: flex;
    justify-content: center;
    margin-top: 2rem;
  }
  
  .social-button {
    display: inline-block;
    background-color: #000;
    color: #fff;
    text-decoration: none;
    padding: 1rem 3rem;
    border-radius: 50px;
    font-size: 1rem;
    transition: all 0.3s ease;
    text-align: center;
    min-width: 200px;
  }
  
  .social-button:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
  }
  
  /* Responsive */
  @media (max-width: 1200px) {
    .social-image {
      width: calc(33.333% - 0.667rem);
    }
  }
  
  @media (max-width: 991px) {
    .social-title {
      font-size: 2.2rem;
    }
    
    .social-image {
      width: calc(50% - 0.5rem);
    }
  }
  
  @media (max-width: 767px) {
    .social-section {
      padding: 3rem 0;
    }
    
    .social-title {
      font-size: 1.8rem;
    }
    
    .social-image {
      width: 85%;
    }
    
    .social-button {
      width: 100%;
      max-width: 300px;
    }
  }
  </style>
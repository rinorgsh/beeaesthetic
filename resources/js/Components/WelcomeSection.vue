<template>
    <section class="welcome-section">
      <div class="container">
        <div class="welcome-content">
          <p class="welcome-text">
            Bienvenue chez <span class="highlight">Bee Aesthetic</span>, votre destination pour des ongles 
            élégants et soignés. Forte de mes <span class="highlight">4 années d'expérience</span> dans le 
            domaine de la beauté des ongles, je mets mon expertise à votre 
            service pour sublimer vos mains tout en préservant la santé de vos 
            ongles.
          </p>
          
          <p class="welcome-text">
            Que ce soit pour des finitions impeccables, des options durables 
            comme le <span class="highlight">BIAB</span>, ou encore des formations professionnelles 
            destinées aux futurs experts de l'onglerie, chaque rendez-vous est 
            une expérience unique, où chaque détail compte.
          </p>
          
          <p class="welcome-text">
            Avec <span class="highlight">Bee Aesthetic</span>, vous bénéficiez de 4 ans de savoir-faire et d'un 
            soin attentif et personnalisé. Prenez rendez-vous dès aujourd'hui 
            et laissez vos ongles refléter votre style et votre élégance.
          </p>
        </div>
      </div>
    </section>
  </template>
  
  <script setup>
  // Aucune logique spécifique nécessaire
  </script>
  
  <style scoped>
  .welcome-section {
    padding: 5rem 1rem;
    background-color: #f8f8f8;
    font-family: 'Montserrat', 'Raleway', 'Helvetica Neue', sans-serif;
  }
  
  .container {
    max-width: 800px;
    margin: 0 auto;
  }
  
  .welcome-content {
    text-align: center;
  }
  
  .welcome-text {
    font-size: 1.1rem;
    line-height: 1.8;
    margin-bottom: 2rem;
    color: #555;
    font-weight: 300;
    letter-spacing: 0.5px;
  }
  
  .highlight {
    font-weight: 500;
    color: #333;
  }
  
  @media (max-width: 767px) {
    .welcome-section {
      padding: 3rem 1rem;
    }
    
    .welcome-text {
      font-size: 1rem;
      line-height: 1.7;
      margin-bottom: 1.5rem;
    }
  }
  </style>
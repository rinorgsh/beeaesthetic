<template>
    <section class="formation-banner">
      <div class="formation-overlay"></div>
      <div class="formation-content">
        <h2 class="formation-title">Lancez-vous dans l'univers du BIAB grâce à nos formations professionnelles </h2>
        <div class="formation-button-container">
          <a href="/reserver" class="formation-button">Réserver</a>
        </div>
      </div>
    </section>
    
    <section class="formation-details">
      <div class="container">
        <div class="row">
          <div class="col-lg-8 offset-lg-2">
            <div class="formation-description">
              <h3 class="details-title">Une formation d'excellence pour les professionnels de l'onglerie</h3>
              
              <p class="details-text">
                Chez Bee Aesthetic, nous proposons des formations BIAB (Builder In A Bottle) de qualité supérieure, conçues pour vous permettre de maîtriser cette technique révolutionnaire qui allie simplicité d'application et résultats exceptionnels.
              </p>
              
              <div class="details-features">
                <div class="feature">
                  <h4 class="feature-title">Formation complète</h4>
                  <p class="feature-text">
                    Une journée intensive pour maîtriser la technique BIAB, de la préparation de l'ongle naturel jusqu'à l'application parfaite du gel fortifiant.
                  </p>
                </div>
                
                <div class="feature">
                  <h4 class="feature-title">Groupe restreint</h4>
                  <p class="feature-text">
                    Formation individuelle garantissant une attention totalement dédiée et un apprentissage adapté à votre rythme et à vos besoins spécifiques.                  </p>
                </div>
                
                <div class="feature">
                  <h4 class="feature-title">Support pédagogique</h4>
                  <p class="feature-text">
                    Repartez avec un manuel complet détaillant chaque étape de la technique, ainsi qu'un certificat attestant de votre formation.
                  </p>
                </div>
              </div>
              
              <p class="details-conclusion">
                Que vous soyez débutant ou professionnel cherchant à élargir votre offre de services, notre formation BIAB vous donnera toutes les clés pour satisfaire votre clientèle avec des soins d'exception.
              </p>
              
              <div class="details-button-container">
                <a href="/formations" class="details-button">Découvrir notre programme</a>
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
  .formation-banner {
    position: relative;
    width: 100%;
    height: 70vh;
    min-height: 400px;
    max-height: 600px;
    background-image: url('@/../../public/Images/formation.jpeg');
    background-size: cover;
    background-position: center;
    display: flex;
    justify-content: center;
    align-items: center;
    color: white;
    overflow: hidden;
  }
  
  .formation-overlay {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0, 0, 0, 0.5);
    z-index: 1;
  }
  
  .formation-content {
    position: relative;
    z-index: 2;
    text-align: center;
    padding: 0 2rem;
    max-width: 900px;
  }
  
  .formation-title {
    font-family: 'Montserrat', 'Raleway', 'Helvetica Neue', sans-serif;
    font-size: 3rem;
    font-weight: 300;
    letter-spacing: 1px;
    line-height: 1.3;
    margin-bottom: 2.5rem;
  }
  
  .formation-button-container {
    margin-top: 2rem;
  }
  
  .formation-button {
    display: inline-block;
    background-color: #e6cfc2;
    color: #333;
    text-decoration: none;
    padding: 1rem 3rem;
    border-radius: 50px;
    font-size: 1rem;
    letter-spacing: 0.5px;
    transition: all 0.3s ease;
  }
  
  .formation-button:hover {
    background-color: #dbbcab;
    transform: translateY(-2px);
  }
  
  /* Section des détails de la formation */
  .formation-details {
    padding: 5rem 0;
    background-color: #f8f8f8;
    font-family: 'Montserrat', 'Raleway', 'Helvetica Neue', sans-serif;
  }
  
  .formation-description {
    text-align: center;
  }
  
  .details-title {
    font-size: 2rem;
    font-weight: 300;
    color: #333;
    margin-bottom: 2rem;
    letter-spacing: 0.5px;
  }
  
  .details-text {
    font-size: 1.1rem;
    line-height: 1.8;
    color: #555;
    margin-bottom: 3rem;
  }
  
  .details-features {
    display: flex;
    flex-wrap: wrap;
    justify-content: space-between;
    margin-bottom: 3rem;
  }
  
  .feature {
    flex: 0 0 30%;
    margin-bottom: 2rem;
  }
  
  .feature-title {
    font-size: 1.3rem;
    font-weight: 400;
    color: #b3a090;
    margin-bottom: 1rem;
    letter-spacing: 0.3px;
  }
  
  .feature-text {
    font-size: 1rem;
    line-height: 1.7;
    color: #666;
  }
  
  .details-conclusion {
    font-size: 1.1rem;
    line-height: 1.8;
    color: #555;
    margin-bottom: 2.5rem;
    font-style: italic;
  }
  
  .details-button-container {
    margin-top: 1rem;
  }
  
  .details-button {
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
  
  .details-button:hover {
    background-color: rgba(0, 0, 0, 0.05);
    transform: translateY(-2px);
  }
  
  /* Media queries pour responsive */
  @media (max-width: 991px) {
    .formation-title {
      font-size: 2.5rem;
    }
    
    .details-features {
      flex-direction: column;
    }
    
    .feature {
      flex: 0 0 100%;
      margin-bottom: 2rem;
    }
  }
  
  @media (max-width: 767px) {
    .formation-banner {
      height: 60vh;
    }
    
    .formation-title {
      font-size: 2rem;
    }
    
    .formation-button,
    .details-button {
      width: 100%;
      max-width: 300px;
    }
    
    .details-title {
      font-size: 1.7rem;
    }
    
    .details-text,
    .details-conclusion {
      font-size: 1rem;
    }
  }
  </style>
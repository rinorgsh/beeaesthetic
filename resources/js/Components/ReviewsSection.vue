<template>
    <section class="reviews-section">
      <div class="container">
        <!-- En-tête de la section -->
        <div class="reviews-header">
          <h2 class="reviews-title">Ce que nos clientes disent</h2>
          <p class="reviews-subtitle">Des expériences authentiques partagées par notre clientèle</p>
        </div>
        
        <!-- Grille des témoignages -->
        <div class="reviews-grid">
          <!-- Témoignage 1 -->
          <div class="review-card">
            <div class="review-content">
              <div class="review-quote">"</div>
              <p class="review-text">
                Service impeccable et résultat exceptionnel. Le BIAB a complètement transformé mes ongles fragiles. Ils sont maintenant beaucoup plus résistants tout en restant naturels. Je ne peux plus m'en passer !
              </p>
              <div class="review-author">
                <p class="author-name">Émilie R.</p>
                <div class="author-rating">
                  <span class="star">★</span>
                  <span class="star">★</span>
                  <span class="star">★</span>
                  <span class="star">★</span>
                  <span class="star">★</span>
                </div>
              </div>
            </div>
          </div>
          
          <!-- Témoignage 2 -->
          <div class="review-card">
            <div class="review-content">
              <div class="review-quote">"</div>
              <p class="review-text">
                J'ai suivi la formation BIAB et je suis impressionnée par la qualité de l'enseignement. Les techniques sont expliquées de façon claire et précise. Grâce à cette formation, j'ai pu développer mes compétences et proposer de nouveaux services à mes clientes.
              </p>
              <div class="review-author">
                <p class="author-name">Sophie M.</p>
                <div class="author-rating">
                  <span class="star">★</span>
                  <span class="star">★</span>
                  <span class="star">★</span>
                  <span class="star">★</span>
                  <span class="star">★</span>
                </div>
              </div>
            </div>
          </div>
          
          <!-- Témoignage 3 -->
          <div class="review-card">
            <div class="review-content">
              <div class="review-quote">"</div>
              <p class="review-text">
                Ambiance apaisante, service personnalisé et résultat sublime. Les french nails réalisées par Bee Aesthetic sont parfaites et tiennent plusieurs semaines sans s'abîmer. Un vrai plaisir à chaque visite.
              </p>
              <div class="review-author">
                <p class="author-name">Camille L.</p>
                <div class="author-rating">
                  <span class="star">★</span>
                  <span class="star">★</span>
                  <span class="star">★</span>
                  <span class="star">★</span>
                  <span class="star">★</span>
                </div>
              </div>
            </div>
          </div>
          
          <!-- Témoignage 4 -->
          <div class="review-card">
            <div class="review-content">
              <div class="review-quote">"</div>
              <p class="review-text">
                Le nail art réalisé pour mon mariage était tout simplement magnifique. Subtil, élégant et parfaitement assorti à ma robe. Toutes mes invitées m'ont complimentée. Merci pour ce moment de beauté qui a contribué à rendre cette journée encore plus spéciale.
              </p>
              <div class="review-author">
                <p class="author-name">Aurélie T.</p>
                <div class="author-rating">
                  <span class="star">★</span>
                  <span class="star">★</span>
                  <span class="star">★</span>
                  <span class="star">★</span>
                  <span class="star">★</span>
                </div>
              </div>
            </div>
          </div>
          
          <!-- Témoignage 5 -->
          <div class="review-card">
            <div class="review-content">
              <div class="review-quote">"</div>
              <p class="review-text">
                Professionnalisme et expertise sont les maîtres mots chez Bee Aesthetic. J'apprécie particulièrement l'attention portée à la santé de l'ongle. Mes ongles n'ont jamais été aussi beaux et en bonne santé depuis que je fréquente ce salon.
              </p>
              <div class="review-author">
                <p class="author-name">Juliette D.</p>
                <div class="author-rating">
                  <span class="star">★</span>
                  <span class="star">★</span>
                  <span class="star">★</span>
                  <span class="star">★</span>
                  <span class="star">★</span>
                </div>
              </div>
            </div>
          </div>
          
          <!-- Témoignage 6 -->
          <div class="review-card">
            <div class="review-content">
              <div class="review-quote">"</div>
              <p class="review-text">
                La technique BIAB est révolutionnaire ! Après des années à lutter avec des ongles qui se dédoublent, j'ai enfin trouvé la solution. Le résultat est naturel, durable et mes ongles se renforcent progressivement. Je recommande vivement.
              </p>
              <div class="review-author">
                <p class="author-name">Marie P.</p>
                <div class="author-rating">
                  <span class="star">★</span>
                  <span class="star">★</span>
                  <span class="star">★</span>
                  <span class="star">★</span>
                  <span class="star">★</span>
                </div>
              </div>
            </div>
          </div>
        </div>
        
        <!-- Bouton pour voir plus d'avis ou laisser un avis -->
        <div class="reviews-button-container">
          <a href="/laisser-un-avis" class="reviews-button">Partagez votre expérience</a>
        </div>
      </div>
    </section>
  </template>
  
  <script setup>
  // Aucune logique spécifique nécessaire
  </script>
  
  <style scoped>
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
  
  .reviews-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(350px, 1fr));
    gap: 2rem;
    margin-bottom: 4rem;
  }
  
  .review-card {
    background-color: white;
    border-radius: 8px;
    overflow: hidden;
    box-shadow: 0 3px 15px rgba(0, 0, 0, 0.03);
    transition: transform 0.3s ease, box-shadow 0.3s ease;
    height: 100%;
  }
  
  .review-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 8px 25px rgba(0, 0, 0, 0.05);
  }
  
  .review-content {
    padding: 2.5rem;
    position: relative;
    height: 100%;
    display: flex;
    flex-direction: column;
  }
  
  .review-quote {
    position: absolute;
    top: 1.5rem;
    left: 1.5rem;
    font-size: 3rem;
    color: #f0e8e2;
    font-family: 'Georgia', serif;
    line-height: 1;
  }
  
  .review-text {
    font-size: 1rem;
    line-height: 1.8;
    color: #555;
    margin-bottom: 2rem;
    position: relative;
    z-index: 1;
    flex-grow: 1;
  }
  
  .review-author {
    margin-top: auto;
    border-top: 1px solid #f0e8e2;
    padding-top: 1.5rem;
  }
  
  .author-name {
    font-size: 1.1rem;
    font-weight: 500;
    color: #b3a090;
    margin-bottom: 0.5rem;
  }
  
  .author-rating {
    display: flex;
  }
  
  .star {
    color: #b3a090;
    margin-right: 2px;
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
  @media (max-width: 991px) {
    .reviews-grid {
      grid-template-columns: repeat(2, 1fr);
    }
  }
  
  @media (max-width: 767px) {
    .reviews-section {
      padding: 3rem 0;
    }
    
    .reviews-grid {
      grid-template-columns: 1fr;
    }
    
    .reviews-title {
      font-size: 2rem;
    }
    
    .reviews-subtitle {
      font-size: 1rem;
    }
    
    .review-content {
      padding: 2rem;
    }
  }
  </style>
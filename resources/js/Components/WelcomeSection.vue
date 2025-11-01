<template>
  <section class="welcome-section">
    <div class="container">
      <div class="welcome-content">
        <p class="welcome-text">
          Bienvenue chez <span class="highlight">Bee Aesthetic</span>, votre destination beauté complète 
          à Bruxelles. Forte de mes <span class="highlight">4 années d'expérience</span> dans le 
          domaine de la beauté, je mets mon expertise à votre 
          service pour sublimer votre apparence tout en préservant la santé naturelle 
          de votre peau et de vos ongles.
        </p>
        
        <p class="welcome-text">
          Que ce soit pour des <span class="highlight">ongles impeccables</span> avec le BIAB, 
          un <span class="highlight">regard intensifié</span> grâce au rehaussement de cils, 
          une <span class="highlight">peau douce</span> avec nos épilations professionnelles, 
          ou encore un <span class="highlight">soin du visage</span> relaxant et personnalisé, 
          chaque rendez-vous est une expérience unique où chaque détail compte.
        </p>
        
        <p class="welcome-text">
          Je propose également des <span class="highlight">formations professionnelles</span> 
          pour les futurs experts de l'onglerie qui souhaitent maîtriser les techniques du BIAB 
          et développer leurs compétences.
        </p>

        <p class="welcome-text">
          Avec <span class="highlight">Bee Aesthetic</span>, vous bénéficiez de 4 ans de savoir-faire, 
          d'un soin attentif et personnalisé, et d'une gamme complète de services beauté. 
          Prenez rendez-vous dès aujourd'hui et laissez votre beauté naturelle s'exprimer.
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
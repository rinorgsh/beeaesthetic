<template>
    <section class="formation-banner">
      <div class="formation-overlay"></div>
      <div class="formation-content">
        <h2 class="formation-title">{{ t.formation.banner_title }}</h2>
        <div class="formation-button-container">
          <a href="/contact" class="formation-button">{{ t.formation.banner_button }}</a>
        </div>
      </div>
    </section>
    
    <section class="formation-details">
      <div class="container">
        <div class="row">
          <div class="col-lg-8 offset-lg-2">
            <div class="formation-description">
              <h3 class="details-title">{{ t.formation.details_title }}</h3>

              <p class="details-text">
                {{ t.formation.details_intro }}
              </p>

              <div class="details-features">
                <div class="feature">
                  <h4 class="feature-title">{{ t.formation.feature1_title }}</h4>
                  <p class="feature-text">
                    {{ t.formation.feature1_text }}
                  </p>
                </div>

                <div class="feature">
                  <h4 class="feature-title">{{ t.formation.feature2_title }}</h4>
                  <p class="feature-text">
                    {{ t.formation.feature2_text }}
                  </p>
                </div>

                <div class="feature">
                  <h4 class="feature-title">{{ t.formation.feature3_title }}</h4>
                  <p class="feature-text">
                    {{ t.formation.feature3_text }}
                  </p>
                </div>
              </div>

              <p class="details-conclusion">
                {{ t.formation.details_conclusion }}
              </p>

              <div class="details-button-container">
                <!--<a href="/formations" class="details-button">Découvrir notre programme</a>-->
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </template>
  
  <script setup>
  import { useTranslation } from '@/composables/useTranslation'

  const { t } = useTranslation()
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
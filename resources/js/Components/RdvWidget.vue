<template>
    <section class="booking-section">
      <div class="container">
        <!-- En-tête élégant -->
        <div class="booking-header">
          <h1 class="booking-title">Prenez rendez-vous</h1>
          <p class="booking-subtitle">Choisissez le service et l'horaire qui vous conviennent</p>
        </div>
        
        <!-- Widget encadré -->
        <div class="widget-container">
          <!-- Code du widget Salonized -->
          <div class="salonized-booking"
               data-company="pTcZuo7p2qn8CMbyazim1obt"
               data-color="#b3a090"
               data-language="fr"
               data-height="700"
               data-inline="true"
               data-outline="shadow">
          </div>
        </div>
        
        
      </div>
    </section>
  </template>
  
  <script>
  export default {
    name: "BookingWidget",
    mounted() {
      // Vérifier si le script n'est pas déjà chargé
      if (!document.getElementById('salonized-loader')) {
        const script = document.createElement('script');
        script.src = "https://static-widget.salonized.com/loader.js";
        script.async = true;
        script.id = 'salonized-loader';
        document.body.appendChild(script);
      }
    }
  }
  </script>
  
  <style scoped>
  .booking-section {
    padding: 5rem 0;
    background-color: #f8f8f8;
    font-family: 'Montserrat', 'Raleway', 'Helvetica Neue', sans-serif;
  }
  
  .container {
    max-width: 1000px;
    margin: 0 auto;
    padding: 0 1.5rem;
  }
  
  .booking-header {
    text-align: center;
    margin-bottom: 3rem;
  }
  
  .booking-title {
    font-size: 3rem;
    font-weight: 300;
    color: #555;
    margin-bottom: 1rem;
    letter-spacing: 1px;
  }
  
  .booking-subtitle {
    font-size: 1.1rem;
    color: #777;
    max-width: 600px;
    margin: 0 auto;
  }
  
  .widget-container {
    background-color: #f8f8f8;
    
  }
  
  .booking-info {
    display: flex;
    justify-content: space-between;
    gap: 2rem;
    margin-top: 2rem;
  }
  
  .info-card {
    flex: 1;
    background-color: white;
    padding: 1.5rem;
    border-radius: 8px;
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
  }
  
  .info-card h3 {
    font-size: 1.3rem;
    font-weight: 400;
    color: #b3a090;
    margin-bottom: 1rem;
    letter-spacing: 0.3px;
  }
  
  .info-card p {
    font-size: 0.95rem;
    line-height: 1.6;
    color: #666;
    margin-bottom: 0.5rem;
  }
  
  /* Responsive */
  @media (max-width: 768px) {
    .booking-section {
      padding: 3rem 0;
    }
    
    .booking-title {
      font-size: 2.2rem;
    }
    
    .booking-info {
      flex-direction: column;
      gap: 1rem;
    }
  }
  </style>
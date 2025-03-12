<template>
    <footer class="footer py-4">
      <div class="container-fluid px-4">
        <div class="footer-content">
          <!-- Logo/Titre -->
          <div class="footer-brand">
            <h2 class="brand-name">BEE AESTHETIC</h2>
          </div>
          
          <!-- Localisation -->
          <div class="footer-section">
            <h3 class="footer-heading">Localisation</h3>
            <p class="footer-info">Avenue Louise, 1050 Bruxelles</p>
          </div>
          
          <!-- Contact -->
          <div class="footer-section">
            <h3 class="footer-heading">Contact</h3>
            <a href="mailto:info@beeaesthetic.be" class="footer-link">info@beeaesthetic.be</a>
          </div>
          
          <!-- Réseaux sociaux -->
          <div class="footer-section">
            <h3 class="footer-heading">Suivez-nous</h3>
            <div class="social-links">
              <a href="#" class="social-link" aria-label="Instagram">
                <i class="social-icon">Instagram</i>
              </a>
              <a href="#" class="social-link" aria-label="Facebook">
                <i class="social-icon">Facebook</i>
              </a>
            </div>
          </div>
        </div>
        
        <!-- Copyright -->
        <div class="footer-copyright">
          <p>© 2025 BEE AESTHETIC</p>
        </div>
      </div>
    </footer>
  </template>
  
  <script setup>
  // Pas de logique spécifique nécessaire
  </script>
  
  <style scoped>
  .footer {
    background-color: #fafafa;
    font-family: 'Montserrat', 'Raleway', 'Helvetica Neue', sans-serif;
    font-weight: 300;
    color: #333;
    border-top: 1px solid #eaeaea;
  }
  
  .footer-content {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
    gap: 2rem;
    padding-bottom: 2rem;
  }
  
  .brand-name {
    font-size: 1.8rem;
    font-weight: 300;
    letter-spacing: 1px;
    margin-bottom: 0.5rem;
    text-transform: uppercase;
  }
  
  .brand-tagline {
    font-size: 0.8rem;
    color: #666;
    letter-spacing: 0.5px;
  }
  
  .footer-heading {
    font-size: 1rem;
    font-weight: 400;
    margin-bottom: 1rem;
    letter-spacing: 0.8px;
    text-transform: uppercase;
  }
  
  .footer-info {
    font-size: 0.9rem;
    line-height: 1.5;
    color: #555;
    letter-spacing: 0.3px;
  }
  
  .footer-link {
    color: #333;
    text-decoration: none;
    position: relative;
    transition: color 0.3s;
    font-size: 0.9rem;
    letter-spacing: 0.3px;
  }
  
  .footer-link::after {
    content: '';
    position: absolute;
    width: 100%;
    height: 1px;
    bottom: -2px;
    left: 0;
    background-color: #333;
    transform: scaleX(0);
    transform-origin: bottom right;
    transition: transform 0.3s;
  }
  
  .footer-link:hover {
    color: #000;
  }
  
  .footer-link:hover::after {
    transform: scaleX(1);
    transform-origin: bottom left;
  }
  
  .social-links {
    display: flex;
    gap: 1rem;
  }
  
  .social-link {
    color: #333;
    text-decoration: none;
    font-size: 0.9rem;
    transition: color 0.3s;
  }
  
  .social-link:hover {
    color: #000;
  }
  
  .footer-copyright {
    padding-top: 1.5rem;
    text-align: center;
    font-size: 0.8rem;
    color: #777;
    border-top: 1px solid #eaeaea;
  }
  
  /* Version responsive améliorée */
  @media (max-width: 767px) {
    .footer-content {
      grid-template-columns: 1fr;
      gap: 2rem;
      text-align: center;
      padding: 1rem 1rem 2rem;
    }
    
    .social-links {
      justify-content: center;
    }
    
    .footer-copyright {
      padding-top: 1rem;
      font-size: 0.7rem;
    }
    
    .brand-name {
      font-size: 1.5rem;
    }
    
    .footer-heading {
      margin-bottom: 0.5rem;
    }
    
    .footer-section {
      padding-bottom: 0.5rem;
    }
  }
  
  /* Version responsive pour tablettes */
  @media (min-width: 768px) and (max-width: 991px) {
    .footer-content {
      grid-template-columns: repeat(2, 1fr);
      padding: 0 2rem 2rem;
    }
    
    .footer-brand {
      grid-column: 1 / -1;
      text-align: center;
      margin-bottom: 1rem;
    }
  }
  
  /* Version responsive pour grands écrans */
  @media (min-width: 992px) {
    .footer-content {
      padding: 0 2rem 2rem;
    }
  }
  </style>
<template>
    <footer class="footer py-4">
      <div class="container-fluid px-4">
        <div class="footer-content">
          <!-- Logo/Titre -->
          <div class="footer-brand">
            <h2 class="brand-name">BEE AESTHETIC</h2>
            <div class="footer-section">
                    <a href="#" @click.prevent="openTermsModal" class="footer-link">Termes et Conditions</a>
                </div>
          </div>
          
          <!-- Localisation -->
          <div class="footer-section">
            <h3 class="footer-heading">Localisation</h3>
            <!--<p class="footer-info">Avenue Louise, 1050 Bruxelles</p>-->
            <p class="footer-info">Bruxelles</p>
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
                <a href="https://www.instagram.com/beeaesthetic.be?igsh=OXZzc29xaTFhcXRv" target="_blank" class="social-link" aria-label="Instagram">
                <svg class="social-icon" viewBox="0 0 24 24" width="18" height="18">
                    <path fill="currentColor" d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zM12 0C8.741 0 8.333.014 7.053.072 2.695.272.273 2.69.073 7.052.014 8.333 0 8.741 0 12c0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98C8.333 23.986 8.741 24 12 24c3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98C15.668.014 15.259 0 12 0zm0 5.838a6.162 6.162 0 100 12.324 6.162 6.162 0 000-12.324zM12 16a4 4 0 110-8 4 4 0 010 8zm6.406-11.845a1.44 1.44 0 100 2.881 1.44 1.44 0 000-2.881z"/>
                </svg>
                </a>
                <a href="https://www.tiktok.com/@beeaesthetic.be?_t=ZN-8ue4z6yFei6&_r=1" target="_blank" class="social-link" aria-label="TikTok">
                <svg class="social-icon" viewBox="0 0 24 24" width="18" height="18">
                    <path fill="currentColor" d="M12.525.02c1.31-.02 2.61-.01 3.91-.02.08 1.53.63 3.09 1.75 4.17 1.12 1.11 2.7 1.62 4.24 1.79v4.03c-1.44-.05-2.89-.35-4.2-.97-.57-.26-1.1-.59-1.62-.93-.01 2.92.01 5.84-.02 8.75-.08 1.4-.54 2.79-1.35 3.94-1.31 1.92-3.58 3.17-5.91 3.21-1.43.08-2.86-.31-4.08-1.03-2.02-1.19-3.44-3.37-3.65-5.71-.02-.5-.03-1-.01-1.49.18-1.9 1.12-3.72 2.58-4.96 1.66-1.44 3.98-2.13 6.15-1.72.02 1.48-.04 2.96-.04 4.44-.99-.32-2.15-.23-3.02.37-.63.41-1.11 1.04-1.36 1.75-.21.51-.15 1.07-.14 1.61.24 1.64 1.82 3.02 3.5 2.87 1.12-.01 2.19-.66 2.77-1.61.19-.33.4-.67.41-1.06.1-1.79.06-3.57.07-5.36.01-4.03-.01-8.05.02-12.07z"/>
                </svg>
                </a>
            </div>
            </div>
        </div>
        
        <!-- Copyright -->
        <div class="footer-copyright">
          <p>© 2025 BEE AESTHETIC</p>
        </div>
      </div>
      <div v-if="isTermsModalOpen" class="terms-modal-overlay" @click.self="closeTermsModal">
            <div class="terms-modal">
                <button class="modal-close" @click="closeTermsModal">&times;</button>
                <h2>Conditions Générales de BEE AESTHETIC</h2>
                <div class="terms-content">
    <h3>1. Présentation de BEE AESTHETIC</h3>
    <ul>
        <li>BEE AESTHETIC est un salon spécialisé dans la manucure BIAB (Builder in a Bottle) et propose des formations professionnelles.</li>
        <li>Avec 4 ans d'expérience, nous garantissons un service de haute qualité dans un environnement propre, confortable et professionnel.</li>
    </ul>

    <h3>2. Tarifs</h3>
    <ul>
        <li>Les tarifs des prestations sont disponibles sur notre site de réservation.</li>
        <li>Ils peuvent évoluer en fonction des formations suivies et des investissements réalisés afin de garantir un service optimal.</li>
    </ul>

    <h3>3. Prise de rendez-vous et annulations</h3>
    <ul>
        <li>Les rendez-vous doivent être pris uniquement via le site ou le lien Instagram de BEE AESTHETIC.</li>
        <li>Toute annulation ou modification doit être effectuée au moins 48 heures à l'avance.</li>
        <li>Le montant payé pourra être utilisé pour une nouvelle réservation, mais aucun remboursement ne sera effectué.</li>
        <li>En cas d'annulation moins de 24 heures avant le rendez-vous ou en cas d'absence (no-show), le montant total de la prestation sera dû.</li>
        <li>Nous demandons aux clientes d'arriver à l'heure exacte :</li>
        <ul>
            <li>Retard de moins de 15 minutes : prestation écourtée, tarif complet maintenu</li>
            <li>Retard de plus de 15 minutes : prestation annulée et facturée en totalité</li>
        </ul>
        <li>Afin de préserver l'expérience privée de chaque cliente, il est demandé de venir seule, sauf exception préalablement discutée.</li>
    </ul>

    <h3>4. Formations BIAB</h3>
    <ul>
        <li>Les formations sont ouvertes aux professionnels et débutants.</li>
        <li>Une fois réservée, aucune annulation ou modification ne sera possible.</li>
        <li>Aucun remboursement ne sera effectué.</li>
    </ul>

    <h3>5. Paiement</h3>
    <ul>
        <li>Le paiement se fait en espèces ou via QR-code directement au salon.</li>
        <li>Toute prestation doit être réglée intégralement le jour même.</li>
        <li>Les prestations et formations payées en avance ne sont pas remboursables.</li>
    </ul>

    <h3>6. Hygiène et sécurité</h3>
    <ul>
        <li>L'hygiène est une priorité absolue.</li>
        <li>Tous les outils sont nettoyés et stérilisés selon les normes en vigueur.</li>
        <li>Toute personne présentant des problèmes de santé visibles pourra se voir refuser la prestation.</li>
        <li>BEE AESTHETIC ne pourra être tenue responsable des réactions allergiques ou dommages résultant de soins inappropriés.</li>
        <li>Il est essentiel d'informer en amont de toute allergie ou condition médicale particulière.</li>
    </ul>

    <h3>7. Protection des données personnelles</h3>
    <ul>
        <li>Toutes les informations personnelles sont traitées avec la plus grande confidentialité.</li>
        <li>Elles ne seront jamais partagées avec des tiers sans consentement préalable.</li>
    </ul>

    <h3>8. Contact</h3>
    <ul>
        <li>Pour toute question ou réclamation, contactez BEE AESTHETIC par e-mail à info@beeaesthetic.be.</li>
    </ul>

    <h3>9. Modifications des conditions générales</h3>
    <ul>
        <li>BEE AESTHETIC se réserve le droit de modifier ces conditions générales à tout moment.</li>
        <li>Toute mise à jour sera communiquée aux clientes.</li>
    </ul>

    <p><strong>En réservant une prestation chez BEE AESTHETIC, vous acceptez automatiquement ces conditions générales.</strong></p>
</div>
            </div>
        </div>
    </footer>
  </template>
  
  <script setup>
  import { ref } from 'vue'
  
  const isTermsModalOpen = ref(false)
  
  const openTermsModal = () => {
      isTermsModalOpen.value = true
  }
  
  const closeTermsModal = () => {
      isTermsModalOpen.value = false
  }
  </script>
  
  <style scoped>
  .social-icon {
  width: 20px;
  height: 20px;
  /* Suppression de la transition ici pour éviter les conflits */
}

.social-link {
  display: flex;
  align-items: center;
  justify-content: center;
  width: 36px;
  height: 36px;
  border-radius: 50%;
  border: 1px solid #ddd;
  /* Une seule transition pour tout */
  transition: all 0.3s ease;
}

.social-link:hover {
  border-color: #999;
  /* Réduction du mouvement vertical */
  transform: translateY(-2px);
  /* Ajout d'une ombre subtile au lieu d'une animation plus complexe */
  box-shadow: 0 2px 5px rgba(0, 0, 0, 0.05);
}


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
  .terms-modal-overlay {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0, 0, 0, 0.5);
    display: flex;
    justify-content: center;
    align-items: center;
    z-index: 1000;
}

.terms-modal {
    background-color: white;
    width: 90%;
    max-width: 800px;
    max-height: 80vh;
    overflow-y: auto;
    padding: 2rem;
    border-radius: 8px;
    position: relative;
    font-family: 'Montserrat', 'Raleway', 'Helvetica Neue', sans-serif;
}

.modal-close {
    position: absolute;
    top: 1rem;
    right: 1rem;
    background: none;
    border: none;
    font-size: 2rem;
    cursor: pointer;
    color: #333;
}

.terms-modal h2 {
    font-size: 1.5rem;
    margin-bottom: 1.5rem;
    color: #b3a090;
    text-align: center;
}

.terms-content h3 {
    font-size: 1.2rem;
    margin-top: 1.5rem;
    margin-bottom: 0.5rem;
    color: #333;
}

.terms-content p {
    line-height: 1.6;
    color: #666;
    margin-bottom: 1rem;
}

@media (max-width: 768px) {
    .terms-modal {
        width: 95%;
        padding: 1rem;
    }

    .terms-modal h2 {
        font-size: 1.3rem;
    }

    .terms-content h3 {
        font-size: 1.1rem;
    }
}
  </style>
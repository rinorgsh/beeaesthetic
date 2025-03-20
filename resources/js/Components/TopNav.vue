<template>
  <nav class="top-nav py-3">
    <div class="container-fluid px-4">
      <div class="d-flex justify-content-between align-items-center">
        <!-- Logo à gauche -->
        <div class="logo">
          <a href="/">
            <img src="Images/logo.png" alt="Logo" height="40">
          </a>
        </div>
        
        <!-- Bouton hamburger pour mobile -->
        <button class="navbar-toggler d-md-none" type="button" @click="isMenuOpen = !isMenuOpen">
          <span class="navbar-toggler-icon">
            <i class="hamburger-icon"></i>
          </span>
        </button>
        
        <!-- Menu navigation à droite (desktop) -->
        <div class="d-none d-md-flex align-items-center">
          <div class="nav-links me-4">
            <a href="/manicure" class="nav-link px-3">
              <span data-hover="Manicure & BIAB">Manicure & BIAB</span>
            </a>
            
            <a href="/gallerie" class="nav-link px-3">
              <span data-hover="Gallerie">Gallerie</span>
            </a>
            <a href="/formation" class="nav-link px-3">
              <span data-hover="Formation">Formation</span>
            </a>
            <a href="/reviews" class="nav-link px-3">
              <span data-hover="Reviews">Reviews</span>
            </a>
            <a href="/a-propos" class="nav-link px-3">
              <span data-hover="À propos">À propos</span>
            </a>
            <a href="/contact" class="nav-link px-3">
              <span data-hover="Contact">Contact</span>
            </a>
          </div>
          
          <!-- Bouton Rendez-vous -->
          <div>
            <a href="/rendez-vous" class="btn-rendez-vous px-4 py-2">Rendez-vous</a>
          </div>
        </div>
      </div>
      
      <!-- Menu mobile (s'ouvre et se ferme) -->
      <div class="mobile-menu" :class="{ 'open': isMenuOpen }">
        <div class="mobile-nav-links">
          <a href="/manicure" class="mobile-nav-link">Manicure & BIAB</a>
          <a href="/gallerie" class="mobile-nav-link">Gallerie</a>
          <a href="/formation" class="mobile-nav-link">Formation</a>
          <a href="/reviews" class="mobile-nav-link">Reviews</a>
          <a href="/a-propos" class="mobile-nav-link">À propos</a>
          <a href="/contact" class="mobile-nav-link">Contact</a>
          <a href="/rendez-vous" class="mobile-btn-rendez-vous">Rendez-vous</a>
        </div>
      </div>
    </div>
  </nav>
</template>

<script setup>
import { ref } from 'vue';

// État pour gérer l'ouverture/fermeture du menu mobile
const isMenuOpen = ref(false);
</script>

<style scoped>
.top-nav {
  background-color: #fafafa;
  font-family: 'Montserrat', 'Raleway', 'Helvetica Neue', sans-serif;
  font-weight: 300;
  position: relative;
}

.logo {
  height: 80px;
  width: 80px;
}

/* Styles pour la navigation desktop */
.nav-links {
  display: flex;
}

.nav-link {
  color: #333;
  text-decoration: none;
  font-size: 0.9rem;
  letter-spacing: 1px;
  text-transform: uppercase;
  font-weight: 400;
  position: relative;
  overflow: hidden;
  display: inline-block;
}

/* Premier effet de survol - animation de texte avec translation */
.nav-link span {
  position: relative;
  display: inline-block;
  transition: transform 0.3s;
}

.nav-link span::before {
  position: absolute;
  top: 100%;
  content: attr(data-hover);
  transform: translate3d(0, 0, 0);
}

.nav-link:hover span {
  transform: translateY(-100%);
}

/* Deuxième effet - ligne d'animation sous le lien */
.nav-link::after {
  content: '';
  position: absolute;
  bottom: -2px;
  left: 0;
  width: 100%;
  height: 1px;
  background-color: #000;
  transform: scaleX(0);
  transform-origin: right;
  transition: transform 0.3s ease-out;
}

.nav-link:hover::after {
  transform: scaleX(1);
  transform-origin: left;
}

.btn-rendez-vous {
  background-color: #000;
  color: #fff;
  text-decoration: none;
  border-radius: 30px;
  font-size: 0.85rem;
  font-weight: 400;
  letter-spacing: 1px;
  text-transform: uppercase;
  transition: all 0.3s;
  display: inline-block;
}

.btn-rendez-vous:hover {
  background-color: #222;
  transform: translateY(-1px);
  box-shadow: 0 2px 5px rgba(0,0,0,0.1);
}

/* Styles pour le menu hamburger */
.navbar-toggler {
  border: none;
  background: transparent;
  cursor: pointer;
  padding: 5px;
}

.hamburger-icon {
  display: block;
  position: relative;
  width: 24px;
  height: 2px;
  background-color: #000;
}

.hamburger-icon::before,
.hamburger-icon::after {
  content: '';
  position: absolute;
  width: 24px;
  height: 2px;
  background-color: #000;
  transition: all 0.3s ease;
}

.hamburger-icon::before {
  top: -8px;
}

.hamburger-icon::after {
  bottom: -8px;
}

/* Menu mobile */
.mobile-menu {
  display: none;
  width: 100%;
  padding: 20px 0;
  background-color: #fafafa;
  box-shadow: 0 4px 6px rgba(0,0,0,0.1);
  position: absolute;
  top: 100%;
  left: 0;
  right: 0;
  z-index: 1000;
  transform: translateY(-20px);
  opacity: 0;
  transition: all 0.3s ease;
  pointer-events: none;
}

.mobile-menu.open {
  display: block;
  transform: translateY(0);
  opacity: 1;
  pointer-events: auto;
}

.mobile-nav-links {
  display: flex;
  flex-direction: column;
  align-items: center;
  gap: 15px;
}

.mobile-nav-link {
  color: #333;
  text-decoration: none;
  font-size: 1rem;
  text-transform: uppercase;
  letter-spacing: 1px;
  padding: 10px 0;
  width: 100%;
  text-align: center;
  transition: all 0.3s;
}

.mobile-nav-link:hover {
  background-color: #f0f0f0;
}

.mobile-btn-rendez-vous {
  background-color: #000;
  color: #fff;
  text-decoration: none;
  border-radius: 30px;
  font-size: 0.9rem;
  font-weight: 400;
  letter-spacing: 1px;
  text-transform: uppercase;
  padding: 10px 30px;
  margin-top: 10px;
  display: inline-block;
  text-align: center;
}

/* Styles pour tablettes (iPad) */
@media (min-width: 768px) and (max-width: 1023px) {
  .nav-link {
    font-size: 0.8rem;
    padding: 0 10px !important;
  }
  
  .btn-rendez-vous {
    font-size: 0.8rem;
    padding: 8px 16px !important;
  }
}

/* Styles pour mobiles (iPhone) */
@media (max-width: 767px) {
  .logo {
    height: 70px;
    width: 70px;
  }
  
  
}
</style>
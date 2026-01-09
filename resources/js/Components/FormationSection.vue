<template>
    <!-- Hero Section -->
    <section class="formation-hero">
      <div class="container">
        <h1 class="hero-title">{{ t.formation.page_title }}</h1>
        <p class="hero-subtitle">{{ t.formation.page_subtitle }}</p>
      </div>
    </section>

    <section class="formation-content-section">
      <div class="container">
        <div class="content-block">
          <h2 class="section-title">{{ t.formation.training_title }}</h2>
          <div class="section-text" v-html="t.formation.training_content"></div>
          <div class="button-container">
            <a href="/contact" class="contact-button">{{ t.formation.contact_button }}</a>
          </div>
        </div>

        <div class="content-block">
          <h2 class="section-title">{{ t.formation.ebook_title }}</h2>
          <div class="section-text" v-html="t.formation.ebook_content"></div>
          <div class="button-container">
            <a href="/shop" class="contact-button">{{ t.formation.shop_button }}</a>
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
  /* Hero Section */
  .formation-hero {
    padding: 4rem 0 2.5rem;
    background-color: #f5e6db;
    font-family: 'Montserrat', 'Raleway', 'Helvetica Neue', sans-serif;
    text-align: center;
  }

  .hero-title {
    font-size: 3rem;
    font-weight: 300;
    color: #333;
    letter-spacing: 1px;
    margin-bottom: 0.8rem;
  }

  .hero-subtitle {
    font-size: 1rem;
    font-weight: 300;
    color: #555;
    line-height: 1.8;
    max-width: 600px;
    margin: 0 auto;
  }

  /* Content Section */
  .formation-content-section {
    padding: 5rem 0;
    background-color: #f8f8f8;
    font-family: 'Montserrat', 'Raleway', 'Helvetica Neue', sans-serif;
  }

  .container {
    max-width: 1000px;
    margin: 0 auto;
    padding: 0 2rem;
  }

  .content-block {
    margin-bottom: 5rem;
    padding-bottom: 4rem;
    border-bottom: 1px solid #e6cfc2;
  }

  .content-block:last-child {
    border-bottom: none;
    margin-bottom: 0;
    padding-bottom: 0;
  }

  .section-title {
    font-size: 2rem;
    font-weight: 400;
    color: #b3a090;
    margin-bottom: 2rem;
    letter-spacing: 0.5px;
    text-align: center;
  }

  .section-text {
    font-size: 1.05rem;
    line-height: 1.9;
    color: #555;
    text-align: justify;
    margin-bottom: 2.5rem;
  }

  .section-text :deep(p) {
    margin-bottom: 1.5rem;
  }

  .section-text :deep(strong) {
    color: #b3a090;
    font-weight: 500;
  }

  .button-container {
    text-align: center;
    margin-top: 2.5rem;
  }

  .contact-button {
    display: inline-block;
    padding: 12px 40px;
    background-color: #e6cfc2;
    color: #333;
    text-decoration: none;
    border-radius: 30px;
    font-size: 0.85rem;
    font-weight: 400;
    letter-spacing: 1px;
    text-transform: uppercase;
    transition: all 0.3s;
  }

  .contact-button:hover {
    background-color: #dbbcab;
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(230, 207, 194, 0.4);
  }

  /* Responsive */
  @media (max-width: 991px) {
    .formation-hero {
      padding: 3.5rem 0 2rem;
    }

    .hero-title {
      font-size: 2.5rem;
    }

    .formation-content-section {
      padding: 4rem 0;
    }

    .section-title {
      font-size: 1.7rem;
    }

    .section-text {
      font-size: 1rem;
    }
  }

  @media (max-width: 767px) {
    .formation-hero {
      padding: 3rem 0 1.5rem;
    }

    .hero-title {
      font-size: 2.2rem;
    }

    .formation-content-section {
      padding: 3rem 0;
    }

    .container {
      padding: 0 1.5rem;
    }

    .section-title {
      font-size: 1.5rem;
    }

    .section-text {
      font-size: 0.95rem;
      text-align: left;
    }

    .content-block {
      margin-bottom: 3.5rem;
      padding-bottom: 3rem;
    }

    .contact-button {
      width: 100%;
      max-width: 300px;
    }
  }
  </style>
<template>
  <section class="formation-widget">
    <div class="container">
      <div class="formation-card">
        <div class="formation-content">
          <h2 class="formation-title">{{ t.services.training_title }}</h2>
          <p class="formation-description">{{ t.services.training_desc }}</p>
          <a href="/formation" class="formation-button">{{ t.services.learn_more }}</a>
        </div>
        <div class="formation-image">
          <img src="/Images/formation.jpeg" :alt="t.services.training_title">
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
.formation-widget {
  padding: 4rem 0;
  background-color: #fafafa;
  font-family: 'Montserrat', 'Raleway', 'Helvetica Neue', sans-serif;
}

.container {
  max-width: 1200px;
  margin: 0 auto;
  padding: 0 2rem;
}

.formation-card {
  display: grid;
  grid-template-columns: 1fr 1fr;
  gap: 3rem;
  align-items: center;
  background: white;
  border-radius: 20px;
  overflow: hidden;
  box-shadow: 0 10px 40px rgba(0, 0, 0, 0.08);
}

.formation-content {
  padding: 3rem 3rem 3rem 4rem;
}

.formation-title {
  font-size: 2rem;
  font-weight: 400;
  color: #333;
  margin-bottom: 1.5rem;
  letter-spacing: 0.5px;
  line-height: 1.3;
}

.formation-description {
  font-size: 1rem;
  line-height: 1.8;
  color: #666;
  margin-bottom: 2.5rem;
  font-weight: 300;
}

.formation-button {
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

.formation-button:hover {
  background-color: #dbbcab;
  transform: translateY(-2px);
  box-shadow: 0 4px 12px rgba(230, 207, 194, 0.4);
}

.formation-image {
  height: 100%;
  min-height: 400px;
  position: relative;
  overflow: hidden;
}

.formation-image img {
  width: 100%;
  height: 100%;
  object-fit: cover;
  transition: transform 0.6s ease;
}

.formation-card:hover .formation-image img {
  transform: scale(1.05);
}

/* Responsive */
@media (max-width: 991px) {
  .formation-widget {
    padding: 3rem 0;
  }

  .formation-card {
    grid-template-columns: 1fr;
    gap: 0;
  }

  .formation-content {
    padding: 3rem 2rem;
  }

  .formation-title {
    font-size: 1.7rem;
  }

  .formation-description {
    font-size: 0.95rem;
  }

  .formation-image {
    min-height: 300px;
  }
}

@media (max-width: 767px) {
  .container {
    padding: 0 1rem;
  }

  .formation-content {
    padding: 2rem 1.5rem;
  }

  .formation-title {
    font-size: 1.5rem;
    margin-bottom: 1rem;
  }

  .formation-description {
    font-size: 0.9rem;
    margin-bottom: 2rem;
  }

  .formation-image {
    min-height: 200px;
  }
}

@media (max-width: 480px) {
  .formation-image {
    min-height: 180px;
  }

  .formation-description {
    font-size: 0.85rem;
  }
}
</style>

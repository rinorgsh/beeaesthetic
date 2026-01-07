<template>
  <section class="welcome-section">
    <div class="container">
      <div class="welcome-content">
        <p class="welcome-text" v-html="t.welcome.paragraph1"></p>
        <p class="welcome-text" v-html="t.welcome.paragraph2"></p>
        <p class="welcome-text" v-html="t.welcome.paragraph3"></p>
        <p class="welcome-text" v-html="t.welcome.paragraph4"></p>
      </div>
    </div>
  </section>
</template>

<script setup>
import { useTranslation } from '@/composables/useTranslation'

const { t } = useTranslation()
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
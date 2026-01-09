<template>
    <!-- Hero Section -->
    <section class="contact-hero">
        <div class="container">
            <h1 class="hero-title">{{ t.contact.title }}</h1>
            <p class="hero-subtitle">{{ t.contact.subtitle }}</p>
        </div>
    </section>

    <section class="contact-section">
        <div class="container">
            <div class="contact-form-container">

                <!-- Message de notification -->
                <div
                    v-if="notification.message"
                    :class="[
                        'notification',
                        notification.type === 'success' ? 'success' : 'error'
                    ]"
                >
                    {{ notification.message }}
                </div>

                <div class="contact-text">
                    <a href="mailto:info@beeaesthetic.be" class="contact-email">info@beeaesthetic.be</a>
                </div>
                
                <form @submit.prevent="handleSubmit" class="contact-form">
                    <div class="form-group-name">
                        <div class="form-field">
                            <label for="prenom">{{ t.contact.first_name }}</label>
                            <input
                                type="text"
                                id="prenom"
                                v-model="formData.prenom"
                                class="form-control"
                                required
                            >
                        </div>

                        <div class="form-field">
                            <label for="nom">{{ t.contact.last_name }}</label>
                            <input
                                type="text"
                                id="nom"
                                v-model="formData.nom"
                                class="form-control"
                                required
                            >
                        </div>
                    </div>

                    <div class="form-field">
                        <label for="email">{{ t.contact.email }} <span class="required">{{ t.contact.required }}</span></label>
                        <input
                            type="email"
                            id="email"
                            v-model="formData.email"
                            class="form-control"
                            required
                        >
                    </div>

                    <div class="form-field">
                        <label for="message">{{ t.contact.message }} <span class="required">{{ t.contact.required }}</span></label>
                        <textarea
                            id="message"
                            v-model="formData.message"
                            class="form-control"
                            rows="5"
                            required
                        ></textarea>
                    </div>

                    <div class="form-submit">
                        <button type="submit" class="btn-submit">{{ t.contact.send }}</button>
                    </div>
                </form>
            </div>
        </div>
    </section>
</template>

<script setup>
import { ref } from 'vue'
import axios from 'axios'
import { useTranslation } from '@/composables/useTranslation'

const { t } = useTranslation()

const formData = ref({
    prenom: '',
    nom: '',
    email: '',
    message: ''
})

const notification = ref({
    message: '',
    type: ''
})

// Fonction pour réinitialiser le message après un délai
const clearNotification = () => {
    setTimeout(() => {
        notification.value.message = ''
        notification.value.type = ''
    }, 5000)
}

const handleSubmit = async () => {
    try {
        const response = await axios.post('/contact', {
            prenom: formData.value.prenom,
            nom: formData.value.nom,
            email: formData.value.email,
            message: formData.value.message
        });
        
        // Message de succès
        notification.value = {
            message: t.value.contact.success,
            type: 'success'
        }
        
        // Réinitialiser le formulaire
        formData.value = {
            prenom: '',
            nom: '',
            email: '',
            message: ''
        };

        clearNotification()
    } catch (error) {
        // Gestion des erreurs
        notification.value = {
            message: t.value.contact.error,
            type: 'error'
        }
        console.error(error);
        clearNotification()
    }
}
</script>

<!-- Le reste du style reste identique -->
  
  <style scoped>
  .notification {
    padding: 15px;
    margin-bottom: 20px;
    border-radius: 4px;
    text-align: center;
    font-weight: bold;
    transition: opacity 0.3s ease;
}

.notification.success {
    background-color: #d4edda;
    color: #155724;
    border: 1px solid #c3e6cb;
}

.notification.error {
    background-color: #f8d7da;
    color: #721c24;
    border: 1px solid #f5c6cb;
}
  /* Hero Section */
  .contact-hero {
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

  .contact-section {
    padding: 5rem 0;
    background-color: #f8f8f8;
    font-family: 'Montserrat', 'Raleway', 'Helvetica Neue', sans-serif;
  }

  .container {
    max-width: 1200px;
    margin: 0 auto;
    padding: 0 1.5rem;
  }

  .contact-form-container {
    max-width: 700px;
    margin: 0 auto;
    text-align: center;
  }
  
  .contact-text {
    margin-bottom: 3rem;
  }
  
  .contact-text p {
    font-size: 1rem;
    line-height: 1.8;
    color: #555;
    margin-bottom: 1.5rem;
  }
  
  .contact-email {
    font-size: 1rem;
    color: #333;
    text-decoration: underline;
    display: inline-block;
    margin-top: 0.5rem;
    transition: color 0.3s;
  }
  
  .contact-email:hover {
    color: #b3a090;
  }
  
  .contact-form {
    margin-top: 2rem;
    text-align: left;
  }
  
  .form-group-name {
    display: flex;
    gap: 1rem;
    margin-bottom: 1.5rem;
  }
  
  .form-field {
    margin-bottom: 1.5rem;
    width: 100%;
  }
  
  label {
    display: block;
    margin-bottom: 0.5rem;
    font-size: 0.9rem;
    color: #555;
  }
  
  .required {
    font-size: 0.8rem;
    font-weight: 300;
    color: #777;
  }
  
  .form-control {
    width: 100%;
    padding: 0.8rem 1rem;
    border: 1px solid #e6cfc2;
    border-radius: 4px;
    font-size: 0.95rem;
    color: #333;
    background-color: #fff;
    transition: border-color 0.3s;
    font-family: 'Montserrat', 'Raleway', 'Helvetica Neue', sans-serif;
  }

  .form-control:focus {
    outline: none;
    border-color: #b3a090;
  }
  
  textarea.form-control {
    resize: vertical;
    min-height: 120px;
  }
  
  .form-submit {
    margin-top: 2rem;
    text-align: center;
  }
  
  .btn-submit {
    padding: 12px 40px;
    background-color: #e6cfc2;
    color: #333;
    border: none;
    border-radius: 30px;
    font-size: 0.85rem;
    font-weight: 400;
    letter-spacing: 1px;
    cursor: pointer;
    transition: all 0.3s;
    text-transform: uppercase;
  }

  .btn-submit:hover {
    background-color: #dbbcab;
    transform: translateY(-1px);
    box-shadow: 0 2px 5px rgba(230, 207, 194, 0.3);
  }
  
  /* Media queries pour responsive */
  @media (max-width: 991px) {
    .contact-hero {
      padding: 3.5rem 0 2rem;
    }

    .hero-title {
      font-size: 2.5rem;
    }

    .contact-section {
      padding: 4rem 0;
    }
  }

  @media (max-width: 767px) {
    .contact-hero {
      padding: 3rem 0 1.5rem;
    }

    .hero-title {
      font-size: 2.2rem;
    }

    .contact-section {
      padding: 3rem 0;
    }

    .form-group-name {
      flex-direction: column;
      gap: 0;
    }

    .btn-submit {
      width: 100%;
    }
  }
  </style>
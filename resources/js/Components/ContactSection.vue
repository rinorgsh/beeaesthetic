<template>
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

                <h1 class="contact-title">Nous contacter</h1>
                
                <div class="contact-text">
                    <p>
                        Vous avez des questions, besoin de conseils ou souhaitez prendre rendez-vous ?
                        Je suis à votre disposition pour répondre à toutes vos demandes.
                    </p>
                    
                    <a href="mailto:info@beeaesthetic.be" class="contact-email">info@beeaesthetic.be</a>
                </div>
                
                <form @submit.prevent="handleSubmit" class="contact-form">
                    <div class="form-group-name">
                        <div class="form-field">
                            <label for="prenom">Prénom</label>
                            <input 
                                type="text" 
                                id="prenom" 
                                v-model="formData.prenom" 
                                class="form-control"
                                required
                            >
                        </div>
                        
                        <div class="form-field">
                            <label for="nom">Nom de famille</label>
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
                        <label for="email">E-mail <span class="required">(obligatoire)</span></label>
                        <input 
                            type="email" 
                            id="email" 
                            v-model="formData.email" 
                            class="form-control" 
                            required
                        >
                    </div>
                    
                    <div class="form-field">
                        <label for="message">Message <span class="required">(obligatoire)</span></label>
                        <textarea 
                            id="message" 
                            v-model="formData.message" 
                            class="form-control" 
                            rows="5" 
                            required
                        ></textarea>
                    </div>
                    
                    <div class="form-submit">
                        <button type="submit" class="btn-submit">ENVOYER</button>
                    </div>
                </form>
            </div>
        </div>
    </section>
</template>

<script setup>
import { ref } from 'vue'
import axios from 'axios'

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
            message: 'Message envoyé avec succès !',
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
            message: 'Erreur lors de l\'envoi du message',
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
  
  .contact-title {
    font-size: 3.2rem;
    font-weight: 300;
    color: #555;
    margin-bottom: 2rem;
    letter-spacing: 0.5px;
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
    border: 1px solid #ddd;
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
    padding: 0.8rem 2.5rem;
    background-color: #000;
    color: #fff;
    border: none;
    border-radius: 50px;
    font-size: 0.9rem;
    letter-spacing: 1px;
    cursor: pointer;
    transition: all 0.3s ease;
    text-transform: uppercase;
  }
  
  .btn-submit:hover {
    background-color: #333;
    transform: translateY(-2px);
  }
  
  /* Media queries pour responsive */
  @media (max-width: 991px) {
    .contact-section {
      padding: 4rem 0;
    }
    
    .contact-title {
      font-size: 2.8rem;
    }
  }
  
  @media (max-width: 767px) {
    .contact-section {
      padding: 3rem 0;
    }
    
    .contact-title {
      font-size: 2.3rem;
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
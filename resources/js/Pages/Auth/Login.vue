<script setup>
import Checkbox from '@/Components/Checkbox.vue';
import GuestLayout from '@/Layouts/GuestLayout.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';

defineProps({
    canResetPassword: {
        type: Boolean,
    },
    status: {
        type: String,
    },
});

const form = useForm({
    email: '',
    password: '',
    remember: false,
});

const submit = () => {
    form.post(route('login'), {
        onFinish: () => form.reset('password'),
    });
};
</script>

<template>
    <Head title="Connexion - Bee Aesthetic" />
    
    <div class="login-page">
        <div class="login-container">
            <!-- Logo et titre -->
            <div class="login-header">
                <img src="/Images/logo.png" alt="Bee Aesthetic" class="logo">
                <h1 class="login-title">Espace Administration</h1>
                <p class="login-subtitle">Connectez-vous pour accéder au panneau d'administration</p>
            </div>

            <!-- Message de status -->
            <div v-if="status" class="status-message">
                {{ status }}
            </div>

            <!-- Formulaire -->
            <form @submit.prevent="submit" class="login-form">
                <!-- Email -->
                <div class="form-group">
                    <InputLabel for="email" value="Adresse email" class="custom-label" />
                    <TextInput
                        id="email"
                        type="email"
                        class="custom-input"
                        v-model="form.email"
                        required
                        autofocus
                        autocomplete="username"
                        placeholder="votre@email.com"
                    />
                    <InputError class="error-message" :message="form.errors.email" />
                </div>

                <!-- Mot de passe -->
                <div class="form-group">
                    <InputLabel for="password" value="Mot de passe" class="custom-label" />
                    <TextInput
                        id="password"
                        type="password"
                        class="custom-input"
                        v-model="form.password"
                        required
                        autocomplete="current-password"
                        placeholder="••••••••"
                    />
                    <InputError class="error-message" :message="form.errors.password" />
                </div>

                <!-- Remember me -->
                <div class="remember-group">
                    <label class="remember-label">
                        <Checkbox name="remember" v-model:checked="form.remember" />
                        <span class="remember-text">Se souvenir de moi</span>
                    </label>
                </div>

                <!-- Boutons -->
                <div class="form-actions">
                    <Link
                        v-if="canResetPassword"
                        :href="route('password.request')"
                        class="forgot-link"
                    >
                        Mot de passe oublié ?
                    </Link>

                    <button
                        type="submit"
                        class="login-btn"
                        :class="{ 'opacity-50': form.processing }"
                        :disabled="form.processing"
                    >
                        <span v-if="!form.processing">Se connecter</span>
                        <span v-else>Connexion...</span>
                    </button>
                </div>
            </form>

            <!-- Retour au site -->
            <div class="back-to-site">
                <Link href="/" class="back-link">
                    ← Retour au site
                </Link>
            </div>
        </div>
    </div>
</template>

<style scoped>
.login-page {
    min-height: 100vh;
    display: flex;
    align-items: center;
    justify-content: center;
    background-color: #f8f8f8;
    padding: 2rem 1rem;
    font-family: 'Montserrat', 'Raleway', 'Helvetica Neue', sans-serif;
}

.login-container {
    background: white;
    padding: 3rem;
    border-radius: 20px;
    box-shadow: 0 10px 40px rgba(0, 0, 0, 0.08);
    width: 100%;
    max-width: 450px;
}

.login-header {
    text-align: center;
    margin-bottom: 2.5rem;
}

.logo {
    width: 120px;
    height: auto;
    margin-bottom: 1.5rem;
}

.login-title {
    font-size: 2rem;
    font-weight: 300;
    color: #b3a090;
    margin-bottom: 0.5rem;
    letter-spacing: 1px;
}

.login-subtitle {
    font-size: 0.95rem;
    color: #777;
    font-weight: 300;
    letter-spacing: 0.3px;
}

.status-message {
    background-color: #d4edda;
    border: 1px solid #c3e6cb;
    color: #155724;
    padding: 1rem;
    border-radius: 10px;
    margin-bottom: 1.5rem;
    font-size: 0.9rem;
    text-align: center;
}

.login-form {
    margin-bottom: 2rem;
}

.form-group {
    margin-bottom: 1.5rem;
}

.custom-label {
    display: block;
    font-size: 0.9rem;
    color: #555;
    margin-bottom: 0.5rem;
    font-weight: 400;
    letter-spacing: 0.3px;
}

.custom-input {
    width: 100%;
    padding: 0.9rem 1.2rem;
    border: 1px solid #ddd;
    border-radius: 50px;
    font-size: 1rem;
    color: #555;
    transition: all 0.3s ease;
    font-family: 'Montserrat', sans-serif;
}

.custom-input:focus {
    outline: none;
    border-color: #b3a090;
    box-shadow: 0 0 0 3px rgba(179, 160, 144, 0.1);
}

.custom-input::placeholder {
    color: #aaa;
}

.error-message {
    color: #dc3545;
    font-size: 0.85rem;
    margin-top: 0.5rem;
    display: block;
}

.remember-group {
    margin-bottom: 1.5rem;
}

.remember-label {
    display: flex;
    align-items: center;
    cursor: pointer;
}

.remember-text {
    margin-left: 0.5rem;
    font-size: 0.9rem;
    color: #555;
    letter-spacing: 0.3px;
}

.form-actions {
    display: flex;
    flex-direction: column;
    gap: 1rem;
    align-items: center;
}

.forgot-link {
    font-size: 0.9rem;
    color: #b3a090;
    text-decoration: none;
    letter-spacing: 0.3px;
    transition: color 0.3s ease;
}

.forgot-link:hover {
    color: #8d7a6a;
    text-decoration: underline;
}

.login-btn {
    width: 100%;
    padding: 1rem 2rem;
    background-color: transparent;
    border: 1px solid #999;
    border-radius: 50px;
    color: #555;
    font-size: 1rem;
    font-weight: 400;
    letter-spacing: 0.5px;
    cursor: pointer;
    transition: all 0.3s ease;
    font-family: 'Montserrat', sans-serif;
}

.login-btn:hover:not(:disabled) {
    background-color: rgba(0, 0, 0, 0.05);
    transform: translateY(-2px);
}

.login-btn:disabled {
    cursor: not-allowed;
    opacity: 0.6;
}

.login-btn.opacity-50 {
    opacity: 0.6;
}

.back-to-site {
    text-align: center;
    padding-top: 1.5rem;
    border-top: 1px solid #eee;
}

.back-link {
    color: #777;
    text-decoration: none;
    font-size: 0.9rem;
    letter-spacing: 0.3px;
    transition: color 0.3s ease;
}

.back-link:hover {
    color: #b3a090;
}

/* Responsive */
@media (max-width: 767px) {
    .login-container {
        padding: 2rem 1.5rem;
    }

    .logo {
        width: 100px;
    }

    .login-title {
        font-size: 1.6rem;
    }

    .login-subtitle {
        font-size: 0.85rem;
    }

    .form-actions {
        gap: 1.5rem;
    }
}

@media (max-width: 480px) {
    .login-page {
        padding: 1rem;
    }

    .login-container {
        padding: 2rem 1rem;
    }

    .logo {
        width: 80px;
    }

    .login-title {
        font-size: 1.4rem;
    }
}
</style>
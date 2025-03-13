<template>
    <TopNav/>
    <section class="not-found-section">
        
        <div class="container">
            <div class="not-found-content">
                <h1 class="not-found-title">404</h1>
                <h2 class="not-found-subtitle">Page Introuvable</h2>
                
                <p class="not-found-description">
                    Désolé, la page que vous recherchez n'existe pas ou a été déplacée.
                </p>
                
                <div class="not-found-actions">
                   
                    <a href="/" class="btn-return">
                    <span >Home</span>
                     </a>
                </div>
                
            </div>
        </div>
    </section>
    <Footer/>
</template>

<script setup>
  import TopNav from '@/Components/TopNav.vue';
  import Footer from '@/Components/Footer.vue';

</script>

<style scoped>
.not-found-section {
    padding: 5rem 0;
    background-color: #f8f8f8;
    font-family: 'Montserrat', 'Raleway', 'Helvetica Neue', sans-serif;
    min-height: 100vh;
    display: flex;
    align-items: center;
    justify-content: center;
    text-align: center;
}

.container {
    max-width: 800px;
    margin: 0 auto;
    padding: 0 1.5rem;
}

.not-found-title {
    font-size: 10rem;
    font-weight: 300;
    color: #b3a090;
    margin-bottom: 1rem;
    letter-spacing: 5px;
    line-height: 1;
}

.not-found-subtitle {
    font-size: 3rem;
    font-weight: 300;
    color: #555;
    margin-bottom: 2rem;
    letter-spacing: 1px;
}

.not-found-description {
    font-size: 1.2rem;
    color: #777;
    margin-bottom: 2.5rem;
    line-height: 1.6;
}

.not-found-actions {
    margin-bottom: 2.5rem;
}

.btn-return {
    display: inline-block;
    padding: 0.8rem 2.5rem;
    background-color: #000;
    color: #fff;
    text-decoration: none;
    border-radius: 50px;
    font-size: 0.9rem;
    letter-spacing: 1px;
    transition: all 0.3s ease;
    text-transform: uppercase;
}

.btn-return:hover {
    background-color: #333;
    transform: translateY(-2px);
}

.not-found-suggestions {
    background-color: white;
    padding: 2rem;
    border-radius: 8px;
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.05);
}

.not-found-suggestions h3 {
    font-size: 1.3rem;
    color: #b3a090;
    margin-bottom: 1.5rem;
    font-weight: 400;
}

.not-found-suggestions ul {
    list-style: none;
    padding: 0;
    display: flex;
    justify-content: center;
    gap: 2rem;
}

.not-found-suggestions ul li a {
    color: #555;
    text-decoration: none;
    transition: color 0.3s ease;
}

.not-found-suggestions ul li a:hover {
    color: #b3a090;
}

/* Responsive */
@media (max-width: 768px) {
    .not-found-title {
        font-size: 6rem;
    }

    .not-found-subtitle {
        font-size: 2.5rem;
    }

    .not-found-suggestions ul {
        flex-direction: column;
        align-items: center;
        gap: 1rem;
    }
}
</style>
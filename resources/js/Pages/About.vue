<template>
    <TopNav />
    <AboutSection />
    <Rdv />
    <SocialSection />


    <Footer />

</template>

<script setup>
import TopNav from '@/Components/TopNav.vue';

import Footer from '@/Components/Footer.vue';
import AboutSection from '@/Components/AboutSection.vue';

import Rdv from '@/Components/RdvSection.vue';
import SocialSection from '@/Components/SocialSection.vue';





// Récupération des props passées par le contrôleur
defineProps({
  title: String,
});
</script>
<template>
    <TopNav />
    <AboutSection />
    <Rdv />
    <SocialSection />


    <Footer />

</template>

<script setup>
import TopNav from '@/Components/TopNav.vue';

import Footer from '@/components/Footer.vue';
import AboutSection from '@/components/AboutSection.vue';

import Rdv from '@/components/RdvSection.vue';
import SocialSection from '@/components/SocialSection.vue';





// Récupération des props passées par le contrôleur
defineProps({
  title: String,
});
</script>
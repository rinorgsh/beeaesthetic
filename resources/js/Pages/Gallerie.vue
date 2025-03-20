<template>
    <TopNav />
    <GallerieSection />

    <Footer />

</template>

<script setup>
import TopNav from '@/Components/TopNav.vue';
import Footer from '@/Components/Footer.vue';
import GallerieSection from '@/Components/GallerieSection.vue';






// Récupération des props passées par le contrôleur
defineProps({
  title: String,
});
</script>
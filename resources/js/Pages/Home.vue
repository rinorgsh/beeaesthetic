<template>
      <TopNav />
      <HeroBanner />
      <WelcomeSection />
      <ServiceSection />
      <FormationWidget />
      <Rdv />
      <SocialSection />


      <Footer />

  </template>

  <script setup>
  import TopNav from '@/Components/TopNav.vue';
  import HeroBanner from '@/Components/HeroBanner.vue';
  import Footer from '@/Components/Footer.vue';
  import AboutSection from '@/Components/AboutSection.vue';
  import WelcomeSection from '@/Components/WelcomeSection.vue';
  import ServiceSection from '@/Components/ServiceSection.vue';
  import FormationWidget from '@/Components/FormationWidget.vue';
  import Rdv from '@/Components/RdvSection.vue';
  import SocialSection from '@/Components/SocialSection.vue';





  // Récupération des props passées par le contrôleur
  defineProps({
    title: String,
  });
  </script>
<template>
      <TopNav />
      <HeroBanner />
      <WelcomeSection />
      <ServiceSection />
      <Rdv />
      <SocialSection />


      <Footer />

  </template>
  
  <script setup>
  import TopNav from '@/Components/TopNav.vue';
  import HeroBanner from '@/components/HeroBanner.vue';
  import Footer from '@/components/Footer.vue';
  import AboutSection from '@/components/AboutSection.vue';
  import WelcomeSection from '@/components/WelcomeSection.vue';
  import ServiceSection from '@/components/ServiceSection.vue';
  import Rdv from '@/components/RdvSection.vue';
  import SocialSection from '@/components/SocialSection.vue';





  // Récupération des props passées par le contrôleur
  defineProps({
    title: String,
  });
  </script>
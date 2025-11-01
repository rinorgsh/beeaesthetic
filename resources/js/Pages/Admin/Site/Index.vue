<template>
    <div>
      <TopNav />
      
      <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <!-- Header -->
        <div class="flex items-center mb-8">
          <Link 
            href="/admin"
            class="mr-4 text-gray-600 hover:text-gray-900"
          >
            <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
            </svg>
          </Link>
          <h1 class="text-3xl font-bold text-gray-900">Gestion du site</h1>
        </div>
  
        <!-- Section Galerie -->
        <div class="bg-white rounded-lg shadow-md p-8 mb-6">
          <div class="flex items-center mb-4">
            <svg class="h-8 w-8 text-purple-600 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
            </svg>
            <h2 class="text-2xl font-bold text-gray-900">Galerie photos</h2>
          </div>
          
          <p class="text-gray-600 mb-6">
            Gérez les photos qui s'affichent dans la section galerie de votre site.
          </p>
  
          <div class="bg-blue-50 border-l-4 border-blue-400 p-4">
            <div class="flex">
              <div class="flex-shrink-0">
                <svg class="h-5 w-5 text-blue-400" fill="currentColor" viewBox="0 0 20 20">
                  <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"></path>
                </svg>
              </div>
              <div class="ml-3">
                <p class="text-sm text-blue-700">
                  <span class="font-medium">Fonctionnalité à venir</span><br>
                  L'ajout et la gestion des photos de galerie seront bientôt disponibles.
                </p>
              </div>
            </div>
          </div>
        </div>
  
        <!-- Section Images des services -->
        <div class="bg-white rounded-lg shadow-md p-8">
          <div class="flex items-center mb-4">
            <svg class="h-8 w-8 text-purple-600 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21a4 4 0 01-4-4V5a2 2 0 012-2h4a2 2 0 012 2v12a4 4 0 01-4 4zm0 0h12a2 2 0 002-2v-4a2 2 0 00-2-2h-2.343M11 7.343l1.657-1.657a2 2 0 012.828 0l2.829 2.829a2 2 0 010 2.828l-8.486 8.485M7 17h.01"></path>
            </svg>
            <h2 class="text-2xl font-bold text-gray-900">Images des services</h2>
          </div>
          
          <p class="text-gray-600 mb-6">
            Gérez les images de vos services (Manicure, BIAB, formations, etc.)
          </p>
  
          <div class="bg-blue-50 border-l-4 border-blue-400 p-4">
            <div class="flex">
              <div class="flex-shrink-0">
                <svg class="h-5 w-5 text-blue-400" fill="currentColor" viewBox="0 0 20 20">
                  <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"></path>
                </svg>
              </div>
              <div class="ml-3">
                <p class="text-sm text-blue-700">
                  <span class="font-medium">Fonctionnalité à venir</span><br>
                  La gestion des images de services sera bientôt disponible.
                </p>
              </div>
            </div>
          </div>
        </div>
      </div>
  
      <Footer />
    </div>
  </template>
  
  <script setup>
  import { Link } from '@inertiajs/vue3';
  import TopNav from '@/Components/TopNav.vue';
  import Footer from '@/Components/Footer.vue';
  </script>
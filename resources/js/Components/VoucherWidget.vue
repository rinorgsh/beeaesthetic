<template>
  <!-- Mode bouton flottant (fixe sur le site) -->
  <div
    v-if="mode === 'button'"
    class="salonized-voucher"
    data-company="pTcZuo7p2qn8CMbyazim1obt"
    data-color="#3d2419"
    :data-language="currentLanguage"
    data-position="right"
  ></div>

  <!-- Mode inline (intégré dans la page) -->
  <div
    v-else
    class="salonized-voucher"
    data-company="pTcZuo7p2qn8CMbyazim1obt"
    data-color="#3d2419"
    :data-language="currentLanguage"
    data-height="700"
    data-inline="true"
  ></div>
</template>

<script setup>
import { onMounted } from 'vue';
import { useTranslation } from '@/composables/useTranslation';

defineProps({
  // 'inline' = widget intégré dans la page ; 'button' = bouton flottant fixe
  mode: {
    type: String,
    default: 'inline',
  },
});

const { currentLanguage } = useTranslation();

onMounted(() => {
  // Charge le loader Salonized une seule fois (partagé avec le widget de réservation)
  if (!document.getElementById('salonized-loader')) {
    const script = document.createElement('script');
    script.src = 'https://static-widget.salonized.com/loader.js';
    script.async = true;
    script.id = 'salonized-loader';
    document.body.appendChild(script);
  }
});
</script>

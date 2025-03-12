<template>
  <div>
    <!-- Code du widget Salonized -->
    <div class="salonized-booking"
         data-company="pTcZuo7p2qn8CMbyazim1obt"
         data-color="#FF6575"
         data-language="en"
         data-height="700"
         data-inline="true"
         data-outline="shadow">
    </div>
  </div>
</template>

<script>
export default {
  name: "BookingWidget",
  mounted() {
    // Vérifier si le script n'est pas déjà chargé
    if (!document.getElementById('salonized-loader')) {
      const script = document.createElement('script');
      script.src = "https://static-widget.salonized.com/loader.js";
      script.async = true;
      script.id = 'salonized-loader';
      document.body.appendChild(script);
    }
  }
}
</script>

<style scoped>
/* Ajoutez ici vos styles si nécessaire */
</style>

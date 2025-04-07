<script setup lang="ts">
import Navbar from './components/Navbar.vue';
import SearchView from './views/SearchView.vue';
import { RouterView } from 'vue-router';


</script>

<template>
  <Navbar />
  <div id="container">
        <div style="width: 100%; max-width: 1200px; padding: 3em 0em;">
          <RouterView/>
        </div>
    </div>
    
</template>

<style lang="scss">
</style>

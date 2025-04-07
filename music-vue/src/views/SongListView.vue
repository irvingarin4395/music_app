<script setup lang="ts">
import { reactive, onMounted } from 'vue';
import PulseLoader from 'vue-spinner/src/PulseLoader.vue';
import { useRoute } from 'vue-router';
import axios from 'axios';
import SongList from '../components/SongList.vue';

const route = useRoute();
const slug = route.params.slug;
const id = route.params.id;

const state = reactive({
    songs: [],
    isLoading: true
});

onMounted(async () => {
    try {
        const response = await axios.get(`http://127.0.0.1:8000/api/${slug}/${id}/song`);
        state.songs = response.data;
    } catch (error) {
        console.error('Error Fetching Songs', error);
    } finally {
        state.isLoading = false;
    }
});
</script>

<template>
    <div v-if="state.isLoading">
        <PulseLoader />
    </div>
    <SongList v-else :songs="state.songs"/>
</template>
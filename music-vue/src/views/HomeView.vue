<script setup lang="ts">
import { reactive, onMounted } from 'vue';
import AlbumList from '../components/AlbumList.vue';
import PulseLoader from 'vue-spinner/src/PulseLoader.vue';
import axios from 'axios';

const state = reactive({
    pageUrl: 'http://127.0.0.1:8000/api/album',
    albums: [],
    isLoading: true
});


const getAlbum = async (pageUrl) => {
    state.isLoading = true;
    const url = pageUrl ? pageUrl : state.pageUrl;
    try {
        const response = await axios.get(url);
        state.albums = response.data;
    } catch (error) {
        console.error('Error Fetching Album', error);
    } finally {
        state.isLoading = false;
    }
}

onMounted(getAlbum);
</script>

<template>
    <div v-if="state.isLoading">
        <PulseLoader />
    </div>
    <AlbumList @getAlbum="getAlbum" v-else :albums="state.albums" />
</template>
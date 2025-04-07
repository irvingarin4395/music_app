<script setup lang="ts">
import { reactive, onMounted } from 'vue';
import AlbumList from '../components/AlbumList.vue';
import PulseLoader from 'vue-spinner/src/PulseLoader.vue';
import axios from 'axios';
import { useRoute } from 'vue-router';


const route = useRoute();
const keyword = route.params.keyword;

console.log(keyword);
const state = reactive({
    pageUrl: 'http://127.0.0.1:8000/api/album/search?search=' + keyword,
    albums: [],
    isLoading: true
});
console.log(keyword)
const getAlbum = async (pageUrl) => {
    state.isLoading = true;
    const url = pageUrl ? pageUrl + '&search=' + keyword : state.pageUrl;
    console.log(pageUrl);
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
    <AlbumList @getAlbum="getAlbum"  :albums="state.albums" />
</template>
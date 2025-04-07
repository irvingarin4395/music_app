<script setup lang="ts">
import { reactive, onMounted } from 'vue';
import artistLogo from '/user-svg.svg';
import PulseLoader from 'vue-spinner/src/PulseLoader.vue';
import rightArrow from '/arrow-right.svg';
import leftArrow from '/arrow-left.svg';
import axios from 'axios';

const state = reactive({
    pageUrl: 'http://127.0.0.1:8000/api/artist/',
    artists: [],
    isLoading: true
});

const getArtists = async (pageUrl) => {
    const url = pageUrl ? pageUrl : state.pageUrl;
    try {
        const response = await axios.get(url);
        state.artists = response.data;
        
    } catch (error) {
        console.error('Error Fetching Artists', error);
    } finally {
        state.isLoading = false;
    }
}

onMounted(getArtists);
</script>

<template>
    <div id="artist-list">
        <div id="artist-list-border">
            <table id="artist-list-table">
                <thead>
                    <tr>
                        <th colspan="2"><h2>Artists</h2></th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-if="state.isLoading">
                        <td style="justify-content: center;"><PulseLoader /></td>
                    </tr>
                    <tr v-else v-for="artist in state.artists.data" :key="artist.id">
                        <td><img class="white-svg" :src="artistLogo" alt="" /></td>
                        <td><a href="#">{{ artist.name }}</a></td>
                    </tr>
                </tbody>
            </table>
            <div id="artist-pagination">
                <div v-for=" link in state.artists.links">
                    <a v-if="link.url" :key="link.label" @click="getArtists(link.url)">
                        <img v-if="link.label.includes('Next')" :src="rightArrow" class="white-svg">
                        <img v-else-if="link.label.includes('Previous')" :src="leftArrow" class="white-svg">
                        <p v-else :style="link.active ? 'transform: scale(1.5);': ''">{{ link.label }}</p>
                    </a>
                </div>
            </div>
        </div>
    </div>
</template>

<style lang="scss">
#artist-list {
    display: flex;
    justify-content: center;
    width: 100%;
    padding: 1em;
    #artist-list-border{
        border: #ffffff 1px solid;
        border-radius: 25px;
        max-width: 50em;
        width: 100%;
        padding: 1em;
    }
    @media screen and (max-width: 996px) {
        #artist-list-border{
            border: unset;
        }
        padding: 0em;
    }
}
#artist-list-table {
    width: 100%;
    color: #ffffff;
    border-collapse: collapse;
    tr {
        border-bottom: #ffffff 1px solid;
    }
    a{
        display: flex;
        padding: .5em;
        width: 100%;
        color: #ffffff;
        letter-spacing: 1px;
    }
    img {
        border: #ffffff 1px solid;
        border-radius: 20px;
        height: 2em;
        aspect-ratio: 1;
    }
}
#artist-pagination {
    display: flex;
    flex-direction: row;
    align-items: center;
    justify-content: space-between;
    padding: 1em;
    width: 100%;
    a{
        color: #ffffff;
        img {
            max-width: 50px;
        }
    }
}
</style>
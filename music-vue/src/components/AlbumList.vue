<script setup lang="ts">
import { reactive } from 'vue';
import AlbumCard from './AlbumCard.vue';
import rightArrow from '/arrow-right.svg';
import leftArrow from '/arrow-left.svg';
import axios from 'axios';
import { useUserStore } from '../stores/UserStore';

const userStore = useUserStore();

const props = defineProps<{
    albums: Object
}>();

const deleteAlbum = async (albumId, albumIndex) => {
    try {
        const response = await axios.get(`http://127.0.0.1:8000/api/album/${albumId}/delete`, {
            headers: {
                Authorization: 'Bearer ' + userStore.token
            }
        });
        props.albums.data.splice(albumIndex, 1);
    } catch (error) {
        console.error(error);
    }
}
</script>

<template>
    <div v-if="albums.total != 0" id="album-list">
        <AlbumCard @deleteAlbum="deleteAlbum" v-for="(album, index) in albums.data" :key="album.id" :albumIndex="index" :album="album"/>
    </div>
    <div v-else style="color: #ffffff;font-size: 6em; border: #ffffff 1px solid; border-radius: 25px;">No Result</div>
    <div v-if="albums.last_page != 1" id="album-pagination">
        <div v-for="link in albums.links">
            <a v-if="link.url" :key="link.label" @click="$emit('getAlbum',link.url)">
                <img v-if="link.label.includes('Next')" :src="rightArrow" class="white-svg">
                <img v-else-if="link.label.includes('Previous')" :src="leftArrow" class="white-svg">
                <p v-else :style="link.active ? 'transform: scale(1.5);': ''">{{ link.label }}</p>
            </a>
            <a v-else-if="link.label.includes('...')" style="position: unset;">
                . . .
            </a>
        </div>
    </div>
</template>

<style lang="scss">
#album-list {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
    grid-template-rows: auto;
    grid-gap: 2em;
    justify-items: center;
}
#album-pagination {
    margin-top: 1em;
    display: flex;
    justify-content: center;
    align-items: center;
    width: 100%;
    div{
        display: flex;
        justify-content: center;
        width: 100%;
        a {
            cursor: pointer;
            color: #ffffff;
        }
        img {
            max-width: 50px;
        }
        .active {
            color: #ffffff;
        }
    }
}
</style>
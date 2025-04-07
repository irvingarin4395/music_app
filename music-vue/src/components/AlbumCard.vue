<script setup lang="ts">
import logo from '/music-notes.svg';
import dislike from '/dislike-svg.svg';
import like from '/like-svg.svg';
import closeCircle from '/close-circle.svg';
import { RouterLink } from 'vue-router';
import { reactive } from 'vue';
import axios from 'axios';
import { useUserStore } from '../stores/UserStore';
import { useToast } from 'vue-toastification';

const props = defineProps<{
    album: Object,
    albumIndex: String,
}>();

const userStore = useUserStore();

const vote = reactive({
    album_id: null,
    vote_type: null
});

const toast = useToast();

const voteAlbum = async (album_id, vote_type) => {
    vote.album_id = album_id;
    vote.vote_type = vote_type;
    try {
        const response = await axios.post(`http://127.0.0.1:8000/api/vote`, vote, {
            headers: {
                Authorization: 'Bearer ' + userStore.token
            }
        });
        props.album.like = props.album.like + response.data.like;
        props.album.dislike = props.album.dislike + response.data.dislike;
        toast.success('Thank you for voting!');
    } catch (error) {
        toast.error('Please Login : ' + error.message)
        console.error(error);
    }
}

</script>

<template>
    <div id="album-card-container" style="position: relative;">
        <div v-if="userStore.user" style="position: absolute; right: 1em; top: 1em; cursor: pointer;">
            <a v-if="userStore.user.role == 'admin'" @click="$emit('deleteAlbum', album.id, albumIndex)"><img :src="closeCircle" class="white-svg" style="height: 25px;"></a>
        </div>
        <RouterLink :to="`/album/${album.id}/songs`" style="color: #ffffff;">
            <div id="album-card-logo">
                <img :src="logo" alt="" class="white-svg">
            </div>
        </RouterLink>
        <div id="album-card-text">
            <div style="margin: 1em 0em;">
                <RouterLink :to="`/album/${album.id}/songs`" style="color: #ffffff;">
                    <div style="border-bottom: #fff 1px solid;">{{ album.title }}</div>
                    <div style="color: #ddd;">Album</div>
                </RouterLink>
            </div>
            <div style="margin: 1em 0em;">
                <RouterLink :to="`/artist/${album.artist_id}/songs`" style="color: #ffffff;">
                    <div style="border-bottom: #fff 1px solid;">{{ album.artist.name }}</div>
                    <div style="color: #ddd;">Artist</div>
                </RouterLink>
            </div>
        </div>
        <div id="album-card-votes">
            <button class="btn-vote" @click="voteAlbum(album.id,1)">
                <img :src="like" alt="" class="white-svg" style="width: 25px; aspect-ratio: 1;">
                <div>{{ album.like }}</div>
            </button>
            <button class="btn-vote" @click="voteAlbum(album.id,-1)">
                <img :src="dislike" alt="" class="white-svg" style="width: 25px; aspect-ratio: 1;">
                <div>{{ album.dislike }}</div>
            </button>
        </div>
    </div>
</template>

<style lang="scss">
#album-card-container {
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: space-between;
    border: #fff 1px solid;
    border-radius: 25px;
    padding: 1.5em;
    width: 16em;
    height: auto;
}

#album-card-logo {
    border: #fff 1px solid;
    border-radius: 100%;
    padding: 2em;
    img {
        height: 4em;
        width: 4em;
    }
}

#album-card-text {
    color: #fff;
    width: 100%;
    
}

#album-card-votes {
    display: flex;
    flex-direction: row;
    align-items: center;
    border: #fff 1px solid;
    border-radius: 25px;
    width: 100%;
    padding: .5em;
    color: #fff;
}

.btn-vote {
    display: flex;
    align-items: center;
    flex-direction: row;
    justify-content: center;
    width: 50%;
    gap: 1em;
    color: #ffffff;
    background-color: unset;
    border: unset;
    outline: unset !important;
    :hover{
        transform: scale(1.2);
        transition-duration: 0.2s;
    }
}
</style>
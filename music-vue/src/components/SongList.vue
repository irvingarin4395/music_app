<script setup lang="ts">
import playLogo from '/play-circle-svg.svg'

defineProps<{
    songs: Object
}>();
</script>

<template>
    <div id="song-list">
        <div id="song-list-border">
            <table id="song-list-table">
                <thead>
                    <tr>
                        <th colspan="3"><h2>Songs</h2></th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="song in songs" :key="song.id">
                        <td><img class="white-svg" :src="playLogo" alt="" /></td>
                        <td><a href="#">{{ song.title }}</a></td>
                        <td>{{ new Date(song.duration * 1000).toISOString().substring(14, 19) }}</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</template>

<style lang="scss">
#song-list {
    display: flex;
    justify-content: center;
    width: 100%;
    #song-list-border {
        border: #ffffff 1px solid;
        border-radius: 25px;
        max-width: 50em;
        width: 100%;
        @media screen and (max-width: 768px) {
            border: unset;
        }
    }
}
#song-list-table {
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
        @media screen and (max-width: 768px) {
            padding: 1em;
        }
    }
    img {
        border: #ffffff 1px solid;
        border-radius: 20px;
        height: 2em;
        aspect-ratio: 1;
    }
}
</style>
<script setup lang="ts">
import { reactive } from 'vue';
import { RouterLink, useRouter } from 'vue-router';
import logo from '/music-notes.svg';
import search from '/search-svg.svg';
import hamburger from '/hamburger-menu.svg';
import { useUserStore } from '../stores/UserStore';

const router = useRouter();

const state = reactive({
    mobileMenu: false,
    searchKeyword: ''
});

const userStore = useUserStore();

const showMobileMenu = () => {
    state.mobileMenu = !state.mobileMenu;
}

const searchQuery = () => {
    router.push('/search/'+state.searchKeyword);
}

</script>

<template>
    <nav>
        <div id="nav-container">
            <div id="nav-left">
                <RouterLink to="/">
                    <div id="nav-logo"><img :src="logo" alt=""></div>
                    <div id="nav-app-name">MUSIC APP</div>
                </RouterLink>
            </div>
            <div id="nav-center">
                <form @submit.prevent="searchQuery">
                    <div><input type="text" placeholder="Search" name="search_query" v-model="state.searchKeyword"><img :src="search" alt="" srcset=""></div>
                </form>
            </div>
            <div id="nav-right">
                <RouterLink to="/artists" id="nav-item">ARTIST</RouterLink>
                <div v-if="!userStore.user">
                    <RouterLink to="/register" id="nav-item">REGISTER</RouterLink>
                    <RouterLink to="/login" id="nav-item">LOGIN</RouterLink>
                </div>
                <div v-else>
                    <a href="#" v-on:click="userStore.logoutUser()" id="nav-item">LOGOUT</a>
                </div>
            </div>
            <div id="nav-right-mobile">
                <a href="#" v-on:click="showMobileMenu">
                    <img :src="hamburger" alt="">
                </a>
                <div id="nav-right-mobile-menu" v-if="state.mobileMenu">
                    <div id="nav-right-mobile-menu-search">
                        <div>
                            <input type="text" placeholder="Search" name="search_query" v-model="state.searchKeyword">
                        </div>
                    </div>
                    <RouterLink to="/artists" id="nav-item">ARTIST</RouterLink>
                    <RouterLink to="/register" id="nav-item">REGISTER</RouterLink>
                    <RouterLink to="/login" id="nav-item">LOGIN</RouterLink>
                </div>
            </div>
        </div>
    </nav>
</template>

<style lang="scss">
$main-color: #4f024a;
#nav-left{
    a {
        display: flex;
        flex-direction: row;
        align-items: center;
        gap: 1em;
        #nav-app-name {
            font-size: 1.5em;
            color: $main-color;
            font-weight: 700;
        }
    }
}


#nav-logo {
    img {
        width: 50px;
        height: 50px;
    }
}

#nav-center{
    div {
        min-width: 2em;
        width: 20em;
        display: flex;
        align-items: center;
        border: #dddddd 1px solid;
        border-radius: 20px;
        padding: .5em 1em;
        input {
            width: 90%;
            outline: none;
            border: none;
            font-size: 1em;
            :focus-visible {
                outline: none;
            }
        }
        img {
            width: 10%;
            max-height: 1em;
        }
    }
}

#nav-right {
    display: flex;
    flex-direction: row;
    font-size: 1.1em;
    gap: 1em;
    div {
        text-transform: uppercase;
        display: flex;
        gap: inherit;
    }
    a {
        color: $main-color;
        font-weight: 600;
    }
    a:hover {
        color: #8d0084;
    }
}

#nav-right-mobile {
    display: none;
    img {
        width: 50px;
        height: 50px;
    }

    #nav-right-mobile-menu {
        display: flex;
        flex-direction: column;
        position: fixed;
        top: 75px;
        left: 0;
        width: 100%;
        a {
            border-top: $main-color 1px solid;
            color: $main-color;
            padding: 1em;
            background-color: #ffffff;
        }
    }
}

#nav-right-mobile-menu-search {
    display: flex;
    justify-content: center;
    align-items: center;
    background-color: #ffffff;
    padding: 1em;
    border-top: $main-color 1px solid;
    div {
        display: flex;
        border: #999999 1px solid;
        border-radius: 30px;
        width: 100%;
        padding: .5em;
        max-width: 500px;
        input {
            border: none;
            width: 100%;
            
        }
        input:focus-visible {
            outline: none;
        }
    }
}

@media screen and (max-width: 996px) {
    #nav-right {
        font-size: 1em;
    }

    #nav-center{
        div {
            width: 14em;
        }
    }
    #nav-left {
        a{
            #nav-app-name{
                font-size: 1.2em;
            }
        }
    }
}

@media screen and (max-width: 768px) {
    #nav-app-name, #nav-right, #nav-center {         
        display: none !important;
    }
    #nav-right-mobile {
        display: flex;
    }
    #nav-center{
        div {
            width: 16em;
        }
    }
}
</style>
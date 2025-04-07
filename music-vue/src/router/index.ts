import { createRouter, createWebHistory } from 'vue-router';
import HomeView from '../views/HomeView.vue';
import SearchView from '../views/SearchView.vue';
import LoginView from '../views/LoginView.vue';
import RegisterView from '../views/RegisterView.vue';
import ArtistListView from '../views/ArtistListView.vue';
import SongListView from '../views/SongListView.vue';
import NotFoundView from '../views/NotFoundView.vue';

const router = createRouter({
  history: createWebHistory(import.meta.env.BASE_URL),
  routes: [
    {
      path: '/',
      name: 'home',
      component: HomeView,
    },
    {
      path: '/search/:keyword',
      name: 'search',
      component: SearchView,
    },
    {
      path: '/artists',
      name: 'artists',
      component: ArtistListView,
    },
    {
      path: '/:slug/:id/songs',
      name: 'songs',
      component: SongListView,
    },
    {
      path: '/login',
      name: 'login',
      component: LoginView,
    },
    {
      path: '/register',
      name: 'register',
      component: RegisterView,
    },
    {
      path: '/:catchAll(.*)',
      name: 'not-found',
      component: NotFoundView
    }
  ],
})

export default router

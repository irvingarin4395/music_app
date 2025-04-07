import { createApp, watch } from 'vue';
import { createPinia } from 'pinia';
import './style.scss';
import App from './App.vue';
import router from './router/index.ts';
import Toast from 'vue-toastification';
import 'vue-toastification/dist/index.css'


const app = createApp(App);
app.use(router);
const pinia = createPinia();
app.use(pinia);
app.use(Toast);
app.mount('#app');

watch(
  pinia.state,
  (state) => {
    sessionStorage.setItem("userInfo", JSON.stringify(state.userStore.authUser));
    sessionStorage.setItem("tokenInfo", state.userStore.authToken);
  },
  { deep: true }
  );
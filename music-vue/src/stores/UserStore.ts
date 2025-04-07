import { defineStore } from "pinia";
import axios from "axios";
import { useToast } from "vue-toastification";

const toast = useToast();

export const useUserStore = defineStore('userStore', {
    state: () => ({
        authToken: sessionStorage.getItem('tokenInfo') ? sessionStorage.getItem('tokenInfo') : null,
        authUser: sessionStorage.getItem('userInfo') ? JSON.parse( sessionStorage.getItem('userInfo') ) : null
    }),
    getters: {
        token: (state) => state.authToken,
        user: (state) => state.authUser
    },
    actions: {
        async loginUser (data) {
            try {
                const response = await axios.post(`http://127.0.0.1:8000/api/auth/login`, data);
                this.authUser = response.data.user;
                this.authToken = response.data.token;
            } catch (error) {
                console.error("Error Logging in: ", error);
            }
        },
        async registerUser(data) {
            try {
                const response = await axios.post(`http://127.0.0.1:8000/api/auth/register`, data);
                this.authUser = response.data.user;
                this.authToken = response.data.token;
            } catch (error) {
                console.error('Cannot create user:', error);
            }
        },
        async logoutUser() {
            try {
                await axios.post('http://127.0.0.1:8000/api/auth/logout', [], {
                    headers: {
                        Authorization: 'Bearer ' + this.authToken
                    }
                });
                this.authUser = null;
                this.authToken = null;
                toast.success('You are logged out!');
            } catch (error) {
                console.error('Error logging out', error)
            }
        }
    }
});
<script setup lang="ts">
import { reactive } from 'vue';
import { RouterLink, useRouter } from 'vue-router';
import { useUserStore } from '../stores/UserStore';
import { useToast } from 'vue-toastification';

const userStore = useUserStore();

const router = useRouter();

const form = reactive({
    email: '',
    password: '',
});

const toast = useToast();

const loginUser = () => {
    userStore.loginUser(form);
    toast.success('Welcome!');
    router.push('/');
    
} 


</script>

<template>
    <div style="display: flex; justify-content: center; width: 100%;">
        <form id="login-form" @submit.prevent="loginUser">
            <h1>Login</h1>
            <div id="login-container">
                <label for="email">Email: </label>
                <div>
                    <input v-model="form.email" type="email" name="email" placeholder="Email">
                </div>
                <label for="password">Password: </label>
                <div>
                    <input v-model="form.password" type="password" name="password" placeholder="Password">
                </div>
                <button type="submit" id="submit-button">Login</button>
                <div style="justify-content: flex-end;">
                    <RouterLink to="/register">Create an account.</RouterLink>
                </div>>
            </div>
        </form>
    </div>
</template>

<style lang="scss">
$form-padding: .5em;
#submit-button {
    color: #ffffff;
    background-color: unset;
    border: #ffffff 1px solid;
}

#login-form {
    display: flex;
    flex-direction: column;
    border: #ffffff 1px solid;
    border-radius: 25px;
    padding: 3em 3em;
    width: 100%;
    max-width: 25em;
    h1 {
        color: #ffffff;
    }
    
}

#login-container {
    display: flex;
    flex-direction: column;
    align-items: flex-start;
    gap: 1em;
    width: 100%;
    label {
    color: #ffffff;
    }
    input {
        border: #ffffff 1px solid;
        border-radius: 10px;
        padding: $form-padding;
        width: 100%;
        color: #4f024a;
        font-size: large;
        
    }
    input::placeholder {
        color: #4f024a;
    }
    input:focus-visible {
        outline: none;
    }
    a {
        color: #ffffff;
        text-decoration: underline;
    }
    a:hover {
        color: #dddddd;
    }
    button {
        width: 100%;
        margin: 1em 0px;
    }
    div {
        display: flex;
        width: 100%;
    }
}

@media screen and (max-width: 480px) {
    #login-form {
        border: unset;
    }
}
</style>
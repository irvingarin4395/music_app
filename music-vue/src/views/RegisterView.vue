<script setup lang="ts">
import { reactive } from 'vue';
import { RouterLink, useRouter } from 'vue-router';
import { useUserStore } from '../stores/UserStore';

const userStore = useUserStore();
const router = useRouter();

const form = reactive({
    email: '',
    name: '',
    role: '',
    password: '',
    password_confirmation: ''
});

const registerUser = () => {
    userStore.registerUser(form);
    router.push('/');
}
</script>

<template>
    <div style="display: flex; justify-content: center; width: 100%;">
        <form id="register-form" @submit.prevent="registerUser">
            <h1>Register</h1>
            <div id="register-container">
                <div class="form-row">
                    <div class="form-col" style="width: 100%;">
                        <label for="name">Name: </label>
                        <div class="form-input">
                            <input v-model="form.name" type="text" name="name" placeholder="Name">
                        </div>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-col">
                        <label for="email">Email: </label>
                        <div class="form-input">
                            <input v-model="form.email" type="email" name="email" placeholder="Email">
                        </div>
                        <label for="password">Password: </label>
                        <div class="form-input">
                            <input v-model="form.password" type="password" name="password" placeholder="Password">
                        </div>
                    </div>
                    <div class="form-col">
                        <label for="name">Role: </label>
                        <div class="form-input">
                            <select v-model="form.role" type="text" name="name" placeholder="Name">
                                <option value="" hidden selected disabled>Select Role</option>
                                <option value="user">User</option>
                                <option value="admin">Admin</option>
                            </select>
                        </div>
                        <label for="password_confirmation">Confirm Password: </label>
                        <div class="form-input">
                            <input v-model="form.password_confirmation" type="password" name="password_confirmation" placeholder="Confirm Password">
                        </div>
                    </div>
                </div>
                <button type="submit" id="submit-button">Register</button>
                <div class="form-row" style="justify-content: flex-end;">
                    <RouterLink to="/login">Already registered?</RouterLink>
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

#register-form {
    display: flex;
    flex-direction: column;
    border: #ffffff 1px solid;
    border-radius: 25px;
    padding: 3em 3em;
    width: 100%;
    max-width: 45em;
    h1 {
        color: #ffffff;
    }
    
}

#register-container {
    display: flex;
    flex-direction: column;
    align-items: flex-start;
    gap: 1em;
    width: 100%;
    label {
    color: #ffffff;
    }
    input, select {
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
    .form-input {
        display: flex;
        width: 100%;
    }
    .form-row {
        display: flex;
        flex-direction: row;
        width: 100%;
        gap: 2em;
    }
    .form-col {
        display: flex;
        flex-direction: column;
        align-items: flex-start;
        width: 50%;
        gap: 1em;
    }
}

@media screen and (max-width: 480px) {
    #register-form {
        border: unset;
    }
    #register-container {
        .form-row {
            flex-direction: column;
            gap: 1em;
        }
        .form-col {
            width: 100%;
        }
    }
}
</style>
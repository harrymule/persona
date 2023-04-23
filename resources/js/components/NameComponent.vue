<template>
    <div class=" py-2 px-4 rounded-md">
        <form @submit.prevent="submitForm" class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
            <h2 class="text-xl font-semibold mb-4">Update User Details</h2>
            <hr class="mb-4">
            <div class="mb-4">
                <label for="name" class="block text-gray-700 font-bold mb-2">Name:</label>
                <input type="text" id="name" v-model="name"
                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline focus:outline-none focus:ring-2 focus:ring-blue-100"
                    required>
            </div>
            <div class="mb-4">
                <label for="email" class="block text-gray-700 font-bold mb-2">Email:</label>
                <input type="email" id="email" v-model="email"
                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline focus:outline-none focus:ring-2 focus:ring-blue-100"
                    required>
            </div>
            <button type="submit"
                class="bg-blue-500 hover:bg-blue-900 text-white font-bold py-2 px-4 rounded mb-4 mt-2">
                Update
            </button>
            <button type="button"
                class="bg-blue-500 hover:bg-blue-900 text-white font-bold py-2 px-4 rounded ml-5 mb-4 mt-2"
                @click="closeComponent">
                Close
            </button>
        </form>
    </div>
</template>
<script>
import axios from 'axios';
import { eventBus } from './../eventBus.js';
export default {
    name: 'nameComponent',
    props: {
        user: {
            type: Object,
            required: true
        },
    },
    data() {
        return {
            loading: false,
            showingNameModal: false,
            name: this.user ? this.user.name : "",
            email: this.user ? this.user.email : "",
            updated: false,
        };
    },
    computed: {
        updated() {
            return true;
        }
    },
    methods: {
        submitForm() {
            // Send AJAX request to server to update name
            this.loading = true;
            axios.post('/profile/' + this.user.id, {
                name: this.name,
                email: this.email,
            }).then(response => {
                // Handle successful response from server
                this.$emit('close');
                if (response.data.user.email !== this.user.email) {
                    // Email has been updated
                    this.user.name = response.data.user.name;
                    this.user.email = response.data.user.email;
                    eventBus.emit('formSubmitted', 'Success!');
                    console.log('harry');

                    // Logout user
                    axios.post('/logout').then(() => {
                        // Reload the page after logout
                        window.location.href = '/login';
                    });
                } else {
                    // Only name has been updated
                    this.user.name = response.data.user.name;
                    this.user.email = response.data.user.email;
                    eventBus.emit('formSubmitted', 'Success!');
                    console.log('harry');
                }
                setTimeout(() => {
                    this.loading = false;
                    this.updated = false;
                }, 1000);
                console.log('mule');
            }).catch(error => {
                // Handle error response from server
                console.log(error.response);
                eventBus.emit('formSubmitted', 'Error!');
            });
        },
        closeComponent() {
            this.$emit("close");
        }
    },
};
</script>

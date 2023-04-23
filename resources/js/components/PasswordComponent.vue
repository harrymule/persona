<template>
    <div class="max-w-md mx-auto mt-8 border-t">
        <div v-if="errors" class="text-red-500 text-sm font-bold mb-4 alert ml-16 mt-8">
            <ul>
                <li v-for="(error, key) in errors" :key="key">{{ error }}</li>
            </ul>
        </div>
        <div v-if="successMessage" class="text-green-500 text-sm font-bold mb-4 alert ml-16 mt-8">
            {{ successMessage }}
        </div>
        <form class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4" @submit.prevent="submitForm">
            <h2 class="text-xl font-semibold mb-4">Change Password</h2>
            <hr>
            <div class="mb-4 mt-4 ">
                <label class="block text-gray-700 font-bold mb-2" for="currentPassword">
                    Current Password
                </label>
                <input
                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline focus:outline-none focus:ring-2 focus:ring-blue-100"
                    id="currentPassword" type="password" v-model.trim="currentPassword"
                    :class="{ 'border-red-500': errors.currentPassword }" required>
                <p v-if="errors.currentPassword" class="text-red-500 text-xs italic">{{ errors.currentPassword }}</p>
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 font-bold mb-2" for="newPassword">
                    New Password
                </label>
                <input
                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline focus:outline-none focus:ring-2 focus:ring-blue-100"
                    id="newPassword" type="password" v-model.trim="newPassword"
                    :class="{ 'border-red-500': errors.newPassword }" required>
                <p v-if="errors.newPassword" class="text-red-500 text-xs italic">{{ errors.newPassword }}</p>
            </div>

            <div class="mb-6">
                <label class="block text-gray-700 font-bold mb-2" for="confirmPassword">
                    Confirm Password
                </label>
                <input
                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline focus:outline-none focus:ring-2 focus:ring-blue-100"
                    id="confirmPassword" type="password" v-model.trim="confirmPassword"
                    :class="{ 'border-red-500': errors.confirmPassword }" required>
                <p v-if="errors.confirmPassword" class="text-red-500 text-xs italic">{{ errors.confirmPassword }}</p>
            </div>

            <div class="flex items-center justify-between">
                <button
                    class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline"
                    type="submit">
                    Update Password
                </button>
                <button type="button"
                    class="bg-blue-500 hover:bg-blue-900 text-white font-bold py-2 px-4 rounded ml-5 mb-4 mt-2"
                    @click="closeComponent">
                    Close
                </button>
            </div>
        </form>
    </div>
</template>

<script>
import axios from 'axios';
import { eventBus } from './../eventBus.js';
export default {
    name: 'passwordComponent',
    props: {
        user: {
            type: Object,
            required: true
        },
    },
    data() {
        return {
            currentPassword: '',
            newPassword: '',
            confirmPassword: '',
            errors: {},
            successMessage: '',
            passwordStatusMessage: ''
        };
    },

    methods: {
        submitForm() {
            // Clear any existing errors
            this.errors = {};
            // console.log('current Password ' + this.currentPassword)
            // console.log('new Password ' + this.newPassword)
            // console.log('confirm Password ' + this.confirmPassword)
            // Validate the form data
            if (!this.currentPassword) {
                this.errors.currentPassword = 'Please enter your current password';
            }

            if (!this.newPassword) {
                this.errors.newPassword = 'Please enter a new password';
            } else if (this.newPassword.length < 6) {
                this.errors.newPassword = 'Password must be at least 8 characters';
            }

            if (!this.confirmPassword) {
                this.errors.confirmPassword = 'Please confirm your new password';
            } else if (this.newPassword !== this.confirmPassword) {
                this.errors.confirmPassword = 'New password and confirmation password do not match';
            }
            // If there are any errors, do not submit the form
            if (Object.keys(this.errors).length > 0) {
                return;
            }

            // If there are no errors, submit the form
            axios.post('/updatepassword/' + this.user.id, {
                currentPassword: this.currentPassword,
                newPassword: this.newPassword,
            })
                .then((response) => {
                    if (response.status === 200) {
                        // Password updated successfully, show a success message to the user
                        // alert('Password updated successfully');
                        // console.log(response.data.message)
                        this.successMessage = response.data.message
                        setTimeout(() => {
                            this.errors = {};
                            axios.post('/logout').then(() => {
                                // Reload the page after logout
                                location.reload();
                            }, 3000).catch((error) => {
                                console.error(error);
                            });
                        });
                    } else {
                        // console.log(response.data.error)
                        this.errors = response.data.error
                        setTimeout(() => {
                            this.errors = {};
                        }, 3000);
                    }
                })
                .catch((error) => {
                    this.errors = error.response.data
                    setTimeout(() => {
                        this.errors = {};
                    }, 3000);
                    // console.log(error.response.data)
                });
        },
        closeComponent() {
            this.$emit("close");
        }
    },
};
</script>


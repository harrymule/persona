<template>
    <div class="max-w-4xl flex items-center h-auto lg:h-screen flex-wrap mx-auto my-32 lg:my-0">
        <!--Main Col-->
        <div id="profile"
            class="w-full lg:w-3/5 rounded-lg lg:rounded-l-lg lg:rounded-r-none shadow-2xl bg-white opacity-75 mx-6 lg:mx-0"
            :class="profileObject">
            <div v-if="statusMessage" class="text-green-500 text-sm font-bold mb-4 alert ml-16 mt-8"
                :class="{ 'text-success': isSuccess, 'text-fail': !isSuccess }">{{ statusMessage }}</div>
            <div v-if="loading">Loading...</div>
            <div class="p-4 md:p-12 text-center lg:text-left" v-else>
                <!-- Image for mobile view-->
                <h1 class="text-3xl font-bold pt-8 lg:pt-0"> {{ user.name }} </h1>
                <div class="mx-auto lg:mx-0 w-4/5 pt-3 border-b-2 border-blue-500 opacity-25"></div>
                <p class="pt-4 text-base font-bold flex items-center justify-center lg:justify-start">
                    <font-awesome-icon icon="fa-regular fa-envelope" /> &nbsp;
                    {{ user.email }}
                </p>
                <p class="pt-2 text-gray-600 text-xs lg:text-sm flex items-center justify-center lg:justify-start">

                    Created At : &nbsp<i class="text-bold"> {{ formattedDate }} </i>
                </p>
                <p class="pt-8 text-sm">
                    Welcome to my profile! I'm excited to share a little bit about myself with you.
                </p>

                <div class="pt-12 pb-8">
                    <button @click="showNameComponent = true; adjustHeight(); showPasswordComponent = false;"
                        class="bg-blue-500 hover:bg-blue-900 text-white font-bold py-2 px-4 rounded"
                        id="updateDetails">
                        Update Details
                    </button>
                    <button @click="showPasswordComponent = true; adjustHeight(); showNameComponent = false;" class="bg-blue-500 hover:bg-blue-900 text-white font-bold py-2 px-4 rounded ml-10">
                        Change Password
                    </button>
                </div>

                <!-- <ShowingDetails ref="showingDetails" :user="user" /> -->
                <div v-if=" showNameComponent ">
                    <NameComponent ref="nameComponent" :user=" user " @close=" closeNameComponent " />
                </div>

                <div v-if=" showPasswordComponent ">
                    <PasswordComponent ref="passwordComponent" :user=" user " @close="closePasswordComponent " />
                </div>


                <div class="mt-6 pb-16 lg:pb-0 w-4/5 lg:w-full mx-auto flex flex-wrap items-center">
                    <a class="link" href="#" data-tippy-content="@facebook_handle" style="color: rgb(56, 85, 150) ;">
                        <font-awesome-icon icon="fa-brands fa-facebook-f" size="2xl" /> &nbsp;
                    </a>
                    <a class="link ml-8" href="#" data-tippy-content="@twitter_handle" style="color: rgb(3, 164, 236)">
                        <font-awesome-icon icon="fa-brands fa-twitter-square" size="2xl" /> &nbsp;
                    </a>
                </div>
            </div>
        </div>

        <!--Img Col-->
        <div class="w-full lg:w-2/5">

            <img :src=" getImageUrl() + 'profile.jpg' " alt="My Image"
                class="rounded-none lg:rounded-lg shadow-2xl hidden lg:block">
        </div>


    </div>
</template>

<script>
import NameComponent from "./NameComponent.vue";
import PasswordComponent from "./PasswordComponent.vue";
import axios from "axios";
import { library } from '@fortawesome/fontawesome-svg-core'
import { faEnvelope } from '@fortawesome/free-regular-svg-icons'
import { faFacebookF, faTwitterSquare } from '@fortawesome/free-brands-svg-icons'
import { eventBus } from './../eventBus.js';
library.add(faEnvelope, faFacebookF, faTwitterSquare)

export default {
    name: "HomeComponent",
    components: {
        NameComponent,
        PasswordComponent,
    },
    data() {
        return {
            loading: false,
            user: {},
            formattedDate: null,
            showNameComponent: false,
            showPasswordComponent: false,
            profileObject: {
                'mt-8': false
            },
            statusMessage: ''

        };
    },
    computed: {
        isSuccess() {
            return this.statusMessage !== 'Failed';
        },
    },
    created() {
        this.fetchUserDetails();
        eventBus.on('formSubmitted', (message) => {
            this.statusMessage = message;
            setTimeout(() => {
                this.statusMessage = '';
            }, 3000);

        });
    },
    methods: {
        adjustHeight() {
            this.profileObject['mt-8'] = true;
        },
        getImageUrl() {
            return 'images/';
        },
        closeNameComponent() {
            this.showNameComponent = false;
            this.$refs.nameComponent.name = "";
            this.$refs.nameComponent.email = "";
            this.profileObject['mt-8', 'mb-8'] = false;
        },
        closePasswordComponent() {
            this.showPasswordComponent = false;
            this.profileObject['mt-8', 'mb-8'] = false;
        },
        formatDate() {
            const date = new Date(this.user.created_at);
            this.formattedDate = date.toDateString();
        },
        async fetchUserDetails() {
            try {
                // send an authenticated request to fetch user details
                this.loading = true;
                const response = await axios.get('/profile');
                setTimeout(() => {
                    this.loading = false;
                }, 1000);
                this.user = response.data;
                this.formatDate();
            } catch (error) {
                console.error(error);
            }
        },

        toggleShowNameComponent() {
            this.showNameComponent = !this.showNameComponent;
            this.showPasswordComponent = false;
        },

        toggleShowPasswordComponent() {
            this.showPasswordComponent = !this.showPasswordComponent;
            this.showNameComponent = false;
        }
    }
};
</script>

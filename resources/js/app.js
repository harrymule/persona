import '../css/app.css';
import {
    createApp
} from 'vue';
import {
    createRouter,
    createWebHistory
} from 'vue-router';
/* import the fontawesome core */
/* import font awesome icon component */
import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome'
/* import specific icons */

const app = createApp({})
import ExampleComponent from './components/ExampleComponent.vue';
app.component('example-component', ExampleComponent);

import HomeComponent from './components/HomeComponent.vue';
app.component('HomeComponent', HomeComponent);

app.component('font-awesome-icon', FontAwesomeIcon)

app.config.productionTip = false

const routes = [
    {
      path: '/home',
      name: 'home',
      component: HomeComponent
    },
  ]

  const router = createRouter({
    history: createWebHistory(),
    routes,
    silent: true
  })


  app.use(router)

  app.mount('#app')

  export const eventBus = app;

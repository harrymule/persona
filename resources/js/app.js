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


/* add font awesome icon component */
app.component('font-awesome-icon', FontAwesomeIcon)

app.config.productionTip = false
// const router = createRouter({
//     history: createWebHistory(),
//     routes: [{
//             path: '/home',
//             component: HomeComponent
//         },
//         {
//             path: '/about',
//             component: AboutComponent
//         }
//     ]
// });

// const app = createApp({});
// app.use(router);

// app.mount('#app');

const routes = [
    {
      path: '/home',
      name: 'home',
      component: HomeComponent
    },

    // {
    //   path: '/about',
    //   name: 'about',
    //   component: AboutComponent
    // },
    // {
    //   path: '/contact',
    //   name: 'contact',
    //   component: ContactComponent
    // }
  ]

  const router = createRouter({
    history: createWebHistory(),
    routes,
    silent: true
  })


  app.use(router)

  app.mount('#app')

  export const eventBus = app;

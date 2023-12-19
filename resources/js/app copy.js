import 'bootstrap/dist/css/bootstrap.min.css';
import { createApp } from 'vue';
import App from './App.vue';
import routes from './routes';

import EditButton from './components/EditButton.vue';
import DeleteButton from './components/DeleteButton.vue';
import EmptyBox from './components/EmptyBox.vue';
import PageHeading from './components/PageHeading.vue';

import { VueQueryPlugin } from '@tanstack/vue-query';
import { createRouter, createWebHashHistory } from 'vue-router';

/* import the fontawesome core */
import { library } from '@fortawesome/fontawesome-svg-core';

/* import font awesome icon component */
import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome';

/* import specific icons */
import { faCheck, faPencil, faTrash } from '@fortawesome/free-solid-svg-icons';

/* add icons to the library */
library.add(faTrash);
library.add(faPencil);
library.add(faCheck);

const router = createRouter({
    // 4. Provide the history implementation to use. We are using the hash history for simplicity here.
    history: createWebHashHistory(),
    routes, // short for `routes: routes`
});

createApp(App)
    .use(VueQueryPlugin)
    .use(router)
    .component('font-awesome-icon', FontAwesomeIcon)
    .component('PageHeading', PageHeading)
    .component('EmptyBox', EmptyBox)
    .component('EditButton', EditButton)
    .component('DeleteButton', DeleteButton)
    .mount('#app');

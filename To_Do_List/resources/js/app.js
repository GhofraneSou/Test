

import { createApp } from 'vue';
import App from './App.vue';
import Toast from "vue-toastification";

import "vue-toastification/dist/index.css";
import router from '../../resources/router/routes.js'; // Import your router configuration

// Create a Vue app instance and use Vue Router
const app = createApp(App);
app.use(router); // Use Vue Router

// Mount the app to the HTML element with id "app"
app.mount("#app");

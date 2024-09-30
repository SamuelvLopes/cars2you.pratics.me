import '@fortawesome/fontawesome-free/css/all.css';
import { createPinia } from 'pinia';
import { createApp } from 'vue';
import '../node_modules/bulma/css/bulma.css';
import App from './App.vue';
import router from './app/Router/router';
import './style.css';

const app = createApp(App);
app.use(createPinia());
app.use(router);
app.mount('#app');

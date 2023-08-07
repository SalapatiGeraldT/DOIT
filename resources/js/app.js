import './bootstrap';
import { createApp } from 'vue';
import router from './router';

import App from '../js/App.vue';
import '../css/tailwind.css';
import '../css/app.css';


createApp(App).use(router).mount('#app')

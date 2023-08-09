import { createApp } from 'vue';
import App from './components/app.vue';

// Crie um novo Vue app.
const app = createApp(App);

// Monte o app no elemento com o ID 'app'.
app.mount('#app');

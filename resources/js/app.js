import './bootstrap';
import { createApp } from 'vue';
import router from './router'
import App from './components/App.vue';
import '../css/app.css';
import Swal from 'sweetalert2/dist/sweetalert2.all.js';

window.Swal=Swal;
const toast = Swal.mixin({
    toast:true,
    position:'top-end',
    showConfirmButton:false,
    timer:3000,
});
window.toast=toast;
createApp(App).use(router).mount('#app');
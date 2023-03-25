import './bootstrap';

//se importa vue 3
import {createApp} from 'vue'

//se importar los componentes de vue
import SolicitudAmistad from '../js/vue/componets/SolicitudAmistad.vue'
import Notificaciones from '../js/vue/componets/Notificaciones.vue'
import MensajesNotificaciones from '../js/vue/componets/MensajesNotificaciones.vue'

const app = createApp({});

//se declaran los componentes en la aplicación
app.component('SolicitudAmistad',SolicitudAmistad)
    .component('Notificaciones',Notificaciones)
    .component('MensajesNotificaciones',MensajesNotificaciones)

app.mount('#app');
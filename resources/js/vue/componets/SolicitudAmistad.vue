<template>
    <!--Dependiendo el estado de la solicitud de amistad y si el usuario quien esta en esta vista es el usuario quien envio la solicitud o no; 
    habrá un flujo en el comportamiento en el componente para que el usuario pueda realizar las acciones permitidas
    -->
    <!--el estado de la solicitud de amistad no es aceptada y yo envie la solicitud de amistad -->
    <div class="dropdown" v-if="this.solicitud.estado === '0' && this.logueado === this.solicitud.usuario_id">  
        <button class="btn btn-sm button text-white dropdown-toggle" data-toggle="dropdown" data-placement="top" title="solitud de amistad enviada"><i class="fas fa-user-clock"></i></button>
        <div class="dropdown-menu">
            <a href="#" class="dropdown-item" v-on:click="eliminarSolicitud()">Eliminar solicitud</a>
        </div>
    </div>
    <!--el estado de la solicitud de amistad no es aceptada y yo no envie la solicitud de amistad -->
    <div class="dropdown" v-else-if="this.solicitud.estado === '0' && this.logueado !== this.solicitud.usuario_id">  
        <button class="btn btn-sm button text-white dropdown-toggle" data-toggle="dropdown" data-placement="top" title="confirmar solicitud de amistad"><i class="fas fa-user-clock"></i></button>
        <div class="dropdown-menu">
            <a href="#" class="dropdown-item" v-on:click="eliminarSolicitud()">Ignorar solicitud</a>
            <a href="#" class="dropdown-item" v-on:click="aceptarSolicitud()">Aceptar solicitud</a>
        </div>
    </div>
    <!--el estado de la solicitud de amistad aceptada -->
    <div class="dropdown" v-else-if="this.solicitud.estado === '1'">  
        <button class="btn btn-sm button text-white dropdown-toggle" data-toggle="dropdown" data-placement="top" title="son amigos"><i class="fas fa-user-check"></i></button>
        <div class="dropdown-menu">
            <a href="#" class="dropdown-item" v-on:click="eliminarSolicitud()">Eliminar solicitud</a>
        </div>
    </div>
    <!-- Se envia una solicitud de amistad - se crea en la base de datos -->
    <div class="dropdown" v-else>  
        <button class="btn btn-sm button text-white dropdown-toggle" data-toggle="dropdown" data-placement="top" title="agregar como amigo"><i class="fas fa-user-plus"></i></button>
        <div class="dropdown-menu">
            <a href="#" class="dropdown-item" v-on:click="enviarSolicitud()">Enviar solicitud</a>
        </div>
    </div>
   
</template>

<script>
import axios from 'axios';
export default {
    name:'SolicitudAmistad',
    data() {
        return {
            solicitud:{}
        }
    },
    props:['logueado','slug'],
    async mounted(){
        //llamar este método al iniciar la página
        this.consultarEstado();
    },
    methods:{
        /**
         * Método que permite conocer el estado de la solicitud de amistad del perfil. 
         * Es una petificon axios con el envio del slug del perfil para realizar la consulta en el lado del servidor.
         */
        async consultarEstado(){
            try {
                const respuesta = await axios.get('/amigos/consultar-estado/'+this.slug)
                    this.solicitud = respuesta.data
                } catch (error) {
                    toastr.error('No se pudo procesar la solicitud', 'Error')
                }
        },
        /**
         * Método que permite enviar una solicitud de amistad al perfil. 
         * Es una petificon axios con el envio del slug del perfil para realizar la creacion de la solicitud de amistad
         * en el lado del servidor.
         */
        async enviarSolicitud(){
            try {
                const respuesta = await axios.post('/amigos/enviar-solicitud/'+this.slug)
                this.consultarEstado();
                toastr.success('se envio una solicitud de amistad', 'Red Social')
            } catch (error) {
                toastr.error('No se pudo procesar la solicitud', 'Error')
            }
        },
        /**
         * Método que permite eliminar la solicitud de amistad al perfil. 
         * Es una petificon axios con el envio del slug del perfil para eliminar solicitud de amistad
         * en el lado del servidor.
         */
        async eliminarSolicitud(){
            try{
                const respuesta = await axios.delete('/amigos/eliminar-solicitud/'+this.slug)
                this.consultarEstado();
                toastr.success('se eliminó la solicitud de amistad', 'Red Social')
            }catch(error){
                toastr.error('No se pudo procesar la solicitud', 'Error')
            }
        },
        /**
         * Método que permite aceptar la solicitud de amistad al perfil. 
         * Es una petificon axios con el envio del slug del perfil para realizar el update de la solicitud de amistad
         * en el lado del servidor.
         */
        async aceptarSolicitud(){
            try{
                const respuesta = await axios.put('/amigos/aceptar-solicitud/'+this.slug)
                this.consultarEstado();
                toastr.success('se aceptó la solicitud de amistad', 'Red Social')
            }catch(error){
                toastr.error('No se pudo procesar la solicitud', 'Error')
            }
        }
    }
}
</script>

<style scoped>
.button{
    background-color: #006699;
    color: white;
}

.button:hover{
    background-color: white;
    color: #006699!important
}

</style>
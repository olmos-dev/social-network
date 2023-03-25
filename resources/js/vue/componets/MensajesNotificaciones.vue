<template>
     <li class="nav-item dropdown">
        <a v-if="this.conteo == 0" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-expanded="false">
            <i class="fas fa-envelope"></i> Mensajes
        </a>
        <a v-else class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-expanded="false">
            <i class="fas fa-envelope"></i> Mensajes ({{ this.conteo }})
        </a>
        <div class="dropdown-menu">
            <div v-for="(mensaje,index) in mensajes" :key="index">
                <a class="dropdown-item" :href="'/red-social/mensajes/'+mensaje.data.slug" @click="marcarLeido(mensaje.id)" width="100">
                    <small>
                        <i class="fas fa-comment-alt text-color"></i> <span class="text-capitalize">{{ mensaje.data.nombre }}</span> te envió un mensaje
                    </small>
                </a>
            </div>
            <div v-if="this.mensajes.length > 0" class="dropdown-divider"></div>
            <a class="dropdown-item" href="/red-social/mensajes">Ver todos</a>
        </div>
    </li>
</template>

<script>
export default {
    name:'MensajesNotificaciones',
    data() {
        return {
            conteo:0,
            mensajes:[]
        }
    },
    async mounted() {
        this.contarMensajes()
        this. MostrarNuevosMensajes()
    },
    methods:{
        async marcarLeido(id){
            try {
                const respuesta = await axios.put('/notificaciones-mensajes-marcar-leido/'+id)
                //console.log(respuesta.data);
                } catch (error) {
                    console.log(error)
            }
        },
        async contarMensajes(){
            try {
                const respuesta = await axios.get('/notificaciones-mensajes/contar')
                    this.conteo = respuesta.data
                    //console.log(respuesta.data)
                } catch (error) {
                    console.log(error)
            }
        },
        async MostrarNuevosMensajes(){
            try {
                const respuesta = await axios.get('/notificaciones-mostrar-mensajes')
                    this.mensajes = respuesta.data
                    //console.log(respuesta.data)
                } catch (error) {
                    console.log(error)
            }
        },
    }

}
</script>
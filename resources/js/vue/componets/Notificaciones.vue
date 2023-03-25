<template>
    <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" v-if="this.conteo == 0" href="#" role="button" data-toggle="dropdown" aria-expanded="false">
            <i class="fas fa-bell"></i> 
        </a>
        <a class="nav-link dropdown-toggle" v-else href="#" role="button" data-toggle="dropdown" aria-expanded="false">
            <i class="fas fa-bell"></i> ({{ this.conteo }}) 
        </a>
        <div class="dropdown-menu">
            <div v-for="item in this.amistad" :key="item.id">
                <a class="dropdown-item" v-on:click="marcarLeido(item.id)" :href="'/red-social/perfil/'+item.slug" width="100">
                    <small>
                        <i class="fas fa-user-plus text-color"></i> {{ item.name }} te envió solicitud
                    </small>
                </a>
            </div>
            <div v-if="this.amistad.length > 0" class="dropdown-divider"></div>
            <a class="dropdown-item" href="/notificaciones">Ver todas</a>
        </div>
    </li>
</template>

<script>
export default {
    name:'Notificaciones',
    data() {
        return {
            conteo:0,
            amistad:[]
        }
    },
    async mounted() {
        this.contarSolicitudAmistad()
        this.mostrarNuevasSolicitudes()
    },
    methods:{
        async contarSolicitudAmistad(){
            try {
                const respuesta = await axios.get('/notificaciones/solicitud-amistad/contar')
                    this.conteo = respuesta.data
                } catch (error) {
                    console.log(error)
            }
        },
        async mostrarNuevasSolicitudes(){
            try {
                const respuesta = await axios.get('/notificaciones/mostrar-nuevas-solicitudes')
                    const notificaciones = respuesta.data
                    //console.log(notificaciones);
                    notificaciones.forEach(element => {
                        var info = {
                            'id':element.id,
                            'name':element.data.nombre,
                            'slug':element.data.slug
                        }
                        this.amistad.push(info);
                    });
                } catch (error) {
                    console.log(error)
            }
        
        },
        async marcarLeido(id){
            try {
                const respuesta = await axios.put('/notificaciones/marcar-leido/'+id)
                //console.log(respuesta.data);
                } catch (error) {
                    console.log(error)
            }
        }  
    }
}
</script>
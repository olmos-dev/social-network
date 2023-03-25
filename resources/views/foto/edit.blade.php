@extends('layouts.app')

{{-- se importan los estlos css --}}
@section('estilos')
    <link rel="stylesheet" href="{{ asset('css/plugins/dropzone.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/plugins/toastr.min.css') }}">
@endsection

{{-- es la vista para cambiar la foto del perfil y se ua un plugin --}}
@section('content')
    <div class="container margen-principal">
        <div class="row justify-content-center">
            <div class="col-12 col-md-6">
                <div class="card shadow mb-5">
                    <div class="card-body">
                        <fieldset class="px-md-5 pb-md-5 pt-3">
                            <legend class="text-center">Editar foto de perfil</legend>
                            <div class="mb-4">
                                <div id="dropzone" class="dropzone form-control"></div>
                                <input type="hidden" id="slug" name="slug" value="{{ $perfil->slug }}">
                            </div>
                        </fieldset>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

{{-- se importan los plugins y scripts js --}}
@section('scripts')
    <script src="{{ asset('js/plugins/dropzone.min.js') }}" defer></script>
    <script src="{{ asset('js/plugins/toastr.min.js') }}" defer></script>
    <script defer>
        //al cargar el DOM
        document.addEventListener('DOMContentLoaded',function(){
            const slug = document.getElementById('slug').value;

            Dropzone.autoDiscover = false

            //confiración del plugin
            const dropzone = new Dropzone('div#dropzone',{
                url:'/red-social/foto-perfil/editar/'+slug,
                dictDefaultMessage:'Sube una foto de perfil',
                maxFiles:1,
                required:false,
                acceptedFiles:'.png,.jpg,.jpeg',
                paramName: "foto",
                addRemoveLinks:true,
                dictRemoveFile: "quitar",
                dictCancelUpload: "",
                dictInvalidFileType: "No puedes subir archivos de este tipo",
                dictMaxFilesExceeded: "No puedes subir más fotos",
                //se envia el token csrf para poder procesar las peticiones
                headers:{
                    'X-CSRF-TOKEN': document.querySelector('meta[name=csrf-token]').content
                },
                //cuando se inicia la página
                init(){
                    //petición ajax de tipo get
                    $.ajax({
                        type:'get',
                        url: '/red-social/foto-perfil/checar/'+slug,
                        //se envia el token csrf para poder procesar las peticiones
                        headers:{
                            'X-CSRF-TOKEN': document.querySelector('meta[name=csrf-token]').content
                        },
                        //verifica si existe una foto del perfil o no para mostrar un thumbnail 
                        success: function (response) {
                            if(response.foto !== null){
                                //se crea el objeto file con sus propiedades
                                cargada = {}
                                cargada.size = 800,
                                cargada.name = Date.now(),
                                cargada.archivoId = response.id
                                cargada.ruta = response.foto

                                //se llaman los metodos para mostrar la imagen
                                dropzone.options.addedfile.call(dropzone,cargada)
                                dropzone.options.thumbnail.call(dropzone,cargada, `http://127.0.0.1:8000/storage/${cargada.ruta}`)
        
                                //se agregan las clases
                                cargada.previewElement.classList.add('dz-success')
                                cargada.previewElement.classList.add('dz-complete')

                                //se asignan clases css a traves de jQuery para mostrar la imagen correctamente
                                $('img').css({"display":"block", "object-fit":"scale-down","width":"200px"});
                                
                                
                            }
                        }
                        
                    });
                },
                //método que se utiliza al subir la foto de perfil
                success: function(file,response){
                    //verifica que la foto de perfil se haya subido correctamente en el lado de la respuesta del servidor
                    if(response == true){
                        var galeria = document.getElementById('dropzone')
                        var preview = galeria.childNodes
                        //verifica que si se tenia un thumbnail de la foto sera remplazada por la nueva
                        if(preview.length >= 3){
                            preview[1].remove()
                        }
                        toastr.success('Foto de perfil subida')
                    }
                },
                //método para remover los archivos
                removedfile(file) {
                    //se realiza un peticion ajax de tipo delete
                    $.ajax({
                        type: 'delete',
                        url: '/red-social/foto-perfil/editar/'+slug,
                        data:slug,
                        //se envia el token csrf para poder procesar las peticiones
                        headers: {
                            'X-CSRF-TOKEN': document.querySelector('meta[name=csrf-token]').content
                        },
                        //verifica que la peticion sea exitosa
                        success: function (response) {
                            if(response === '200'){
                                //eliminar la vista previa de la foto de perfil del formulario
                                file.previewElement.parentNode.removeChild(file.previewElement)
                                toastr.success('Foto de perfil eliminada')
                            }
                        }
                    });
                },
                //método para manejo de errores
                error: function(file,message){
                //elimina la vista previa de la imagen en caso de un error
                file.previewElement.parentNode.removeChild(file.previewElement)
                //lanza mensaje de error 
                toastr.error(
                    message,
                    "Error"
                );
            },
            });
        });
    </script>
@endsection
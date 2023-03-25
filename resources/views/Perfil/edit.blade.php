@extends('layouts.app')

{{-- se imoortan los estilos css --}}
@section('estilos')
    <link rel="stylesheet" href="{{ asset('css/plugins/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/plugins/select2-bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/plugins/icheck-bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/plugins/summernote-bs4.css') }}">
@endsection

{{-- vista para editar el perfil logueado --}}
@section('content')
    <div class="container margen-principal">
        {{-- formulario para editar el perfil con validaciones y busqueda a través de slug --}}
        <form action="{{ route('perfil.update',['perfil' => $perfil->slug]) }}" method="POST">
            @csrf @method('put')
        <div class="row justify-content-center">
            <div class="col-12 col-md-8">
                    <div class="card shadow mb-5">
                        <div class="card-body">
                            <fieldset class="px-5 pb-5 pt-3">
                                <legend class="text-center">Editar mi perfil</legend>
                                <div class="mb-4">
                                    <label for="name" class="font-weight-bold">Nombre</label>
                                    <input type="text" name="name" class="my-form-control @error('name') my-is-invalid @enderror" placeholder="Escribe tu nombre" value="{{ old('name') ?? auth()->user()->name }}">
                                    @error('name')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="mb-4">
                                    <label for="pais" class="font-weight-bold">País de orígen</label>
                                    <select class="my-form-control @error('pais') my-is-invalid @enderror" name="pais">
                                        <option selected="selected" disabled>selecciona un país</option>
                                        @foreach ($paises as $pais)
                                            <option value="{{ $pais->id }}" {{ old('pais') == $pais->id ? 'selected' : '' }} {{ $perfil->pais_id == $pais->id ? 'selected' : '' }}>{{ $pais->nombre }}</option>
                                        @endforeach
                                    </select>
                                    @error('pais')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="mb-4">
                                    <label for="nativo" class="font-weight-bold">Idioma</label>
                                    <select class="my-form-control @error('idioma') my-is-invalid @enderror" name="idioma">
                                        <option selected="selected" disabled>selecciona un idioma</option>
                                        @foreach ($idiomas as $idioma)
                                            <option class="text-capitalize" value="{{ $idioma->id }}" {{ old('idioma') == $idioma->id ? 'selected' : '' }} {{ $perfil->idioma_id == $idioma->id ? 'selected' : '' }}>{{ $idioma->nombre }}</option>
                                        @endforeach
                                    </select>
                                    @error('idioma')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="mb-4">
                                    <label for="cumple" class="font-weight-bold">Fecha de cumpleaños</label>
                                    <input type="date" name="cumple" id="cumple" class="my-form-control @error('cumple') my-is-invalid @enderror" value="{{ old('cumple') ?? $perfil->cumple}}">
                                    @error('cumple')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="mb-4">
                                    <label for="genero" class="font-weight-bold">Género</label><br>
                                    <div class="d-flex justify-content-around">
                                        @foreach ($generos as $genero)
                                        <div class="icheck-success d-inline">
                                            <input type="radio" id="{{ $genero->nombre }}" name="genero" value="{{ $genero->id }}" {{ old('genero') == $genero->id ? 'checked' : '' }} {{ $perfil->genero_id == $genero->id ? 'checked' : '' }}>
                                            <label class="text-capitalize" for="{{ $genero->nombre }}"><span class="{{$genero->id == 2 ? ('icono-m') : ('icono-h') }}"><i class="{{ $genero->ruta }}"></i></span> {{ $genero->nombre }}
                                            </label>
                                        </div>
                                        @endforeach
                                       
                                    </div>
                                    @error('genero')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </fieldset>
                        </div>
                    </div>
            </div>
            {{-- se utiliza un plugin de un editor de texto para la descripción del perfil--}}
            <div class="col-12 col-md-8">
                    <div class="card shadow mb-5">
                        <div class="card-body">
                            <fieldset class="">
                                <legend class="text-center">Editar descripción</legend>
                                <div id="summernote">{!! $perfil->descripcion !!}</div>
                                <input type="hidden" name="descripcion" id="descripcion">
                            </fieldset>
                            <div class="d-flex justify-content-center mt-4">
                                <button class="btn btn-primary w-50">Actualizar perfil</button>
                            </div>
                        </div>
                    </div>
            </div>
        </div>
        </form>
    </div>
@endsection

@section('scripts')
<script src="{{ asset('js/plugins/select2.min.js') }}"></script>
<script src="{{ asset('js/plugins/summernote-bs4.js') }}"></script>
<script src="{{ asset('js/plugins/summernote-es-ES.min.js') }}"></script>
<script>
    $(document).ready(function () {
        //summernote editor
        $('#summernote').summernote({
            height: 400,                 // set editor height
            minHeight: null,             // set minimum height of editor
            maxHeight: null,             // set maximum height of editor
            focus: false,                // set focus to editable area after initializing summernote
            lang:'es-ES',
            toolbar: [
                ['style', ['style']],
                ['font', ['bold', 'underline', 'clear']],
                ['color', ['color']],
                ['para', ['ul', 'ol', 'paragraph']],
                ['insert', ['link']],
                ['height', ['height']]
                //['table', ['table']],
                //['insert', ['link', 'picture', 'video']],
                //['view', ['fullscreen', 'codeview', 'help']]
            ]
        });

        //estos métodos sirven para pasar lo que se escribe en el editor de texto pase a un campo para ser procesado en el formulario
        $(window).on('keyup', function () {
            var texto = $('#summernote').summernote('code');
            $("#descripcion").val(texto);
        });

        $(window).on('click', function () {
            var texto = $('#summernote').summernote('code');
            $("#descripcion").val(texto);
        });
    

    });
</script>
@endsection
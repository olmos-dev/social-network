@extends('layouts.app')

{{-- se importan los estilos css --}}
@section('estilos')
    <link rel="stylesheet" href="{{ asset('css/plugins/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/plugins/select2-bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/plugins/icheck-bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/plugins/ion.rangeSlider.min.css') }}">
@endsection

{{-- vista del formulario para buscar --}}
@section('content')
    <div class="container margen-principal">
        <div class="row justify-content-center">
            <div class="col-12 col-md-8">
                {{-- formulario con validaciones --}}
                <form action="{{ route('comunidad.index') }}" method="get">
                    <div class="card shadow mb-5">
                        <div class="card-body">
                            <fieldset class="px-5 pb-5 pt-3">
                                <legend class="text-center">Parámetros de búsqueda</legend>
                                <div class="mb-4">
                                    <label for="name" class="font-weight-bold">Nombre</label>
                                    <input type="text" name="name" class="my-form-control @error('name') my-is-invalid @enderror" placeholder="Nombre" value="{{ old('name') }}">
                                    @error('name')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="mb-4">
                                    <label for="name" class="font-weight-bold">Username</label>
                                    <input type="text" name="username" class="my-form-control @error('username') my-is-invalid @enderror" placeholder="Nombre de usuario" value="{{ old('username') }}">
                                    @error('username')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="edad" class="font-weight-bold">Rango de Edad <small class="text-muted"><span id="a"></span><span> - </span><span id="b"></span> años</small> </label>
                                    <input type="text" id="deslizante" name="" value="" style="width: 100%" class="@error('edadMayor') is-invalid @enderror @error('edadMenor') is-invalid @enderror" />
                                    @error('edadMenor')
                                    <small class="text-danger">{{ $message }}</small><br>
                                    @enderror
                                    @error('edadMayor')
                                    <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                    <input type="hidden" id="edadMenor" name="edadMenor" value="">
                                    <input type="hidden" id="edadMayor" name="edadMayor" value="">
                                </div>
                                <div class="mb-4">
                                    <label for="pais" class="font-weight-bold">Pais</label>
                                    <select class="my-form-control @error('pais') my-is-invalid @enderror" name="pais">
                                        <option value="">Cualquier país</option>
                                        @foreach ($paises as $pais)
                                            <option value="{{ $pais->id }}" {{ old('pais') == $pais->id ? 'selected' : '' }}>{{ $pais->nombre }}</option>
                                        @endforeach
                                    </select>
                                    @error('pais')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="mt-5 mb-4">
                                    <label for="genero" class="font-weight-bold">Genéro</label><br>
                                    <div class="d-flex justify-content-around">
                                        @foreach ($generos as $genero)
                                        <div class="icheck-primary d-inline">
                                            <input type="checkbox" id="{{ $genero->nombre }}" name="genero" value="{{ $genero->id }}" {{ old('genero') == $genero->id ? 'checked' : '' }}>
                                            <label class="text-capitalize" for="{{ $genero->nombre }}"><span class="{{$genero->id == 2 ? ('icono-m') : ('icono-h') }}"><i class="{{ $genero->ruta }}"></i></span> {{ $genero->nombre }}
                                            </label>
                                        </div>
                                        @endforeach
                                    </div>
                                    @error('genero')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="mb-4">
                                    <label for="ordenar" class="font-weight-bold">Ordenar</label>
                                    <select class="my-form-control @error('ordenar') my-is-invalid @enderror" name="ordenar">
                                        @foreach ($sorts as $sort)
                                            <option value="{{ $sort->sort }}" {{ old('ordenar') === $sort->sort ? 'selected' : '' }}>{{ $sort->id == 1 ? 'Antiguos' : 'Nuevos' }}</option>
                                        @endforeach
                                    </select>
                                    @error('ordenar')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </fieldset>
                            <div class="d-flex justify-content-center">
                                <button class="btn btn-primary w-50">Buscar perfiles</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
<script src="{{ asset('js/plugins/select2.min.js') }}"></script>
<script src="{{ asset('js/plugins/ion.rangeSlider.min.js') }}"></script>
<script>
    $(document).ready(function () {

        //código para seleccionar un solamente un genéro o ninguno
        var hombre = document.getElementById('hombre');
        var mujer = document.getElementById('mujer');

        hombre.addEventListener('click',function(){
            mujer.checked = false;
        });

        mujer.addEventListener('click',function(){
            hombre.checked = false;
        });

        //ion range slider - plugin para seleccionar el rango de las edades
        $("#deslizante").ionRangeSlider({
            //configuración del slider 
            type: "double",
            grid: true,
            min: 18,
            max: 60,
            from: 18,
            to: 99,
            prefix: "",
            postfix: ' años',
            grid_num: 1,
            //se inicia el plugin
            onStart: function (data) {
                    // fired then range slider is ready
                    var edadMenor = document.getElementById('edadMenor').value = data.from;
                    var edadMayor = document.getElementById('edadMayor').value = data.to;

                    /**Para pintar en pantalla las edades*/
                    var a = document.getElementById('a')
                    a.textContent = edadMenor    
                    var b = document.getElementById('b')
                    b.textContent = edadMayor

                },
                onChange: function (data) {
                    // fired on every range slider update
                },
                //se ejecuta despues de realizar la selección del rango
                onFinish: function (data) {
                    // fired on pointer release
                    var edadMenor = document.getElementById('edadMenor').value = data.from;
                    var edadMayor = document.getElementById('edadMayor').value = data.to;

                    /**Para pintar en pantalla las edades*/
                    var a = document.getElementById('a')
                    a.textContent = edadMenor
                    var b = document.getElementById('b')
                    b.textContent = edadMayor
                    
                },
                onUpdate: function (data) {
                    // fired on changing slider with Update method
                }
        })
    });
</script>
@endsection
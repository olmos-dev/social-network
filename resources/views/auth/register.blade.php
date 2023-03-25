@extends('layouts.app')

@section('estilos')
    <link rel="stylesheet" href="{{ asset('css/plugins/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/plugins/select2-bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/plugins/icheck-bootstrap.min.css') }}">
@endsection

@section('content')
    <div class="container margen-principal">
        <div class="row justify-content-center">
            <div class="col-12 col-md-8">
                <form action="{{ route('register') }}" method="POST">
                    @csrf
                    <div class="card shadow mb-5">
                        <div class="card-body">
                            <fieldset class="px-5 pb-5 pt-3">
                                <legend class="text-center">Información personal</legend>
                                <div class="mb-4">
                                    <label for="name" class="font-weight-bold">¿Cómo te llamas?</label>
                                    <input type="text" name="name" class="my-form-control @error('name') my-is-invalid @enderror" placeholder="Escribe tu nombre" value="{{ old('name') }}">
                                    @error('name')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="mb-4">
                                    <label for="pais" class="font-weight-bold">¿De dónde eres?</label>
                                    <select class="my-form-control @error('pais') my-is-invalid @enderror" name="pais">
                                        <option selected="selected" disabled>selecciona un país</option>
                                        @foreach ($paises as $pais)
                                            <option value="{{ $pais->id }}" {{ old('pais') == $pais->id ? 'selected' : '' }}>{{ $pais->nombre }}</option>
                                        @endforeach
                                    </select>
                                    @error('pais')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="mb-4">
                                    <label for="nativo" class="font-weight-bold">¿Cuál es tu idioma nativo?</label>
                                    <select class="my-form-control @error('idioma') my-is-invalid @enderror" name="idioma">
                                        <option selected="selected" disabled>selecciona un idioma</option>
                                        @foreach ($idiomas as $idioma)
                                            <option class="text-capitalize" value="{{ $idioma->id }}" {{ old('idioma') == $idioma->id ? 'selected' : '' }}>{{ $idioma->nombre }}</option>
                                        @endforeach
                                    </select>
                                    @error('idioma')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="mb-4">
                                    <label for="cumple" class="font-weight-bold">¿Cuándo es tu cumpleaños?</label>
                                    <input type="date" name="cumple" id="cumple" class="my-form-control @error('cumple') my-is-invalid @enderror" value="{{ old('cumple') }}">
                                    @error('cumple')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="mb-4">
                                    <label for="genero" class="font-weight-bold">¿Cuál es tu genero?</label><br>
                                    <div class="d-flex justify-content-around">
                                        {{-- comment 
                                        <div class="icheck-success d-inline">
                                            <input type="radio" id="radioPrimary1" name="r1">
                                            <label for="radioPrimary1">Hombre</i>
                                            </label>
                                        </div>
                                        <div class="icheck-success d-inline">
                                            <input type="radio" id="radioPrimary2" name="r1">
                                            <label for="radioPrimary2">Mujer
                                            </label>
                                        </div>
                                        --}}
                                        @foreach ($generos as $genero)
                                        <div class="icheck-success d-inline">
                                            <input type="radio" id="{{ $genero->nombre }}" name="genero" value="{{ $genero->id }}" {{ old('genero') == $genero->id ? 'checked' : '' }}>
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
                            <fieldset class="px-5 pb-5 pt-3">
                                <legend class="text-center">Cuenta</legend>
                                <div class="mb-4">
                                    <label for="username" class="font-weight-bold">Nombre de usuario</label>
                                    <input type="text" name="username" id="username" class="my-form-control @error('username') my-is-invalid @enderror" placeholder="Escríbe un nombre de usuario" value="{{ old('username') }}">
                                    @error('username')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="mb-4">
                                    <label for="email" class="font-weight-bold">Correo electrónico</label>
                                    <input type="email" name="email" class="my-form-control @error('email') my-is-invalid @enderror" placeholder="Escríbe tu correo electrónico" value="{{ old('email') }}">
                                    @error('email')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="mb-4">
                                    <label for="password" class="font-weight-bold">Contraseña</label>
                                    <input type="password" name="password" id="password" class="my-form-control @error('password') my-is-invalid @enderror" placeholder="Escríbe una contraseña">
                                    @error('password')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="">
                                    <label for="" class="font-weight-bold">Confirmar contraseña</label>
                                    <input type="password" name="password_confirmation" id="" class="my-form-control" placeholder="Repite la contaseña">
                                </div>
                            </fieldset>
                            <div class="d-flex justify-content-center">
                                <button class="btn btn-primary w-50">Crear cuenta</button>
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
<script>
    $(document).ready(function () {
        $('.select2bs4').select2({
            theme: 'bootstrap4'
        })
    });
</script>
@endsection
@extends('layouts.app')

{{-- Vista del formulario de la cuenta --}}
@section('content')
    <div class="container margen-principal">
        <div class="row justify-content-center">
            <div class="col-12 col-md-6">
                {{-- se muestra un mensaje de confirmación --}}
               @include('components.alert')
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-12 col-md-6">
                <div class="card shadow">
                    <div class="card-header d-flex justify-content-md-between">
                        <h5>Cuenta</h5>
                        {{-- acciones de la cuenta --}}
                        <div>
                            <a href="{{ route('cuenta.edit') }}" class="acceso-rapido"> Editar perfil /</a>
                            <a href="{{ route('contrasena.edit') }}" class="acceso-rapido"> Cambiar contraseña </a>
                        </div>
                    </div>
                    {{-- se muestra la información de la cuenta --}}
                    <div class="card-body">
                        <div class="form-group">
                            <label for="nombre" class="font-weight-bold">Nombre</label>
                            <input type="text" name="nombre" id="nombre" class="my-form-control bg-white" value="{{ $usuario->name }}" readonly>
                        </div>
                        <div class="form-group">
                            <label for="email" class="font-weight-bold">Correo electrónico</label>
                            <input type="text" name="email" id="email" class="my-form-control bg-white" value="{{ $usuario->email }}" readonly>
                        </div>
                        <div class="form-group d-flex justify-content-center justify-content-md-end">
                            <small class="text-muted">Registrado {{ $usuario->created_at->format('d/m/Y H:m') }}</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@extends('layouts.app')

{{-- vista para editar la cuenta del perfil --}}
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
                {{-- formulario para la edición de la cuenta del usuario con validaciones --}}
                <form action="{{ route('cuenta.update') }}" method="POST">
                    @csrf
                    @method('put')
                    <div class="card shadow">
                        <div class="card-header h5">
                            Editar Cuenta
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                <label for="nombre" class="font-weight-bold">Nombre</label>
                                <input type="text" name="nombre" id="nombre" class="my-form-control @error('nombre') my-is-invalid @enderror" value="{{ old('nombre') ?? $usuario->name }}">
                                <div>
                                @error('nombre')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="email" class="font-weight-bold">Correo electrónico</label>
                                <input type="text" name="email" id="email" class="my-form-control @error('email') my-is-invalid @enderror" value="{{ old('email') ?? $usuario->email }}">
                                @error('email')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="password" class="font-weight-bold">Confirmar contraseña</label>
                                <input type="password" name="password" id="password" class="my-form-control @error('password') my-is-invalid @enderror" placeholder="Escriba la contraseña para continuar">
                                @error('password')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                        <div class="card-footer d-flex justify-content-center">
                            <button type="submit" class="btn btn-primary">Actualizar</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
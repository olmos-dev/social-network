@extends('layouts.app')

{{-- vista para cambiar la contraseña --}}
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
                {{-- formulario para cambiar la contraseña con validación de los campos --}}
                <form action="{{ route('contrasena.update') }}" method="POST">
                    @csrf
                    @method('put')
                    <div class="card shadow">
                        <div class="card-header h5">
                            Cambiar contraseña
                        </div>
                        <div class="card-body">
                            <div class="mb-4">
                                <label for="pass" class="font-weight-bold">Contraseña Actual</label>
                                <input type="password" name="pass" id="pass" class="my-form-control @error('pass') my-is-invalid @enderror" placeholder="Escríbe la contraseña actualmente">
                                @error('pass')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="mb-4">
                                <label for="password" class="font-weight-bold">Contraseña</label>
                                <input type="password" name="password" id="password" class="my-form-control @error('password') my-is-invalid @enderror" placeholder="Escríbe una contraseña nueva">
                                @error('password')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="">
                                <label for="" class="font-weight-bold">Confirmar contraseña</label>
                                <input type="password" name="password_confirmation" id="" class="my-form-control" placeholder="Repite la contaseña nueva">
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
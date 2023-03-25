@extends('layouts.app')

@section('content')
    <div class="container margen-principal">
        <div class="row">
            {{-- mensaje de validación --}}
            <div class="col-12">
                @if ($errors->all())
                <div class="alert alert-danger alert-dismissible fade show fixed-top" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        <span class="sr-only">Close</span>
                    </button>
                    <strong>Red social</strong> 
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12 col-md-4 mt-5">
                {{-- login --}}
                <form action="{{ route('login') }}" method="post" novalidate>
                    @csrf
                    <h2 class="h3 text-center py-2">Iniciar sesión</h2>
                    <div class="card shadow">
                        <div class="card-body">
                            <p class="text-muted text-center py-2">Registrate para comunicarte con las personas que más quieres</p>
                            <div class="input-group mb-4">
                                <input type="email" name="email" class="form-control" placeholder="correo electrónico">
                                <div class="input-group-append">
                                    <div class="input-group-text">
                                      <span class="fas fa-envelope"></span>
                                    </div>
                                </div>
                            </div>
                            <div class="input-group mb-4">
                                <input type="password" name="password" class="form-control" placeholder="contraseña">
                                <div class="input-group-append">
                                    <div class="input-group-text">
                                      <span class="fas fa-lock"></span>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group d-flex justify-content-start">
                                <button type="submit" class="btn btn-primary">Entrar</button>
                            </div>
                          
                        </div>
                    </div>
                </form>
            </div>
            {{-- imagen --}}
            <div class="col-sm-12 col-md-8 d-none d-md-block mt-5">
               <img src="{{ asset('images/login.jpg') }}" alt="login" class="img-fluid shadow">
            </div>
        </div>
    </div>
@endsection
@extends('layouts.app')

@section('estilos')
    <link rel="stylesheet" href="{{ asset('css/plugins/lightbox.min.css') }}">
@endsection

{{-- Vista que contiene los datos del perfil logueado --}}
@section('content')
    <div class="container margen-principal">
        <div class="row justify-content-center">
            <div class="col-12 col-md-10">
               @include('components.alert')
            </div>
        </div>
        <div class="row justify-content-center mb-5">
            {{-- Foto de perfil --}}
            <div class="col-12 col-md-4">
                <div class="card shadow-none shadow-md">
                    <div class="row no-gutters">
                      <div class="col-md-12">
                        {{-- Verifica si el perfil tiene foto o no --}}
                        @if (auth()->user()->perfil->foto != null)
                            <a href="{{ asset('storage/'.$perfil->foto) }}" data-lightbox="image-1" data-title="Foto de perfil de {{ auth()->user()->name }}"><img src="{{ asset('storage/'.$perfil->foto) }}" alt="foto de perfil" class="img-fluid"></a>     
                        @else
                            <img src="{{ asset('images/profiles/blank-profile-picture-gae2f37bbf_640.png') }}" alt="no disponible" class="img-fluid">
                        @endif
                      </div>
                     
                    </div>
                </div>
                {{-- acceso rapido --}}
                <div class="col-12 my-0 my-md-5">
                    <ul class="lista-perfil text-left d-none d-md-block">
                        <li><a href="{{ route('index.notificaciones') }}" class="acceso-rapido"><i class="fas fa-bell"></i> Notificaciones {{ $contarNotificacionesSolicitudes  > 0 ? "(".$contarNotificacionesSolicitudes.")" : ''}}</a></li>
                        <li><a href="{{ route('comunidad.index') }}" class="acceso-rapido"><i class="fas fa-users"></i> Comunidad</a></li>
                        <li><a href="/red-social/mensajes" class="acceso-rapido"><i class="fas fa-envelope"></i> Mensajes {{ $contarNotificacionesMensajes  > 0 ? "(".$contarNotificacionesMensajes.")" : ''}}</a></li> </a></li>
                        <li><a href="{{ route('amigos.index') }}" class="acceso-rapido"><i class="fas fa-user-friends"></i> Amigos {{ $numeroAmigos > 0 ? "(".$numeroAmigos.")" : ''}}</a></li>
                        <li><a href="{{ route('buscar.index') }}" class="acceso-rapido"><i class="fas fa-search"></i> Buscar</a></li>
                    </ul>
                </div>
            </div>
            {{-- información del perfil --}}
            <div class="col-12 col-md-6">
                <div class="card shadow">
                    <div class="card-header fondo-color py-0 d-flex justify-content-between">
                        <div>
                            <a href="#" class="btn btn-sm btn-user"><i class="fas fa-user"></i> {{ $perfil->username }}</a>
                        </div>
                        <div>
                            <a href="{{ route('perfil.edit',['perfil' => $perfil->slug]) }}" class="btn btn-sm button" class="text-white" data-toggle="tooltip" data-placement="top" title="editar perfil"><i class="fas fa-user-edit"></i></a>
                            <a href="{{ route('foto.edit',['perfil' => $perfil->slug]) }}" class="btn btn-sm button" class="text-white" data-toggle="tooltip" data-placement="top" title="editar foto de perfil"><i class="fas fa-camera"></i></a>
                        </div>
                    </div>
                    <div class="card-body bg-light py-1 d-flex justify-content-center">
                        <small><i class="fas fa-circle text-success" style="font-size: 10px"></i><span class="text-muted"> en linea</span></small>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-12 col-md-6 d-flex justify-content-center justify-content-md-start">
                                <p class="{{ $perfil->genero->id == 1 ? 'icono-h' : 'icono-m'}}"><i class="{{ $perfil->genero->ruta }}"></i></p>
                                <p class="font-weight-bold mx-1">{{ $perfil->usuario->name }} </p>
                                <p class="text-muted"> {{ Carbon::parse($perfil->cumple)->age }}</p>
                            </div>
                            <div class="col-12 col-md-6 d-flex justify-content-center justify-content-md-end">
                                <small class="text-muted">{{ $perfil->pais->nombre }} <img src="{{ asset('images/flags/'.$perfil->pais->ruta) }}" alt="pais" width="30"></small>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12 mt-3">
                                {!! $perfil->descripcion !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="{{ asset('js/plugins/lightbox.min.js') }}" defer></script>
@endsection
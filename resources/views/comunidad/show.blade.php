@extends('layouts.app')

{{-- Se importan los estilos o plugins css --}}
@section('estilos')
    <link rel="stylesheet" href="{{ asset('css/plugins/lightbox.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/plugins/toastr.min.css') }}">
@endsection

@section('content')
    <div class="container margen-principal">
        <div class="row justify-content-center mb-5">
            {{-- Foto de perfil --}}
            <div class="col-12 col-md-4">
                <div class="card shadow">
                    <div class="row no-gutters">
                      <div class="col-md-12">
                        {{-- Verifica si el perfil tiene un foto ó no --}}
                        @if ($perfil->foto != null)
                            <a href="{{ asset('storage/'.$perfil->foto) }}" data-lightbox="image-1" data-title="Foto de perfil de {{ $perfil->usuario->name }}"><img src="{{ asset('storage/'.$perfil->foto) }}" alt="foto de perfil" class="img-fluid"></a>     
                        @else
                            <img src="{{ asset('images/profiles/profile.png') }}" alt="no disponible" class="img-fluid">
                        @endif
                      </div>
                    </div>
                </div>
            </div>
            {{-- información del perfil --}}
            <div class="col-12 col-md-6">
                <div class="card shadow">
                    <div class="card-header fondo-color py-0">
                        <div class="row">
                            <div class="col-6 d-flex justify-content-start">
                                <a href="#" class="btn btn-sm btn-user"><i class="fas fa-user"></i> {{ $perfil->username }}</a>
                            </div>
                            <div class="col-6 d-flex justify-content-end">
                                <a href="{{ route('mensajes.create',['perfil' => $perfil]) }}" class="btn btn-sm button" class="text-white" data-toggle="tooltip" data-placement="top" title="enviar mensaje"><i class="fas fa-envelope"></i></a>                            
                                {{-- Componente de Vue para el manejo y el comportamiento de las solicitudes de amistad --}}
                                <solicitud-amistad logueado="{{ auth()->user()->id }}" slug="{{ $perfil->slug }}"></solicitud-amistad>
                            </div>
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
                    <div class="card-footer py-0 px-3 d-flex justify-content-center justify-content-md-end">
                        <small class="text-muted">Se unió {{ $perfil->created_at->diffForHumans() }}</small>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

{{-- se importar los scripts o pluging js --}}
@section('scripts')
    <script src="{{ asset('js/plugins/lightbox.min.js') }}" defer></script>
    <script src="{{ asset('js/plugins/toastr.min.js') }}" defer></script>
@endsection
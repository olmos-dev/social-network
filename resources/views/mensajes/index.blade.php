@extends('layouts.app')

@section('estilos')
    <style>
        .enlace{
            color: black!important;
        }
        .tamano{
            font-size: 11px;
        }
    </style>
@endsection

@section('content')
    <div class="container margen-principal">
        <div class="row justify-content-center">
            <div class="col-12 col-md-6">
                <div class="card shadow mb-5">
                    <div class="card-header h5">
                        Mensajes
                    </div>
                    <div class="card-body">
                        {{-- se hace el recorrido para obtener los perfiles de los mensajes --}}
                        @forelse ($mensajes as $mensaje)
                            {{--verifica que el perfil no sea del usuario que esta logueado, para posteriormente muestra solo el perfil con quien el usuario ha conversado--}}
                            @if ($mensaje->emisor_id != auth()->user()->id)
                                <div class="card mb-3 py-2 bg-light">
                                    <div class="row">
                                        <div class="col-3 d-flex justify-content-center align-self-center">
                                            {{-- se muestra la foto del perfil --}}
                                            <img src="{{ $mensaje->emisorPerfil->foto != null ? asset('storage/'.$mensaje->emisorPerfil->foto) : asset('images/profiles/profile.png') }}" alt="foto de perfil" class="rounded-circle" width="75" height="75" >
                                        </div>
                                        <div class="col-9">
                                            {{-- mostrar el nombre --}}
                                            <a href="{{ route('comunidad.show',['perfil' => $mensaje->emisorPerfil->slug]) }}" class="enlace text-capitalize font-weight-bold">{{ $mensaje->emisorNombre->name}}</a><br>
                                            {{-- mostrarl el elace para ir a los mensajes --}}
                                            <a href="{{ route('mensajes.create',['perfil' => $mensaje->emisorPerfil->slug]) }}" class="enlace text-truncate text-muted"> Ver mensaje </a><br>
                                        </div>
                                    </div>
                                </div>                       
                            @else
                                <div class="card mb-3 py-2 bg-light">
                                    <div class="row">
                                        <div class="col-3 d-flex justify-content-center align-self-center">
                                             {{-- se muestra la foto del perfil --}}
                                            <img src="{{ $mensaje->receptorPerfil->foto != null ? asset('storage/'.$mensaje->receptorPerfil->foto) : asset('images/profiles/profile.png') }}" alt="foto de perfil" class="rounded-circle" width="75" height="75" >
                                        </div>
                                        <div class="col-9">
                                            {{-- mostrar el nombre --}}
                                            <a href="{{ route('comunidad.show',['perfil' => $mensaje->receptorPerfil->slug]) }}" class="enlace text-capitalize font-weight-bold">{{ $mensaje->receptorNombre->name}}</a><br>
                                             {{-- mostrarl el elace para ir a los mensajes --}}
                                            <a href="{{ route('mensajes.create',['perfil' => $mensaje->receptorPerfil->slug]) }}" class="enlace text-truncate text-muted"> Ver mensaje </a><br>
                                            
                                        </div>
                                    </div>
                                </div>  
                            @endif
                        @empty
                            <p class="text-muted">No tienes mensajes todavía</p>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
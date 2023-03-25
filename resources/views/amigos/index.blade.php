@extends('layouts.app')

{{-- vista del listado de amigos --}}
@section('content')
    <div class="container margen-principal">
        <div class="row justify-content-center">
            <div class="col-12 col-md-6">
                <div class="card shadow mb-5">
                    <small class="text-muted mt-3 text-right mr-5">Amigos {{ $numeroAmigos }}</small>
                    <div class="card-body">    
                        @foreach ($amigos as $amigo)
                        <div class="card mb-3" style="max-width: 540px;">
                            <div class="row no-gutters">
                              <div class="col-4">
                                {{-- verifica si el perfil no sean igual al usuario logueado --}}
                                @if (auth()->user()->id == $amigo->perfil->user_id )
                                  <img src="{{ $amigo->usuario->foto != null ? asset('storage/'.$amigo->usuario->foto) : asset('images/profiles/profile.png') }}" alt="foto de perfil" class="img-fluid" >
                                @else
                                  <img src="{{ $amigo->perfil->foto != null ? asset('storage/'.$amigo->perfil->foto) : asset('images/profiles/profile.png') }}" alt="foto de perfil" class="img-fluid" >
                                @endif
                              </div>
                              <div class="col-8">
                                {{-- enlace para ir al perfil --}}
                                <div class="card-body">
                                  <a href="{{ route('comunidad.show',['perfil' => auth()->user()->id == $amigo->perfil->user_id ? $amigo->usuario->slug : $amigo->perfil->slug ]) }}" class="acceso-rapido text-capitalize">{{ auth()->user()->id == $amigo->perfil->user_id ? $amigo->usuario->usuario->name : $amigo->perfil->usuario->name }}</a><br>
                                  <small class="d-none d-md-block text-muted">son amigos {{ $amigo->updated_at->diffForHumans() }}</small>
                                </div>
                              </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@extends('layouts.app')

@section('content')
    <div class="container margen-principal ">
        <div class="row justify-content-center">
            {{-- se muestra cada uno de los perfiles --}}
            @forelse ($perfiles as $perfil)
            <div class="col-12 col-md-9 mb-5">
                <div class="card shadow" style="">
                    <div class="card-header fondo-color py-0 d-flex justify-content-between">
                        <div>
                            <a href="#" class="btn btn-sm btn-user"><i class="fas fa-user"></i> {{ $perfil->username }}</a>
                        </div>
                    </div>
                    <div class="row no-gutters">
                      <div class="col-md-4">
                        {{-- foto de perfil --}}
                        <a href="{{ route('comunidad.show',['perfil' => $perfil->slug]) }}">
                            {{-- verifica el perfil si tiene foto o no --}}
                            <img src="{{ $perfil->foto != null ? asset('storage/'.$perfil->foto) : asset('images/profiles/profile.png') }}" alt="foto de perfil" class="img-fluid">
                        </a>
                      </div>
                      <div class="col-md-8">
                        {{-- información del perfil --}}
                        <div class="card-body">
                            <div class="row">
                                <div class="col-12 col-md-4 d-flex justify-content-center justify-content-md-start mb-3 mb-md-0">
                                    <small><i class="fas fa-circle text-success" style="font-size: 10px"></i><span class="text-muted"> en linea</span></small>
                                </div>
                                <div class="col-12 col-md-4 d-flex justify-content-center justify-content-md-start">
                                    <p class="{{ $perfil->genero->id == 1 ? 'icono-h' : 'icono-m'}}"><i class="{{ $perfil->genero->ruta }}"></i></p>
                                    <p class="font-weight-bold mx-1">{{ $perfil->usuario->name }} </p>
                                    <p class="text-muted"> {{ Carbon::parse($perfil->cumple)->age }}</p>
                                </div>
                                
                                <div class="col-12 col-md-4 d-flex justify-content-center justify-content-md-end">
                                    <small class="text-muted">{{ $perfil->pais->nombre }} <img src="{{ asset('images/flags/'.$perfil->pais->ruta) }}" alt="pais" width="30"></small>
                                </div>
                            </div>
                          <div class="card-text text-truncate mt-3 m-md-0">
                            {!! $perfil->descripcion !!}                          
                          </div>
                        </div>
                      </div>
                    </div>
                </div>  
            </div>
            @empty
            <div class="col-12">
                <h1 class="text-muted">No hay resultados</h1>
            </div>
            @endforelse
        </div>
        {{-- Paginación --}}
        <div class="row">
            <div class="col-12 d-flex justify-content-start justify-content-md-center  mb-5 overflow-auto">
                {{ $perfiles->withQueryString()->links('vendor.pagination.bootstrap-4') }}
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        $(function () {
            $('[data-toggle="tooltip"]').tooltip()
        })
    </script>
@endsection
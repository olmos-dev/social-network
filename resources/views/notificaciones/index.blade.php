@extends('layouts.app')

@section('estilos')
    <style>
        .enlace{
            color: #006699!important;
        }
        .enlace:hover{
            color: #6c757d!important;
        }
        .eliminar{
            color: red!important;
            background: none;
            padding: 0;
            border: none;
            font-size: 20px;
        }
        .eliminar:hover{
            text-decoration: underline;
        }
    </style>
@endsection

{{-- Vista de las notificaciones de las solicitudes de amistad--}}
@section('content')
    <div class="container margen-principal">
        <div class="row justify-content-center">
            <div class="col-12 col-md-6">
                <div class="card shadow mb-3">
                    <div class="card-header h5">
                        Notificaciones
                    </div>
                    <ul class="list-group">
                        {{-- Se muestran las notificaciones --}}
                        @forelse ($notificaciones as $notificacion)
                        <li class="list-group-item d-flex justify-content-between">
                            <a href="{{ route('comunidad.show',['perfil' => $notificacion->data['slug']]) }}" class="enlace"><i class="fas fa-user-plus"></i><span class="text-capitalize"> {{ $notificacion->data['nombre'] }}</span> te envió una solicitud de amistad - <small>{{ $notificacion->created_at->diffForHumans()}}</small></a>
                            {{-- se elimina la notificación --}}
                            <form action="{{ route('delete.notificaciones',['id' => $notificacion->id] ) }}" method="POST">
                                @method('delete')
                                @csrf
                                <button type="submit" class="eliminar" data-toggle="tooltip" data-placement="top" title="eliminar">&times;</button>
                            </form>
                        </li>
                        @empty
                            <li class="list-group-item text-muted">No hay notificaciones</li>
                        @endforelse
                      </ul>
                </div>
            </div>
        </div>
    </div>
@endsection
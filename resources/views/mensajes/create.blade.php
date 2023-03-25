@extends('layouts.app')

@section('estilos')
    <style>
        .enlace{
            color: black!important;
        }
        .panel{
            height:350px;
            overflow-y: auto
        }
        .chat-box-emisor{
            background: rgb(237, 237, 245)
        }  
        .chat-box-receptor{
            background: rgb(237, 237, 245)
        }
        .fecha{
            font-size: 11px;
        }  
          
    </style>
@endsection

@section('content')
    <div class="container margen-principal">
        <div class="row justify-content-center">
            <div class="col-12 col-md-6">
                <form action="{{ route('mensajes.store',['perfil' => $receptor->slug]) }}" method="POST">
                    @csrf
                    <div class="card shadow mb-5">
                        <div class="card-header d-flex justify-content-between">
                        @if ($receptor->foto != null)
                            <a href="{{ route('comunidad.show',['perfil' => $receptor->slug]) }}" class="text-capitalize enlace font-weight-bold"><img src="{{ asset('storage/'.$receptor->foto) }}" alt="foto de receptor" class="rounded-circle" width="50" height="50"> {{ $receptor->usuario->name }}</a>
                            @php
                                $valor = rand(0,1);
                            @endphp
                            @if ($valor == 1)
                                <small class="text-muted">En línea</small>    
                            @else
                                <small class="text-muted">Deconectado</small>
                            @endif
                        @else
                        <a href="{{ route('comunidad.show',['perfil' => $receptor->slug]) }}" class="text-capitalize enlace font-weight-bold"><img src="{{ asset('images/profiles/profile.png') }}" alt="foto de receptor" class="rounded-circle" width="50" height="50"> {{ $receptor->usuario->name }}</a>
                        @endif                              
                        </div>
                        <div class="card-body panel" id="chat-box">
                            @foreach ($mensajes as $mensaje)
                            <div class="row m-0">
                                @if (auth()->user()->id == $mensaje->emisor_id)
                                    <div class="col-12">
                                        <small class="font-weight-bold text-capitalize">Tú</small>
                                    </div>
                                    <div class="col-12 chat-box-emisor my-1 pt-3 d-flex justify-content-between">
                                        <p>{{ $mensaje->texto }}</p>
                                    </div>
                                    <div class="col-12 d-flex justify-content-end">
                                        <small class="text-muted fecha text-center">{{ $mensaje->created_at->format('d-m-Y H:m') }}</small>
                                    </div>
                                @else
                                    <div class="col-12">
                                        <small class="font-weight-bold text-capitalize">{{ $receptor->usuario->name }}</small>
                                    </div>
                                    <div class="col-12 bg-primary my-1 pt-3 d-flex justify-content-between">
                                        <p class="text-white">{{ $mensaje->texto }}</p>
                                    </div>
                                    <div class="col-12 d-flex justify-content-end">
                                        <small class="text-muted fecha text-center">{{ $mensaje->created_at->format('d-m-Y H:m') }}</small>
                                    </div>
                                @endif
                            </div>
                            @endforeach
                        </div>
                        <div class="card-footer">
                            <div class="input-group mb-3">
                            <textarea name="mensaje" id="mensaje" cols="30" rows="1" class="form-control" required style="overflow: auto"></textarea>
                                <div class="input-group-append">
                                    <button class="btn btn-primary"><i class="fas fa-paper-plane"></i></button>
                                </div>
                              </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        $(document).ready(function () {
            $('#chat-box').scrollTop($('#chat-box')[0].scrollHeight);
        });
    </script>
@endsection
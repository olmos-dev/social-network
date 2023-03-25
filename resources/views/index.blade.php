@extends('layouts.app')

@section('estilos')
    <link rel="stylesheet" href="{{ asset('css/estilos.css') }}">
@endsection

@section('content')
    <header class="hero">
        <div class="container-fluid h-100">
            <div class="row h-100">
                <div class="col-12 h-auto align-self-center text-center fondo-transparente p-5">
                    <h1>Red social</h1>
                    <p>Bienvenido a la red social mas popular de internet. 
                     Conectate con las personas que más quieres. Es gratuito y fácil de usar.
                    </p>
                </div>
            </div>
        </div>
    </header>
@endsection
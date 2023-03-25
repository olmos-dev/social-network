<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>Red Social</title>

        <!-- Fonts -->
        <link href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

        <!-- Styles -->
        <link rel="stylesheet" href="{{ asset('css/plugins/bootstrap.min.css') }}">
        <link rel="stylesheet" href="{{ asset('css/plugins/all.min.css') }}">
        <link rel="stylesheet" href="{{ asset('css/estilos.css') }}">
        
        @vite('resources/css/app.css')
        
        @yield('estilos')
    </head>
    
    <body class="fondo">
        <div id="app">
            @include('components.menu')
            <main>
                @yield('content')
            </main>
        </div>

        <script src="{{ asset('js/plugins/jquery-3.6.1.min.js') }}"></script>
        <script src="{{ asset('js/plugins/popper.min.js') }}"></script>
        <script src="{{ asset('js/plugins/bootstrap.min.js') }}"></script>
        <script src="{{ asset('js/plugins/all.min.js') }}"></script>    

        @vite('resources/js/app.js')
        
        @yield('scripts')
        
        
    </body>
</html>

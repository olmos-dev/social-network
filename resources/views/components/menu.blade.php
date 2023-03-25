<nav class="navbar navbar-expand-lg navbar-dark fondo-color fixed-top">
  <div class="container">
    <a class="navbar-brand" href="{{ route('index') }}">Red Social</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav ml-auto">
        @if (Route::has('login'))
        @auth
            <li class="nav-item">
              <a href="{{ route('comunidad.index') }}" class="nav-link"><i class="fas fa-users"></i> Comunidad</a>
            </li>
            {{-- Componente de vue para las notificaciones de los mensajes--}}
            <mensajes-notificaciones></mensajes-notificaciones>
            <li class="nav-item">
              <a href="{{ route('amigos.index') }}" class="nav-link"><i class="fas fa-user-friends"></i> Amigos</a>
            </li>
            <li class="nav-item">
              <a href="{{ route('buscar.index') }}" class="nav-link"><i class="fas fa-search"></i> Buscar</a>
            </li>
            {{-- Componente de vue para las notificaciones de las solicitudes de amistad --}}
            <notificaciones></notificaciones>
            <li class="nav-item dropdown">
              <a href="#" class="nav-link dropdown-toggle" role="button" data-toggle="dropdown" aria-expanded="false">
                <i class="fas fa-user"></i> {{ auth()->user()->name }}
              </a>
              <div class="dropdown-menu">
                <a href="{{ route('perfil.show',['perfil' => auth()->user()->perfil->slug]) }}" class="dropdown-item"><i class="fas fa-user text-color"></i> Mi perfil</a>
                <a href="{{ route('cuenta.index') }}" class="dropdown-item"><i class="fas fa-user-circle text-color"></i> Cuenta</a>
                <div class="dropdown-divider"></div>
                <form action="{{ route('logout') }}" method="POST">
                  @csrf
                  <button type="submit" class="dropdown-item"><i class="fas fa-sign-out-alt text-color"></i> Cerrar sesión</button>
                </form>
              </div>
            </li>
        @else
            <li class="nav-item">
                <a class="nav-link" href="{{ route('login') }}">Iniciar sesión</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('register') }}">Registrar</a>
            </li>
        @endauth
    @endif
      </ul>
    </div>
  </div>
</nav>
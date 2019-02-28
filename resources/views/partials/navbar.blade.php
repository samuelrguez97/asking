<div class="content">
    <nav class="navbar navbar-expand-md navbar-dark colorBackground">
        <div class="navbar-collapse collapse w-100 order-1 order-md-0 dual-collapse2">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item {{ Request::is('home') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ action('PreguntasControlador@principal') }}">Inicio</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown"
                        aria-haspopup="true" aria-expanded="false">
                        Preguntas
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="#">Preguntas más recientes</a>
                        <a class="dropdown-item" href="#">Preguntas con más likes</a>
                        <a class="dropdown-item" href="#">Preguntas sobre un tema</a>
                    </div>
                </li>
                @if( Auth::check() )
                <li class="nav-item {{ Request::is('perfil') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ action('UsuariosControlador@getPerfil') }}">Perfil</a>
                </li>
                <li class="nav-item">
                    <form action="{{ url('/logout') }}" method="POST" style="display:inline">
                        {{ csrf_field() }}
                        <button type="submit" class="btn btn-link nav-link" style="display:inline;cursor:pointer">Cerrar
                            sesión</button>
                    </form>
                </li>
                @else
                <li class="nav-item {{ Request::is('register') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ url('/register') }}">Registrarse</a>
                </li>
                @endif
            </ul>
        </div>
        <div class="mx-auto order-0 logo_redim">
            <a href="{{ action('PreguntasControlador@principal') }}"><img src="{{ url('imagenes/logo.png') }}" alt="logo"></a>
        </div>
        <div class="navbar-collapse collapse w-100 order-3 dual-collapse2">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item searchbar">
                    <input class="search_input" type="text" name="buscador" id="buscador" placeholder="Buscar usuario...">
                    <a class="search_icon" href="#"><i class="fas fa-search"></i></a>
                </li>
            </ul>
        </div>
    </nav>
</div>

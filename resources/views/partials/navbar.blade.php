<nav class="sticky-top sticky-top-ie">
    <div class="row">
        <div class="col-md-8 offset-md-2">
            <nav class="navbar-home navbar-expand-lg navbar-dark borde-nav colorBackground p-2">
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsingNavbarLg">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="navbar-collapse collapse order-1 order-md-0 dual-collapse2" id="collapsingNavbarLg">
                    <a class="mr-3" href="{{ action('PreguntasControlador@principal') }}"><img
                            src="{{ url('imagenes/logo.png') }}" alt="logo"></a>
                    <ul class="navbar-nav">
                        <li class="nav-item {{ Request::is('home') ? 'active' : '' }}">
                            <a class="nav-link" href="{{ action('PreguntasControlador@principal') }}">Inicio</a>
                        </li>
                        <li class="nav-item {{ Request::is('contacto') ? 'active' : '' }}">
                            <a class="nav-link" href="{{ action('UsuariosControlador@getContacto') }}">Contacto</a>
                        </li>
                        @if( Auth::check() )
                        <li class="nav-item {{ Request::is('perfil') ? 'active' : '' }}">
                            <a class="nav-link" href="{{ action('UsuariosControlador@getPerfil') }}">Perfil</a>
                        </li>
                        <li class="nav-item">
                            <form action="{{ url('/logout') }}" method="POST" style="display:inline">
                                {{ csrf_field() }}
                                <button type="submit" class="btn btn-link nav-link">Cerrar
                                    sesión</button>
                            </form>
                        </li>
                        @else
                        <li class="nav-item {{ Request::is('login') ? 'active' : '' }}">
                            <a class="nav-link" href="{{ url('/login') }}">Entrar</a>
                        </li>
                        <li class="nav-item {{ Request::is('register') ? 'active' : '' }}">
                            <a class="nav-link" href="{{ url('/register') }}">Registrarse</a>
                        </li>
                        @endif
                    </ul>
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item searchbar">
                            <input class="search_input" type="text" name="buscador" id="buscador"
                                placeholder="Buscar usuario o tema...">
                            <a class="search_icon" href="#"><i class="fas fa-search"></i></a>
                        </li>
                    </ul>
                </div>

            </nav>
        </div>
    </div>
</nav>

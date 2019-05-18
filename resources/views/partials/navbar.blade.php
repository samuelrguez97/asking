<nav class="sticky-top sticky-top-ie">
    <div class="row">
        <div class="col-md-10 offset-md-1">
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
                        <li
                            class="nav-item dropdown {{ Request::is('perfil') || Request::segment(1) == 'perfil-publico' && Request::segment(2) == Auth::user()->name ? 'active' : '' }}">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Perfiles
                            </a>
                            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <a class="nav-link dropdown-item"
                                    href="{{ action('UsuariosControlador@getPerfil') }}">Perfil</a>
                                <a class="nav-link dropdown-item"
                                    href="{{ action('UsuariosControlador@getPerfilPublico', ['nombre' => Auth::user()->name]) }}">Perfil
                                    público</a>
                            </div>
                        </li>
                        <li class="nav-item {{ Request::is('tus-preguntas') ? 'active' : '' }}">
                            <a class="nav-link" href="{{ action('UsuariosControlador@tusPreguntas') }}">Tus preguntas
                                <span
                                    class="badge badge-success">{{ isset($nTusPreguntas) ? $nTusPreguntas : '' }}</span></a>
                        </li>
                        <li class="nav-item">
                            <form action="{{ url('/logout') }}" method="POST" class="form-nav">
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
                        <li class="nav-item">
                            <form action="{{ action('UsuariosControlador@buscar') }}" method="POST" class="form-nav">
                                {{ csrf_field() }}
                                <div class="searchbar">
                                    <input class="search_input" type="text" name="buscador" id="buscador"
                                        placeholder="Buscar usuario o tema...">
                                    <a class="search_icon" href="#"><i class="fas fa-search"></i></a>
                                </div>
                            </form>
                        </li>
                    </ul>
                </div>

            </nav>
        </div>
    </div>
</nav>

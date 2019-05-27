<nav class="sticky-top sticky-top-ie">
    <div class="row">
        <div class="col-md-9 mx-auto">
            <nav class="navbar-home navbar-expand-lg navbar-dark borde-nav colorBackground p-2">
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsingNavbarLg">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <a class="mr-3 float-left mt-logo-nav" href="{{ action('PreguntasControlador@principal') }}"><img
                        src="{{ url('imagenes/logo.png') }}" alt="logo"></a>
                <div class="navbar-collapse collapse order-1 order-md-0 dual-collapse2" id="collapsingNavbarLg">
                    <ul class="navbar-nav">
                        <li class="nav-item {{ Request::is('home') ? 'active' : '' }}">
                            <a class="nav-link" href="{{ action('PreguntasControlador@principal') }}"><i
                                    class="fas fa-home"></i> Inicio</a>
                        </li>
                        <li class="nav-item {{ Request::is('contacto') ? 'active' : '' }}">
                            <a class="nav-link" href="{{ action('UsuariosControlador@getContacto') }}"><i
                                    class="fas fa-envelope"></i> Contacto</a>
                        </li>
                        @if( Auth::check() )
                        <li class="nav-item {{ Request::is('perfil') ? 'active' : '' }}">
                            <a class="nav-link" href="{{ action('UsuariosControlador@getPerfil') }}"><img
                                    src="{{ url('storage/imagenes/usuarios') }}/{{ Auth::user()->avatar }}"
                                    class="rounded mr-1 float-left nav-img-perfil" alt="avatar"> Perfil</a>
                        </li>
                        <li class="nav-item {{ Request::is('tus-preguntas') ? 'active' : '' }}">
                            <a class="nav-link" href="{{ action('UsuariosControlador@tusPreguntas') }}"><i
                                    class="fas fa-question-circle"></i> Tus preguntas <span class="badge badge-success">{{ isset($nTusPreguntas) ? $nTusPreguntas : '' }}</span></a>
                        </li>
                        <li class="nav-item">
                            <form action="{{ url('/logout') }}" method="POST" class="form-nav">
                                {{ csrf_field() }}
                                <button type="submit" class="btn btn-link nav-link"><i class="fas fa-sign-out-alt"></i>
                                    Cerrar
                                    sesión</button>
                            </form>
                        </li>
                        @else
                        <li class="nav-item {{ Request::is('login') ? 'active' : '' }}">
                            <a class="nav-link" href="{{ url('/login') }}"><i class="fas fa-sign-in-alt"></i> Entrar</a>
                        </li>
                        <li class="nav-item {{ Request::is('register') ? 'active' : '' }}">
                            <a class="nav-link" href="{{ url('/register') }}"><i class="fas fa-door-open"></i>
                                Registrarse</a>
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

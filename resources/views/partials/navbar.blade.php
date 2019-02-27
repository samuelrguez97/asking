<div class="content">
    <nav class="navbar navbar-expand-md navbar-dark colorBackground">
        <div class="navbar-collapse collapse w-100 order-1 order-md-0 dual-collapse2">
            <ul class="navbar-nav mr-auto">
                @if( Auth::check() )
                <li class="nav-item">
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
                <li class="nav-item">
                    <a class="nav-link" href="{{ url('/register') }}">Registrarse</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ action('PreguntasControlador@principal') }}">Volver al inicio</a>
                </li>
                @endif
            </ul>
        </div>
        <div class="mx-auto order-0 logo_redim">
            <a href="{{ action('PreguntasControlador@principal') }}"><img src="{{ url('imagenes/logo.png') }}" alt="logo"></a>
        </div>
        <div class="navbar-collapse collapse w-100 order-3 dual-collapse2">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <form class="form-inline my-2 my-lg-0">
                        <input class="form-control mr-sm-2" type="search" placeholder="Buscar usuario..." aria-label="Search">
                        <button class="btn btn-success my-2 my-sm-0" type="submit">Buscar</button>
                    </form>
                </li>
            </ul>
        </div>
    </nav>
</div>

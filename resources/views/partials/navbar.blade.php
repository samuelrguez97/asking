<div class="content">
<nav class="navbar navbar-expand-md navbar-dark colorBackground">
    <div class="navbar-collapse collapse w-100 order-1 order-md-0 dual-collapse2">
        <ul class="navbar-nav mr-auto">
        @if( Auth::check() )
            <li class="nav-item active">
                <a class="nav-link" href="{{ action('UsuariosControlador@getPerfil') }}">Perfil</a>
            </li>
            <li class="nav-item">
                 <form action="{{ url('/logout') }}" method="POST" style="display:inline">
                    {{ csrf_field() }}
                    <button type="submit" class="btn btn-link nav-link" style="display:inline;cursor:pointer">Cerrar sesión</button>
                </form>
            </li>
        @else
            <li class="nav-item">
                <form action="{{ url('/logout') }}" method="POST" style="display:inline">
                    {{ csrf_field() }}
                    <button type="submit" class="btn btn-link nav-link" style="display:inline;cursor:pointer">Volver al inicio</button>
                </form>
            </li>
        @endif
        </ul>
    </div>
    <div class="mx-auto order-0 logo_redim">
        <img src="https://i.ibb.co/GQjFrd9/logo.png" alt="logo">
    </div>
    <div class="navbar-collapse collapse w-100 order-3 dual-collapse2">
        <ul class="navbar-nav ml-auto">
            <li class="nav-item">
                <form class="form-inline my-2 my-lg-0">
                    <input class="form-control mr-sm-2" type="search" placeholder="Buscar usuarios" aria-label="Search">
                    <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Buscar</button>
                </form>
            </li>
        </ul>
    </div>
</nav>
</div>

@extends('layouts.master')

@section('content')

@if( Session::has('error-busqueda') )
<aside class="col-md-8 offset-md-2 mt-4">
    <aside class="text-center alert alert-danger" role="alert">
        {{ session('error-busqueda') }}
    </aside>
</aside>
Session::forget('error-busqueda');
@endif

<div class="mt-5 row">

    <div class="col-md-8 offset-md-2">

        @include('partials/ask')

    </div>
    <div class="col-md-3 mx-auto text-center">
        @if( Session::has('success') )
        <aside class="mt-4 alert alert-success" role="alert">
            {{ session('success') }}
        </aside>
        Session::forget('success');
        @endif

        @if( Session::has('error') )
        <aside class="mt-4 alert alert-danger" role="alert">
            {{ session('error') }}
        </aside>
        Session::forget('error');
        @endif

        @if ($errors->any())
        <div class="mt-4 alert alert-danger">
            @foreach ($errors->all() as $error)
            @if ($loop->last)
            {{ $error }}
            @else
            {{ $error }}
            <hr />
            @endif
            @endforeach
        </div>
        @endif

    </div>
</div>

<hr class="hr-home" />

<div class="row mt-5">

    <div class="col-sm-8 offset-md-2">
        <h2 id="tituloPreguntas" class="letraTitulo">Preguntas</h2>
        <div class="mb-3 mt-3" role="group">
            <a class="text-white btn btn-info btn-sm mr-1" href="{{ action('PreguntasControlador@temasTodos') }}">Ver
                todos los temas</a>
            <a class="text-white btn btn-primary btn-sm" href="{{ action('UsuariosControlador@usuariosMasRespondidas') }}">Ver
                usuarios con más preguntas respondidas</a>
        </div>
        <div class="menu-preguntas">
            <ul class="float-left navbar-nav mr-auto">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle text-white" href="#" id="navbarDropdown" role="button"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Ordenar preguntas
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <a id="masRecientes" class="dropdown-item"
                            href="{{ action('PreguntasControlador@principal') }}?">Preguntas más
                            recientes</a>
                        <a id="masLikes" class="dropdown-item"
                            href="{{ action('PreguntasControlador@ordenarLikesHome') }}">Preguntas
                            con más likes</a>
                    </div>
                </li>
            </ul>
            <div class="float-right">
                <div class="mt-2 min-container">
                    <h6 class="float-left text-white">Ordenado por: </h6>
                    <aside class="ml-2 float-right text-ord">
                        @if( !empty($orden) )
                        {{ $orden }}
                        @else
                        Preguntas más recientes
                        @endif
                    </aside>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-10 offset-md-1">
        <div id="preguntas" class="show-preguntas">
            <div class="row mt-5">

                @if ( $preguntas->isEmpty() )
                <aside class="mx-auto mb-5 text-center alert alert-warning" role="alert">
                    <strong>¡Vaya!</strong> Parece que no hay preguntas ahora mismo ... ¡sé el primero en preguntar!
                </aside>
                @endif

                @include('partials.ask_external')

                @include('partials.see_answer')

            </div>
        </div>
    </div>

</div>


@endsection

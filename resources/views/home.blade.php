@extends('layouts.master')

@section('content')

<div class="mt-5 row">

    @if( Session::has('error-busqueda') )
    <aside class="col-6 mx-auto mb-3">
        <aside class="text-center alert alert-danger" role="alert">
            {{ session('error-busqueda') }}
        </aside>
    </aside>
    @endif

    @if( Session::has('success-perfil') )
    <aside class="col-6 mx-auto mb-3">
        <aside class="text-center alert alert-success" role="alert">
            {{ session('success-perfil') }}
        </aside>
    </aside>
    @endif

    <div class="col-md-8 offset-md-2">

        @include('partials/ask')

    </div>
    <div class="col-md-3 mx-auto text-center">
        @if( Session::has('success') )
        <div class="row">
            <aside class="mt-4 mx-auto alert alert-success" role="alert">
                {{ session('success') }}
            </aside>
        </div>
        @endif

        @if( Session::has('error') )
        <div class="row">
            <aside class="mt-4 mx-auto alert alert-danger" role="alert">
                {{ session('error') }}
            </aside>
        </div>
        @endif

        @if ($errors->any())
        <div class="row">
            <div class="mt-4 mx-auto alert alert-danger">
                @foreach ($errors->all() as $error)
                @if ($loop->last)
                {{ $error }}
                @else
                {{ $error }}
                <hr />
                @endif
                @endforeach
            </div>
        </div>
        @endif

    </div>
</div>

<hr class="hr-home" />

<div class="row mt-5">

    <div class="col-sm-8 mx-auto">
        <h2 id="tituloPreguntas" class="letraTitulo">Preguntas</h2>
        <div class="mb-3 mt-3" role="group">
            <a class="text-white btn btn-info btn-sm mr-1" href="{{ action('PreguntasControlador@temasTodos') }}"><i
                    class="fas fa-book-open"></i> Ver
                todos los temas</a>
            <a class="text-white btn btn-primary btn-sm"
                href="{{ action('UsuariosControlador@usuariosMasRespondidas') }}"><i class="fas fa-users"></i> Ver
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
    <div class="col-sm-8 mx-auto">
        <div class="row mt-5">

            @if ( $preguntas->isEmpty() )
            <div class="row">
                <aside class="mx-auto mb-5 text-center alert alert-warning" role="alert">
                    <strong>¡Vaya!</strong> Parece que no hay preguntas ahora mismo ... ¡sé el primero en preguntar!
                </aside>
            </div>
            @endif

            @include('partials.ask_external')

            @include('partials.see_answer')

        </div>
    </div>
</div>
@endsection

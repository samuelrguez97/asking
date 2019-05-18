@extends('layouts.master')

@section('content')

<div class="container-fluid w-fit-content h-fit-content">
    <div class="mt-5 row">
        <div class="col-md-6 offset-md-3">
            <h1 class="display-5 letraTitulo">Usuarios</h1>
            <h4 class="text-white">Ordenados por preguntas respondidas</h4>
            <div class="row mt-5">

                @if ( $usuarios->isEmpty() )
                <aside class="mx-auto col-sm-8 mt-4 text-center alert alert-warning" role="alert">
                    Lo sentimos, no hay preguntas con respuestas ahora mismo ...
                </aside>
                @else

                @foreach ($usuarios as $usuario)
                <div class="col-sm-4 mb-4">
                    <div class="media">
                        <img src="{{ url('storage/imagenes/usuarios') }}/{{ $usuario->avatar }}"
                            class="mr-3 img-thumbnail med-img-perfil" alt="avatar">

                        <div class="media-body">
                            <h5 class="mt-0 text-white">{{ $usuario->name }}</h5>
                            <p class="mt-0 text-white">Respondidas: {{ $usuario->respuestas }}</p>
                        </div>
                    </div>
                    <div class="btn-group mt-1" role="group">
                        <a class="btn btn-primary"
                            href="{{ action('UsuariosControlador@getPerfilPublico', ['nombre' => $usuario->name]) }}">
                            Ir a su perfil
                        </a>
                        <a class="btn btn-success"
                            href="{{ action('PreguntasControlador@sendPreguntaUser', ['user' => $usuario]) }}">Preguntar</a>
                    </div>
                </div>
                @endforeach

                @endif

            </div>
            <aside class="text-center">
                <a class="btn btn-info col-sm-1 mt-4 text-center" href="{{ url('home') }}">Inicio</a>
            </aside>
        </div>
    </div>
</div>

@endsection

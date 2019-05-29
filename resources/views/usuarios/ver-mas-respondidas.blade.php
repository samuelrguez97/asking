@extends('layouts.master')

@section('content')

<div class="container-fluid w-fit-content h-fit-content">
    <div class="mt-5 row">
        <div class="col-md-8 mx-auto">
            <h1 class="display-5 letraTitulo"><i class="fas fa-users"></i> Usuarios</h1>
            <h4 class="text-white">Ordenados por preguntas respondidas</h4>
            <div class="row mt-5">

                @if ( $usuarios->isEmpty() )
                <aside class="mx-auto col-sm-8 mt-4 text-center alert alert-warning" role="alert">
                    Lo sentimos, no hay preguntas con respuestas ahora mismo ...
                </aside>
                @else

                @foreach ($usuarios as $usuario)
                <div class="mb-4 mr-3">
                    <img src="{{ url('storage/imagenes/usuarios') }}/{{ $usuario->avatar }}"
                        class="mr-1 img-thumbnail med-img-perfil float-left" alt="avatar">
                        <h5 class="mb-0 text-white">{{ $usuario->name }}</h5>
                        <p class="mb-0 text-white">Respondidas: {{ $usuario->respuestas }}</p>
                    <div class="btn-group" role="group">
                        <a class="btn btn-primary"
                            href="{{ action('UsuariosControlador@getPerfilPublico', ['nombre' => $usuario->name]) }}"
                            data-toggle="tooltip" data-placement="bottom" title="Ir a su perfil">
                            <i class="fas fa-user"></i></a>
                        <a class="btn btn-success"
                            href="{{ action('PreguntasControlador@sendPreguntaUser', ['user' => $usuario]) }}"
                            data-toggle="tooltip" data-placement="bottom" title="Preguntar a este usuario"><i
                                class="fas fa-question-circle"></i></a>
                    </div>
                </div>
                @endforeach

                @endif

            </div>
            <aside class="text-center">
                <a class="btn btn-info mt-4 text-center" href="{{ url('home') }}"><i class="fas fa-home"></i> Inicio</a>
            </aside>
        </div>
    </div>
</div>

@endsection

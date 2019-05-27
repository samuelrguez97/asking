@extends('layouts.master')

@section('content')

<div class="container-fluid w-fit-content h-fit-content">
    <div class="mt-5 row">
        <div class="col-md-10 mx-auto">
            <h1 class="display-5 letraTitulo">Usuarios</h1>
            <div class="row mt-5">
                @foreach ($usuarios as $usuario)
                <div class="col-sm-3 mb-4">
                    <div class="media">
                        <img src="{{ url('storage/imagenes/usuarios') }}/{{ $usuario->avatar }}"
                            class="mr-3 img-thumbnail med-img-perfil mt-3" alt="avatar">
                        <div class="media-body">
                            <h5 class="mt-0 text-white">{{ $usuario->name }}</h5>
                            <div class="btn-group-vertical" role="group">
                                <a class="btn btn-primary"
                                    href="{{ action('UsuariosControlador@getPerfilPublico', ['nombre' => $usuario->name]) }}">
                                    <i class="fas fa-user"></i> Ir a su perfil
                                </a>
                                <a class="btn btn-success"
                                    href="{{ action('PreguntasControlador@sendPreguntaUser', ['user' => $usuario]) }}"><i class="fas fa-question"></i> Preguntar</a>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            <aside class="text-center">
                <a class="btn btn-info mt-4 text-center" href="{{ url('home') }}"><i class="fas fa-home"></i> Inicio</a>
            </aside>
        </div>
    </div>
</div>

@endsection

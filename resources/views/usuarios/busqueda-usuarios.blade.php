@extends('layouts.master')

@section('content')

<div class="container-fluid w-fit-content h-fit-content">
    <div class="mt-5 row">
        <div class="col-md-6 mx-auto">
            <h1 class="display-5 letraTitulo">Usuarios</h1>
            <div class="row mt-5">
                @foreach ($usuarios as $usuario)
                <div class="mb-4 mr-4">
                    <h5 class="mt-0 text-white">{{ $usuario->name }}</h5>
                    <img src="{{ url('storage/imagenes/usuarios') }}/{{ $usuario->avatar }}"
                        class="img-thumbnail med-img-perfil" alt="avatar">
                    <div class="clearfix"></div>
                    <div class="btn-group w-100" role="group">
                        <a class="btn btn-primary"
                            href="{{ action('UsuariosControlador@getPerfilPublico', ['nombre' => $usuario->name]) }}" data-toggle="tooltip" data-placement="bottom" title="Ir a su perfil">
                            <i class="fas fa-user"></i>
                        </a>
                        <a class="btn btn-success"
                            href="{{ action('PreguntasControlador@sendPreguntaUser', ['user' => $usuario]) }}" data-toggle="tooltip" data-placement="bottom" title="Preguntar a este usuario"><i
                                class="fas fa-question-circle"></i></a>
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

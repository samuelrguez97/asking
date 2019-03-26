@extends('layouts.master')

@section('content')

<div class="container-fluid w-fit-content h-fit-content">
    <div class="mt-5 row">
        <div class="col-md-9 offset-md-1">
            <h1 class="display-5 letraTitulo">Usuarios</h1>
            <div class="row mt-5">
                @foreach ($usuarios as $usuario)
                <div class="col-sm-4">
                    <div class="media mb-2">
                        <img src="{{ url('storage/imagenes/usuarios') }}/{{ $usuario->avatar }}"
                            class="mr-3 img-thumbnail w-25" alt="avatar">
                        <div class="media-body">
                            <h5 class="mt-0 text-white">{{ $usuario->name }}</h5>
                            <a class="btn btn-primary mb-3"
                                href="{{ action('UsuariosControlador@getPerfilPublico', ['nombre' => $usuario->name ]) }}">
                                    Ir a su perfil
                                </a>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</div>

@endsection

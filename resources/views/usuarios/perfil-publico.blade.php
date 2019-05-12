@extends('layouts.master')

@section('content')
<div class="container-fluid w-fit-content h-fit-content">
    @if( Session::has('respondida') )
    <aside class="mt-4 text-center alert alert-success" role="alert">
        {{ session('respondida') }}
    </aside>
    Session::forget('respondida');
    @endif
    <div class="mt-5 row">

        <!-- ZONA PARA MOSTRAR INFORMACIÓN DEL PERFIL PÚBLICO -->

        <div class="card-perfil col-md-3 offset-md-1">
            <div class="card fit-content">
                <img class="img-perfil" src="{{ url('storage/imagenes/usuarios') }}/{{ $usuario->avatar }}" />
                <table class="table mr-3">
                    <tr>
                        <th>Usuario</th>
                        <td>{{ $usuario->name }}</td>
                    </tr>
                    <tr>
                        <th>Fecha de creación</th>
                        <td>{{ $usuario->created_at->toDateString() }}</td>
                    </tr>
                </table>
            </div>
            <br />
            <div class="text-center">
                <div class="btn-group-vertical mb-3"  role="group">
                    <a class="btn btn-primary" href="{{ url('home') }}">Inicio</a>
                    @if (Auth::check() && Auth::user()->name == $usuario->name)
                    <a class="btn btn-info" href="{{ url('perfil') }}">Ir a tu perfil</a>
                    @endif
                    <a class="btn btn-success" href="{{ action('PreguntasControlador@sendPreguntaUser', ['user' => $usuario->name]) }}" >Hacer una pregunta a este usuario</a>
                </div>
            </div>
        </div>

        <div class="col-md-6 offset-md-1">

            <!-- ZONA DE PREGUNTAS AL USUARIO -->

            <h1 class="display-4 letraTitulo">Perfil público</h1>
            <h4 class="text-white">Preguntas para {{ $usuario->name }}</h4>

            @if ( $preguntas->isEmpty() )
            <aside class="mt-4 text-center alert alert-warning" role="alert">
                Éste usuario no tiene preguntas ahora mismo ...
            </aside>
            @else

            <div class="row mt-5">

                <!-- ZONA PARA METER LAS PREGUNTAS DESDE LA BASE DE DATOS-->

                @include('partials.ask_external')

                @include('partials.see_answer')

                @endif

                <!-- --------------------------------------------------- -->

            </div>
        </div>
    </div>
</div>
@endsection

@extends('layouts.master')

@section('content')
<div class="container-fluid w-fit-content h-fit-content">
    @if( Session::has('respondida') )
    <aside class="mt-4 text-center alert alert-success" role="alert">
        {{ session('respondida') }}
    </aside>
    Session::forget('respondida');
    @endif
    <div class="mt-5 pl-5 pr-5 mx-auto row">

        <!-- ZONA PARA MOSTRAR INFORMACIÓN DEL PERFIL PÚBLICO -->

        <div class="card-perfil col-md-4 mb-3">
            <div class="card fit-content">
                <img class="img-perfil" src="{{ url('storage/imagenes/usuarios') }}/{{ $usuario->avatar }}" />
                <table class="table">
                    <tr>
                        <td colspan="2" class="bg-perfil-info"><i class="fas fa-info-circle"></i> Información de la cuenta</td>
                    </tr>
                    <tr>
                        <th>Usuario</th>
                        <td>{{ $usuario->name }}</td>
                    </tr>
                    <tr>
                        <th>Fecha de creación</th>
                        <td>{{ $usuario->created_at->toDateString() }}</td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <div class="text-center">
                                <a class="btn btn-primary btn-block" href="{{ url('home') }}"><i
                                        class="fas fa-home"></i> Inicio</a>
                                @if (Auth::check() && Auth::user()->name == $usuario->name)
                                <a class="btn btn-info btn-block" href="{{ url('perfil') }}"><i class="fas fa-user"></i>
                                    Ir a tu perfil</a>
                                @endif
                                <a class="btn btn-success btn-block"
                                    href="{{ action('PreguntasControlador@sendPreguntaUser', ['user' => $usuario]) }}"><i
                                        class="fas fa-question-circle"></i> Hacer
                                    una pregunta a este usuario</a>
                            </div>
                        </td>
                    </tr>
                </table>
            </div>
        </div>

        <div class="col-md-8">

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

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

        <!-- ZONA PARA MOSTRAR INFORMACIÓN DEL PERFIL -->

        <div class="card-perfil col-md-3 offset-md-1">
            <div class="card fit-content">
                <img class="img-perfil" src="{{ url('storage/imagenes/usuarios') }}/{{ Auth::user()->avatar }}" />
                <table class="table mr-3">
                    <tr>
                        <th>Usuario</th>
                        <td>{{ Auth::user()->name }}</td>
                    </tr>
                    <tr>
                        <th>E-mail</th>
                        <td>{{ Auth::user()->email }}</td>
                    </tr>
                    <tr>
                        <th>Fecha de creación</th>
                        <td>{{ Auth::user()->created_at->toDateString() }}</td>
                    </tr>
                    <tr>
                        <th>Modificado por última vez</th>
                        <td>{{ Auth::user()->updated_at->toDateString() }}</td>
                    </tr>
                </table>
            </div>
            <br />
            <a class="btn btn-info mb-3" href="{{ action('UsuariosControlador@editPerfil') }}">Editar perfil</a>
            <a class="btn btn-primary mb-3"
                href="{{ action('UsuariosControlador@getPerfilPublico', ['nombre' => Auth::user()->name ]) }}">Tu perfil
                público</a>
            <a class="btn btn-secondary mb-3" href="{{ action('UsuariosControlador@tusPreguntasRespondidas') }}">Ver preguntas respondidas</a>
            @if( Session::has('success') )
            <aside class="mt-4 alert alert-success" role="alert">
                {{ session('success') }}
            </aside>
            Session::forget('success');
            @endif
            @if( Session::has('warning') )
            <aside class="mt-4 alert alert-warning" role="alert">
                {{ session('warning') }}
            </aside>
            Session::forget('warning');
            @endif
        </div>

        <div class="col-md-6 offset-md-1">

            <!-- ZONA DE PREGUNTAS AL USUARIO -->

            <h1 class="letraTitulo">Tus preguntas</h1>
            <h4 class="text-white">Preguntas realizadas para ti</h4>

            @if ( $preguntas_a_ti->isEmpty() )
            <aside class="mt-4 text-center alert alert-warning" role="alert">
                No tienes preguntas ahora mismo ...
            </aside>
            @else

            <div class="row mt-5">

                <!-- ZONA PARA METER LAS PREGUNTAS DESDE LA BASE DE DATOS-->

                @include('partials.ask_yours')

                @include('partials.respond_answer')

                <!-- --------------------------------------------------- -->

            </div>



            @if( Session::has('eliminada') )
            <aside class="mt-4 text-center alert alert-warning" role="alert">
                {{ session('eliminada') }}
            </aside>
            Session::forget('eliminada');
            @endif

            <div class="mb-5 text-center">
                <a class="btn btn-lg btn-success mr-2" href="{{ action('UsuariosControlador@tusPreguntas') }}">Ver todas</a>
            </div>

            @endif

            <hr />

            <!-- ZONA DE PREGUNTAS REALIZADAS -->

            <h1 class="letraTitulo">Preguntas realizadas</h1>
            <h4 class="text-white">Preguntas realizadas por ti</h4>

            @if ( $preguntas_por_ti->isEmpty() )
            <aside class="mt-4 text-center alert alert-warning" role="alert">
                No has realizado ninguna pregunta ...
            </aside>
            @else

            <div class="row mt-5">

                <!-- ZONA PARA METER LAS PREGUNTAS DESDE LA BASE DE DATOS-->

                @include('partials.ask_from_you')

                @include('partials.see_answer')

                <!-- --------------------------------------------------- -->

            </div>
            <div class="mb-5 text-center">
                <a class="btn btn-lg btn-success" href="{{ action('UsuariosControlador@preguntasRealizadas') }}">Ver
                    todas</a>
            </div>

            @endif

            <!-- Creo el formulario para actualizar los likes por ajax -->
            {!! Form::open(['route' => ['like', ':id_pregunta'], 'method' => 'LIKE', 'id' => 'form-like']) !!}
            {!! Form::close() !!}

        </div>
    </div>
</div>
@endsection

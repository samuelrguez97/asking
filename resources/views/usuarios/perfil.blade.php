@extends('layouts.master')

@section('content')

@if( Session::has('success') )
<div class="row">
    <aside class="col-4 offset-4 mt-4 alert alert-success text-center" role="alert">
        {{ session('success') }}
    </aside>
</div>
Session::forget('success');
@endif
@if( Session::has('warning') )
<div class="row">
    <aside class="col-4 offset-4 mt-4 alert alert-warning text-center" role="alert">
        {{ session('warning') }}
    </aside>
</div>
Session::forget('warning');
@endif
@if( Session::has('respondida') )
<div class="row">
    <aside class="col-4 offset-4 mt-4 alert alert-success text-center" role="alert">
        {{ session('respondida') }}
    </aside>
</div>
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
        <div class="text-center">
            <div class="btn-group-vertical mb-3" role="group">
                <a class="btn btn-info" href="{{ action('UsuariosControlador@editPerfil') }}">Editar perfil</a>
                <a class="btn btn-primary"
                    href="{{ action('UsuariosControlador@getPerfilPublico', ['nombre' => Auth::user()->name ]) }}">Tu
                    perfil
                    público</a>
                <a class="btn btn-secondary" href="{{ action('UsuariosControlador@tusPreguntasRespondidas') }}">Ver
                    preguntas respondidas</a>
            </div>
        </div>
    </div>

    <div class="col-md-6 offset-md-1">

        <!-- ZONA DE PREGUNTAS AL USUARIO -->

        <h1 class="letraTitulo">Tus preguntas</h1>
        <h4 class="text-white">Preguntas realizadas para ti</h4>

        @if ( $preguntas_a_ti->isEmpty() )
        <aside class="mt-4 col-6 offset-3 text-center alert alert-warning" role="alert">
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
        <aside class="mt-4 col-6 offset-3 text-center alert alert-warning" role="alert">
            {{ session('eliminada') }}
        </aside>
        Session::forget('eliminada');
        @endif

        <div class="mb-5 text-center">
            <a class="btn btn-lg btn-success mr-2" href="{{ action('UsuariosControlador@tusPreguntas') }}">Ver
                todas</a>
        </div>

        @endif

        <hr />

        <!-- ZONA DE PREGUNTAS REALIZADAS -->

        <h1 class="letraTitulo">Preguntas realizadas</h1>
        <h4 class="text-white">Preguntas realizadas por ti</h4>

        @if ( $preguntas_por_ti->isEmpty() )
        <aside class="mt-4 col-6 offset-3 text-center alert alert-warning" role="alert">
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

    </div>
</div>
@endsection

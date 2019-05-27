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
                <tr>
                    <td colspan="2">
                        <div class="text-center">
                                <a class="btn btn-info btn-block" href="{{ action('UsuariosControlador@editPerfil') }}">Editar
                                    perfil</a>
                                <a class="btn btn-primary btn-block"
                                    href="{{ action('UsuariosControlador@getPerfilPublico', ['nombre' => Auth::user()->name ]) }}">Tu
                                    perfil
                                    público</a>
                                <a class="btn btn-success btn-block" href="{{ action('UsuariosControlador@tusPreguntas') }}">Ver
                                    preguntas para ti
                                </a>
                                <a class="btn btn-secondary btn-block"
                                    href="{{ action('UsuariosControlador@tusPreguntasRespondidas') }}">Ver
                                    preguntas respondidas</a>
                        </div>
                    </td>
                </tr>
            </table>
        </div>
    </div>

    <div class="col-md-6 offset-md-1">

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

        @endif

    </div>
</div>
@endsection

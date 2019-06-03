@extends('layouts.master')

@section('content')

<div class="container-fluid w-fit-content h-fit-content">

    @if( Session::has('success') )
    <div class="row">
        <aside class="mx-auto mt-4 alert alert-success text-center" role="alert">
            {{ session('success') }}
        </aside>
    </div>
    @endif
    @if( Session::has('danger') )
    <div class="row">
        <aside class="mx-auto mt-4 alert alert-danger text-center" role="alert">
            {{ session('danger') }}
        </aside>
    </div>
    @endif
    <div class="row pl-5 pr-5 mx-auto mt-5">

        <!-- ZONA PARA MOSTRAR INFORMACIÓN DEL PERFIL -->

        <div class="card-perfil col-md-4 mb-3">
            <div class="card fit-content">
                <img class="img-perfil" src="{{ url('storage/imagenes/usuarios') }}/{{ Auth::user()->avatar }}" />
                <table class="table">
                    <tr>
                        <td colspan="2" class="bg-perfil-info"><i class="fas fa-info-circle"></i> Información de la
                            cuenta</td>
                    </tr>
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
                        <td colspan="2" class="bg-perfil-info">
                            <div class="mb-2"><i class="fas fa-user-cog"></i> Opciones de cuenta<i id="opciones-cuenta"
                                    class="fas fa-sort-down fa-lg float-right" data-toggle="tooltip"
                                    data-placement="left" title="Mostrar las opciones"></i></div>
                            <div id="opciones" style="display: none;" class="text-center">
                                <a class="btn btn-info btn-block"
                                    href="{{ action('UsuariosControlador@editPerfil') }}"><i
                                        class="fas fa-user-edit"></i> Editar
                                    perfil</a>
                                <a class="btn btn-primary btn-block"
                                    href="{{ action('UsuariosControlador@getPerfilPublico', ['nombre' => Auth::user()->name ]) }}"><i
                                        class="fas fa-users"></i> Tu
                                    perfil
                                    público</a>
                                <a class="btn btn-success btn-block"
                                    href="{{ action('UsuariosControlador@tusPreguntas') }}"><i class="far fa-eye"></i>
                                    Ver
                                    preguntas para ti
                                </a>
                                <a class="btn btn-secondary btn-block"
                                    href="{{ action('UsuariosControlador@tusPreguntasRespondidas') }}"><i
                                        class="far fa-eye"></i> Ver
                                    preguntas respondidas</a>
                                <a tabindex="0" data-placement="top" class="btn btn-danger btn-block text-white"
                                    data-trigger="focus" data-toggle="popover" data-html="true"
                                    data-content="¿Está seguro de que desea eliminar la cuenta?<br><a href='{{ action('UsuariosControlador@eliminarCuenta') }}'>Eliminar</a>"><i
                                        class="fas fa-user-times"></i> Eliminar cuenta</a>
                            </div>
                        </td>
                    </tr>
                </table>
            </div>
        </div>

        <div class="col-md-8">

            <!-- ZONA DE PREGUNTAS REALIZADAS -->

            <h1 class="letraTitulo">Preguntas realizadas</h1>
            <h4 class="text-white">Preguntas realizadas por ti</h4>

            @if ( $preguntas_por_ti->isEmpty() )
            <div class="row">
                <aside class="mt-4 mx-auto text-center alert alert-warning" role="alert">
                    No has realizado ninguna pregunta ...
                </aside>
            </div class="row">
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
</div>
@endsection

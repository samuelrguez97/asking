@extends('layouts.master')

@section('content')
<div class="container-fluid w-fit-content h-fit-content">
    <div class="mt-5 row">

        <div class="col-md-2.5 offset-md-1">
            <div class="card fit-content">
                @if ( Auth::user()->img )
                <img src="{{ Auth::user()->img }}" />
                @else
                <img src="{{ url('imagenes/usuarios/default.png') }}" />
                @endif
                <table class="table">
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
            <div>
                <button type="button" class="btn btn-info" action="#">Editar perfil</button>
            </div>
        </div>

        <div class="col-md-5 offset-md-1">

            <!-- ZONA DE PREGUNTAS AL USUARIO -->

            <h1 class="display-4 letraTitulo">Tus preguntas</h1>
            <h4 class="text-white">Preguntas realizadas para ti</h4>


            <!-- ZONA PARA METER LAS PREGUNTAS DESDE LA BASE DE DATOS-->


            <!-- --------------------------------------------------- -->

            <div class="row mt-5">
                <div class="col-sm-6 mb-5">
                    <div class="card text-white bg-secondary">
                        <div class="card-body">
                            <h6 class="card-text ml-3 texto-pregunta">Pregunta</h6>
                            <button href="" class="float-right btn btn-sm btn-outline-light ml-2 mt-1"> <i class="fa fa-reply"></i>
                                Responder</button>
                            <div class="mt-3 ml-3">
                                <img class="float-left" src="{{ url('imagenes/preguntas/mg_t.png') }}" />
                                <aside class="float-left ml-2">32</aside>
                            </div>
                        </div>
                        <div class="card-footer">
                            <aside class="float-left">hace 20 minutos</aside>
                            <div class="text-right float-right mt-1">
                                <a href=""><i class="fa fa-times text-danger" aria-aside="Close" data-toggle="tooltip"
                                        data-placement="right" title="Eliminar pregunta"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 mb-5">
                    <div class="card text-white bg-secondary">
                        <div class="card-body">
                            <span class="float-right badge badge-success ml-3 mb-2">Nueva</span>
                            <h6 class="card-text ml-3 texto-pregunta">de jajas xd</h6>
                            <button action="" class="float-right btn btn-sm btn-outline-light ml-2  mt-1"> <i class="fa fa-reply"></i>
                                Responder</button>
                            <div class="mt-3 ml-3">
                                <img class="float-left" src="{{ url('imagenes/preguntas/mg_t.png') }}" />
                                <aside class="float-left ml-2">14</aside>
                            </div>
                        </div>
                        <div class="card-footer">
                            <aside class="float-left">hace 1 hora</aside>
                            <div class="text-right float-right mt-1">
                                <a href=""><i class="fa fa-times text-danger" aria-aside="Close" data-toggle="tooltip"
                                        data-placement="right" title="Eliminar pregunta"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 mb-5">
                    <div class="card text-white bg-secondary">
                        <div class="card-body">
                            <h6 class="card-text ml-3 texto-pregunta">preuba 2</h6>
                            <button href="" class="float-right btn btn-sm btn-outline-light ml-2 mt-1"> <i class="fa fa-reply"></i>
                                Responder</button>
                            <div class="mt-3 ml-3">
                                <img class="float-left" src="{{ url('imagenes/preguntas/mg_t.png') }}" />
                                <aside class="float-left ml-2">32</aside>
                            </div>
                        </div>
                        <div class="card-footer">
                            <aside class="float-left">hace 10 minutos</aside>
                            <div class="text-right float-right mt-1">
                                <a href=""><i class="fa fa-times text-danger" aria-aside="Close" data-toggle="tooltip"
                                        data-placement="right" title="Eliminar pregunta"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 mb-5">
                    <div class="card text-white bg-secondary">
                        <div class="card-body">
                            <h6 class="card-text ml-3 texto-pregunta">preuba 42</h6>
                            <button href="" class="float-right btn btn-sm btn-outline-light ml-2 mt-1"> <i class="fa fa-reply"></i>
                                Responder</button>
                            <div class="mt-3 ml-3">
                                <img class="float-left" src="{{ url('imagenes/preguntas/mg_t.png') }}" />
                                <aside class="float-left ml-2">32</aside>
                            </div>
                        </div>
                        <div class="card-footer">
                            <aside class="float-left">hace 10 minutos</aside>
                            <div class="text-right float-right mt-1">
                                <a href=""><i class="fa fa-times text-danger" aria-aside="Close" data-toggle="tooltip"
                                        data-placement="right" title="Eliminar pregunta"></i></a>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
            <div class="mb-5 text-center">
                <button class="btn btn-lg btn-success">Ver todas</button>
            </div>

            <hr/>

            <!-- ZONA DE PREGUNTAS REALIZADAS -->

            <h1 class="display-4 letraTitulo">Preguntas realizadas</h1>
            <h4 class="text-white">Preguntas realizadas por ti</h4>

            <!-- ZONA PARA METER LAS PREGUNTAS DESDE LA BASE DE DATOS-->


            <!-- --------------------------------------------------- -->

            <div class="row mt-5">
                <div class="col-sm-6 mb-5">
                    <div class="card text-white bg-secondary">
                        <div class="card-header">
                            <div class="pregunta-user">
                                <aside class="float-left">
                                    <span>Para: </span><span class="letraTitulo">gabri</span>
                                </aside>
                                <aside class="float-right">
                                    <button class="btn btn-secondary btn-sm">Ver respuesta</button>
                                </aside>
                            </div>
                        </div>
                        <div class="card-body">
                            <h6 class="card-text ml-3 texto-pregunta">Pregunta</h6>
                        </div>
                        <div class="card-footer">
                            <aside class="float-left">hace 20 minutos</aside>
                            <div class="float-right ml-3">
                                <a class="like" href=""><img class="float-left" src="{{ url('imagenes/preguntas/mg_f.png') }}" /></a>
                                <aside class="float-left ml-2">32</aside>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-sm-6 mb-5">
                    <div class="card text-white bg-secondary">
                        <div class="card-header">
                            <div class="pregunta-user">
                                <aside class="float-left">
                                    <span>Para: </span><span class="letraTitulo">gabri</span>
                                </aside>
                                <aside class="float-right">
                                    <span class="text-white">No hay respuesta todavía</span>
                                </aside>
                            </div>
                        </div>
                        <div class="card-body">
                            <h6 class="card-text ml-3 texto-pregunta">Pregunta</h6>
                        </div>
                        <div class="card-footer">
                            <aside class="float-left">hace 20 minutos</aside>
                            <div class="float-right ml-3">
                                <a class="like" href=""><img class="float-left" src="{{ url('imagenes/preguntas/mg_f.png') }}" /></a>
                                <aside class="float-left ml-2">32</aside>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
            <div class="mb-5 text-center">
                <button class="btn btn-lg btn-success">Ver todas</button>
            </div>
        </div>
    </div>
</div>
@endsection

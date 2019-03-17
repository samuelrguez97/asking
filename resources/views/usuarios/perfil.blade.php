@extends('layouts.master')

@section('content')
<div class="container-fluid">
    <div class="mt-5 row">

        <div class="col-md-2.5 offset-md-1">
            <div class="card">
                @if ( Auth::user()->img )
                <img src="{{ Auth::user()->img }}" />
                @else
                <img class="imagen-user" src="{{ url('imagenes/usuarios/default.png') }}" />
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
                </table>
            </div>
            <br />
            <div>
                <button type="button" class="btn btn-info" action="#">Editar perfil</button>
            </div>
        </div>

        <div class="col-md-5 offset-md-1">

            <h1 class="display-4 letraTitulo">Tus preguntas</h1>


            <!-- ZONA PARA METER LAS PREGUNTAS DESDE LA BASE DE DATOS-->


            <!-- --------------------------------------------------- -->

            <div class="row mt-5">
                <div class="col-sm-6 mb-5">
                    <div class="card text-white bg-secondary">
                        <div class="card-body">
                            <h6 class="card-text ml-3 texto-pregunta">Pregunta</h6>
                            <button href="" class="float-right btn btn-sm btn-outline-light ml-2 mt-1"> <i class="fa fa-reply"></i> Responder</button>
                            <div class="mt-3 ml-3">
                                <img class="float-left" src="{{ url('imagenes/preguntas/mg_t.png') }}" /><aside class="float-left ml-2">32</aside>
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
                            <button action="" class="float-right btn btn-sm btn-outline-light ml-2  mt-1"> <i class="fa fa-reply"></i> Responder</button>
                            <div class="mt-3 ml-3">
                                <img class="float-left" src="{{ url('imagenes/preguntas/mg_t.png') }}" /><aside class="float-left ml-2">14</aside>
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
                                <button href="" class="float-right btn btn-sm btn-outline-light ml-2 mt-1"> <i class="fa fa-reply"></i> Responder</button>
                            <div class="mt-3 ml-3">
                                <img class="float-left" src="{{ url('imagenes/preguntas/mg_t.png') }}" /><aside class="float-left ml-2">32</aside>
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
                                <button href="" class="float-right btn btn-sm btn-outline-light ml-2 mt-1"> <i class="fa fa-reply"></i> Responder</button>
                            <div class="mt-3 ml-3">
                                <img class="float-left" src="{{ url('imagenes/preguntas/mg_t.png') }}" /><aside class="float-left ml-2">32</aside>
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
        </div>
    </div>
</div>
@endsection

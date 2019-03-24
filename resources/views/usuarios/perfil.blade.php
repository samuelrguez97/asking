@extends('layouts.master')

@section('content')
<div class="container-fluid w-fit-content h-fit-content">
    <div class="mt-5 row">

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
            <a class="btn btn-info mb-5" href="{{ action('UsuariosControlador@editPerfil') }}">Editar perfil</a>
            @if( Session::has('success') )
            <aside class="mt-4 alert alert-success" role="alert">
                {{ session('success') }}
            </aside>
            @endif
        </div>

        <div class="col-md-6 offset-md-1">

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
                            <div class="float-right">
                                <button href="" class="btn btn-secondary btn-sm"> <i class="fa fa-reply"></i>
                                    Responder</button>
                            </div>
                            <div class="float-left mt-2">
                                <a class="like" href=""><img class="float-left img-likes" src="{{ url('imagenes/preguntas/mg_t.png') }}" /></a>
                                <aside class="float-left likes ml-2">200</aside>
                            </div>
                        </div>
                        <div class="card-footer">
                            <aside class="float-left tiempo">hace 20 minutos</aside>
                            <span class="badge badge-info tema">Variado</span>
                            <div class="text-right float-right">
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
                            <div class="float-right">
                                <button href="" class="btn btn-secondary btn-sm"> <i class="fa fa-reply"></i>
                                    Responder</button>
                            </div>
                            <div class="float-left mt-2">
                                <a class="like" href=""><img class="float-left img-likes" src="{{ url('imagenes/preguntas/mg_t.png') }}" /></a>
                                <aside class="float-left likes ml-2">15</aside>
                            </div>
                        </div>
                        <div class="card-footer">
                        <aside class="float-left tiempo">hace 1 hora</aside>
                            <span class="badge badge-info tema">Entretenimiento</span>
                            <div class="text-right float-right">
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
                            <div class="float-right">
                                <button href="" class="btn btn-secondary btn-sm"> <i class="fa fa-reply"></i>
                                    Responder</button>
                            </div>
                            <div class="float-left mt-2">
                                <a class="like" href=""><img class="float-left img-likes" src="{{ url('imagenes/preguntas/mg_t.png') }}" /></a>
                                <aside class="float-left likes ml-2">32</aside>
                            </div>
                        </div>
                        <div class="card-footer">
                            <aside class="float-left tiempo">hace 10 minutos</aside>
                            <span class="badge badge-info tema">Videojuegos</span>
                            <div class="text-right float-right">
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
                            <div class="float-right">
                                <button href="" class="btn btn-secondary btn-sm"> <i class="fa fa-reply"></i>
                                    Responder</button>
                            </div>
                            <div class="float-left mt-2">
                                <a class="like" href=""><img class="float-left img-likes" src="{{ url('imagenes/preguntas/mg_t.png') }}" /></a>
                                <aside class="float-left likes ml-2">125</aside>
                            </div>
                        </div>
                        <div class="card-footer">
                            <aside class="float-left tiempo">hace 10 minutos</aside>
                            <span class="badge badge-info tema">Entretenimiento</span>
                            <div class="text-right float-right">
                                <a class="like" href=""><i class="fa fa-times text-danger" aria-aside="Close" data-toggle="tooltip"
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
                            <aside class="float-left tiempo">hace 20 minutos</aside>
                            <span class="badge badge-info tema">Caballos</span>
                            <div class="float-right ml-3">
                                <a class="like" href=""><img class="float-left img-likes" src="{{ url('imagenes/preguntas/mg_f.png') }}" /></a>
                                <aside class="float-left likes ml-2">125</aside>
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
                                <span class="float-right badge badge-warning ml-3 mb-2">Sin respuesta</span>
                            </div>
                        </div>
                        <div class="card-body">
                            <h6 class="card-text ml-3 texto-pregunta">que te pasaa 😃😟</h6>
                        </div>
                        <div class="card-footer">
                            <aside class="float-left tiempo">hace 20 minutos</aside>
                            <span class="badge badge-info tema">Ordenadores</span>
                            <div class="float-right ml-3">
                                <a class="like" href=""><img class="float-left img-likes" src="{{ url('imagenes/preguntas/mg_f.png') }}" /></a>
                                <aside class="float-left likes ml-2">32</aside>
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

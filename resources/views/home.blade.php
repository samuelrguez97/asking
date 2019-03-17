@extends('layouts.master')

@section('content')
<div class="contenedor_pregunta mx-auto mt-5">
    <h1 class="display-4 letraTitulo">Formula tu pregunta</h1>
    <form class=".form_pregunta" action="" method="post">
        <label>
            <p class="label-txt">Introduce el usuario</p>
            <input type="text" class="w-user input text-white" name="usuario">
            <div class="line-box w-user">
                <div class="line"></div>
            </div>
        </label>
        <label>
            <p class="label-txt">Introduce tu pregunta</p>
            <input type="text" class="input text-white" name="pregunta">
            <div class="line-box">
                <div class="line"></div>
            </div>
        </label>
        <label>
            <p class="label-txt">Selecciona el tópico</p>
            <div class="select" name="topico">
                <select>
                    <option>Selecciona</option>
                    <option>Prueba 1</option>
                </select>
                <div class="select_arrow">
                </div>
            </div>
        </label>
        <label class="fix-height">
            <div class="float-left input_wrapper">
                <input type="checkbox" class="switch_4" id="normas" name="normas"/>
                <svg class="is_checked" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 426.67 426.67">
                    <path d="M153.504 366.84c-8.657 0-17.323-3.303-23.927-9.912L9.914 237.265c-13.218-13.218-13.218-34.645 0-47.863 13.218-13.218 34.645-13.218 47.863 0l95.727 95.727 215.39-215.387c13.218-13.214 34.65-13.218 47.86 0 13.22 13.218 13.22 34.65 0 47.863L177.435 356.928c-6.61 6.605-15.27 9.91-23.932 9.91z" />
                </svg>
                <svg class="is_unchecked" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 212.982 212.982">
                    <path d="M131.804 106.49l75.936-75.935c6.99-6.99 6.99-18.323 0-25.312-6.99-6.99-18.322-6.99-25.312 0L106.49 81.18 30.555 5.242c-6.99-6.99-18.322-6.99-25.312 0-6.99 6.99-6.99 18.323 0 25.312L81.18 106.49 5.24 182.427c-6.99 6.99-6.99 18.323 0 25.312 6.99 6.99 18.322 6.99 25.312 0L106.49 131.8l75.938 75.937c6.99 6.99 18.322 6.99 25.312 0 6.99-6.99 6.99-18.323 0-25.313l-75.936-75.936z"
                        fill-rule="evenodd" clip-rule="evenodd" />
                </svg>
            </div>
            <span class="terms-size text-white float-left">Estoy de acuerdo con <a href="#">las normas de la comunidad</a> * </span>
        </label>
        <div class="text-center">
            <button class="btn-sm" id="enviar_pregunta" type="submit">Enviar pregunta</button>
        </div>
    </form>
</div>

<div class="separador mt-5 mb-5"></div>

<div class="contenedor_pregunta_s mx-auto mt-5">
    <h1 class="display-4 letraTitulo">Preguntas</h1>
    <div class="menu-preguntas">
        <ul class="float-left navbar-nav mr-auto">
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle text-white" href="#" id="navbarDropdown" role="button" data-toggle="dropdown"
                    aria-haspopup="true" aria-expanded="false">
                    Ordenar preguntas
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item" href="#">Preguntas más recientes</a>
                    <a class="dropdown-item" href="#">Preguntas con más likes</a>
                    <a class="dropdown-item" href="#">Preguntas sobre un tema</a>
                </div>
            </li>
        </ul>
        <div class="float-right">
            <div class="mt-2 min-container">
                <h6 class="float-left text-white">Ordenado por: </h6>
                <aside class="ml-2 float-right text-ord">Preguntas más recientes</aside>
            </div>
        </div>
    </div>

    <div class="show-preguntas">
        <div class="row mt-5">

            <div class="col-sm-6 mb-5">
                <div class="card text-white bg-secondary">
                    <div class="card-header">
                        <div class="pregunta-user">
                            <aside class="float-left">
                                <span>Para: </span><span class="letraTitulo">samu</span>
                            </aside>
                            <aside class="float-right">
                                <button class="btn btn-secondary btn-sm">Ver respuesta</button>
                            </aside>
                        </div>
                    </div>
                    <div class="card-body">
                        <h6 class="card-text ml-3 texto-pregunta">Holaaaaaaa t kiero ver? :D</h6>
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
                                <span>Para: </span><span class="letraTitulo">pepe</span>
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

        </div>
    </div>

    <div class="text-center">
        <button class="btn btn-lg btn-success">Cargar más preguntas</button>
    </div>


</div>
@endsection

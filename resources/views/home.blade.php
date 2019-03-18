@extends('layouts.master')

@section('content')
<div class="contenedor_pregunta mx-auto mt-5">
    <h2 class="letraTitulo">Formula tu pregunta</h2>
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
            <input type="text" class="input text-white" name="pregunta" data-emojiable="true" data-emoji-input="unicode">
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
            <div id="normas" class="float-left">
                <input type="checkbox" name="normas"/>
            </div>
            <span class="terms-size text-white float-left">Estoy de acuerdo con <a href="#">las normas de la comunidad</a> * </span>
        </label>
        <div class="text-center mt-5">
            <button class="btn-sm" id="enviar_pregunta" type="submit">Enviar pregunta</button>
        </div>
    </form>
</div>

<hr/>

<div class="contenedor_pregunta_s mx-auto mt-5">
    <h2 class="letraTitulo">Preguntas</h2>
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

            <div class="col-sm-4 mb-5">
                <div class="card text-white bg-secondary">
                    <div class="card-header borde-bottom-0">
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
                    <div class="card-footer borde-top-0">
                        <aside class="float-left">hace 20 minutos</aside>
                        <div class="float-right ml-3">
                            <a class="like" href=""><img class="float-left" src="{{ url('imagenes/preguntas/mg_f.png') }}" /></a>
                            <aside class="float-left ml-2">32</aside>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-sm-4 mb-5">
                <div class="card text-white bg-secondary">
                    <div class="card-header borde-bottom-0">
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
                        <h6 class="card-text ml-3 texto-pregunta">fdjogasdiusavgdisapovcasPIOYfvsaipasVFasFycsaVFisayfvasIfvsaiyhfvasIFvasIPfvasHFpvsaifvasIYHfvASIfvASIYFvsapiyvasdPIYfv</h6>
                    </div>
                    <div class="card-footer borde-top-0">
                        <aside class="float-left">hace 20 minutos</aside>
                        <div class="float-right ml-3">
                            <a class="like" href=""><img class="float-left" src="{{ url('imagenes/preguntas/mg_f.png') }}" /></a>
                            <aside class="float-left ml-2">32</aside>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-sm-4 mb-5">
                <div class="card text-white bg-secondary">
                    <div class="card-header borde-bottom-0">
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
                    <div class="card-footer borde-top-0">
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

    <div class="mb-5 text-center">
        <button class="btn btn-lg btn-success">Cargar más preguntas</button>
    </div>

</div>
@endsection

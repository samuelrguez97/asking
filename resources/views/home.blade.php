@extends('layouts.master')

@section('content')
<div class="mt-5 row">

    <div class="col-md-8 offset-md-2">
        <div class="card contenedor_pregunta">
            <aside class="text-center">
                <img class="img_ask" src="{{ url('imagenes/favicon/favicon.png') }}">
            </aside>
            <form class=".form_pregunta" action="{{ action('PreguntasControlador@sendPregunta') }}" method="post">

                @csrf

                <label>
                    <input type="text" class="w-user input text-white" placeholder="Introduce el usuario" name="usuario"
                        value="{{ old('usuario') }}">
                    <div class="line-box w-user">
                        <div class="line"></div>
                    </div>
                </label>
                <label>
                    <input type="text" class="input text-white" name="pregunta" placeholder="Introduce tu pregunta"
                        data-emojiable="true" data-emoji-input="unicode" value="{{ old('pregunta') }}">
                    <div class="line-box">
                        <div class="line"></div>
                    </div>
                </label>
                <label>
                    <p class="label-txt">Selecciona el tema</p>
                    <div class="select">
                        <select name="tema">
                            <option value="selecciona">Selecciona</option>
                            @if(isset($temas))
                            @foreach($temas as $tema)
                            <option value="{{ $tema->tema }}">{{ $tema->tema }}</option>
                            @endforeach
                            @endif
                        </select>
                        <div class="select_arrow">
                        </div>
                    </div>
                </label>
                <label class="fix-height">
                    <div id="normas" class="float-left">
                        <input type="checkbox" name="normas" />
                    </div>
                    <span class="terms-size text-white float-left">Estoy de acuerdo con <a href="#">las normas de la
                            comunidad</a> * </span>
                </label>
                <div class="text-center mt-5">
                    <button class="btn-sm" id="enviar_pregunta" type="submit" name="submit">Enviar pregunta</button>
                </div>
            </form>
        </div>

    </div>
    <div class="col-md-3 mx-auto text-center">
        @if( Session::has('success') )
        <aside class="mt-4 alert alert-success" role="alert">
            {{ session('success') }}
        </aside>
        @endif

        @if( Session::has('error') )
        <aside class="mt-4 alert alert-danger" role="alert">
            {{ session('error') }}
        </aside>
        @endif

        @if ($errors->any())
        <div class="mt-4 alert alert-danger">
            @foreach ($errors->all() as $error)
            @if ($loop->last)
            {{ $error }}
            @else
            {{ $error }}
            <hr />
            @endif
            @endforeach
        </div>
        @endif
    </div>
</div>

<hr class="hr-home" />

<div class="row mt-5">

    <div class="col-sm-8 offset-md-2">
        <h2 class="letraTitulo">Preguntas</h2>
        <div class="menu-preguntas">
            <ul class="float-left navbar-nav mr-auto">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle text-white" href="#" id="navbarDropdown" role="button"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Ordenar preguntas
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="#">Preguntas más recientes</a>
                        <a class="dropdown-item" href="#">Preguntas con más likes</a>
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
    </div>
    <div class="col-sm-10 offset-md-1">
        <div class="show-preguntas">
            <div class="row mt-5">

                @foreach ($preguntas_todas as $pregunta)
                <div class="col-sm-4 mb-5">
                    <div class="card text-white bg-secondary">
                        <div class="card-header fit-content">
                            <div class="pregunta-user">
                                <aside class="float-left">
                                    <span>Para: </span><span class="letraTitulo">{{ $pregunta->usuario }}</span>
                                </aside>
                                <aside class="float-right">
                                    @if ($pregunta->respuesta == 0)
                                    <span class="float-right badge badge-warning ml-3 mb-2">Sin respuesta</span>
                                    @else
                                    <button class="btn btn-secondary btn-sm">Ver respuesta</button>
                                    @endif
                                </aside>
                            </div>
                        </div>
                        <div class="card-body">
                            <h6 class="card-text ml-3">{{ $pregunta->pregunta }}</h6>
                        </div>
                        <div class="card-footer">
                            <aside class="float-left tiempo">
                                {{ $pregunta->created_at->diffForHumans() }}
                            </aside>
                            <div class="float-right ml-3">
                                @if (Auth::check())
                                @if ($preguntas_like->contains('id_pregunta', $pregunta->id))
                                <button class="btn btn-sm like text-white" data-id-pregunta="{{ $pregunta->id }}"
                                    data-token="{{ csrf_token() }}"><img class="float-left img-likes"
                                        src="https://img.icons8.com/color/48/000000/filled-like.png" />
                                </button>
                                @else
                                <button class="btn btn-sm like text-white" data-id-pregunta="{{ $pregunta->id }}"
                                    data-token="{{ csrf_token() }}"><img class="float-left img-likes"
                                        src="https://img.icons8.com/like" />
                                </button>
                                @endif
                                @else
                                <button class="btn btn-sm like text-white" data-id-pregunta="{{ $pregunta->id }}"
                                    data-token="{{ csrf_token() }}"><img class="float-left img-likes"
                                        src="https://img.icons8.com/like" />
                                </button>
                                @endif
                                <aside id="contar-likes-{{ $pregunta->id }}" class="float-left likes mt-2 ml-2">
                                    {{ $pregunta->likes }}</aside>

                            </div>
                            <span class="float-left badge badge-info tema">{{ $pregunta->tema }}</span>
                        </div>
                    </div>
                </div>
                @endforeach

            </div>
        </div>
    </div>

    {!! Form::open(['route' => ['like', ':id_pregunta'], 'method' => 'LIKE', 'id' => 'form-like']) !!}
    {!! Form::close() !!}

</div>
</div>


@endsection

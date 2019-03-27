@extends('layouts.master')

@section('content')

@if( Session::has('error-busqueda') )
<aside class="col-md-8 offset-md-2 mt-4">
    <aside class="text-center alert alert-danger" role="alert">
        {{ session('error-busqueda') }}
    </aside>
</aside>
Session::forget('error-busqueda');
@endif

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
        Session::forget('success');
        @endif

        @if( Session::has('error') )
        <aside class="mt-4 alert alert-danger" role="alert">
            {{ session('error') }}
        </aside>
        Session::forget('error');
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
                        <a class="dropdown-item" href="{{ action('PreguntasControlador@principal') }}">Preguntas más
                            recientes</a>
                        <a class="dropdown-item" href="{{ action('PreguntasControlador@ordenarLikesHome') }}">Preguntas
                            con más likes</a>
                    </div>
                </li>
            </ul>
            <div class="float-left mt-1 ml-4">
                <a class="text-white btn btn-info btn-sm" href="{{ action('PreguntasControlador@temasTodos') }}">Ver
                    todos los temas</a>
            </div>
            <div class="float-right">
                <div class="mt-2 min-container">
                    <h6 class="float-left text-white">Ordenado por: </h6>
                    <aside class="ml-2 float-right text-ord">
                        @if( !empty($orden) )
                        {{ $orden }}
                        @else
                        Preguntas más recientes
                        @endif
                    </aside>
                </div>
            </div>
        </div>
    </div>
    <div class="col-sm-10 offset-md-1">
        <div id="preguntas" class="show-preguntas">
            <div class="row mt-5">

                @if ( $preguntas_todas->isEmpty() )
                <aside class="mx-auto mb-5 text-center alert alert-warning" role="alert">
                    <strong>¡Vaya!</strong> Parece que no hay preguntas ahora mismo ... ¡sé el primero en preguntar!
                </aside>
                @endif

                @foreach ($preguntas_todas as $pregunta)
                <div class="col-sm-4 mb-5">
                    <div class="card text-white bg-secondary">
                        <div class="card-header fit-content">
                            <div class="pregunta-user">
                                <aside class="float-left">
                                    <div class="media">
                                        <img src="{{ url('storage/imagenes/usuarios') }}/{{ $usuarios->where('name', $pregunta->usuario)->first()->avatar }}"
                                            class="mr-3 img-thumbnail min-img-perfil" alt="avatar">
                                        <div class="media-body">
                                            <h6>{{ $pregunta->usuario }}</h6>
                                        </div>
                                    </div>
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
                                <button class="float-left btn btn-sm like text-white"
                                    data-id-pregunta="{{ $pregunta->id }}" data-token="{{ csrf_token() }}"><img
                                        class="float-left img-likes"
                                        src="https://img.icons8.com/color/48/000000/filled-like.png" />
                                </button>
                                @else
                                <button class="float-left btn btn-sm like text-white"
                                    data-id-pregunta="{{ $pregunta->id }}" data-token="{{ csrf_token() }}"><img
                                        class="float-left img-likes" src="https://img.icons8.com/like" />
                                </button>
                                @endif
                                @else
                                <button class="float-left btn btn-sm like text-white"
                                    data-id-pregunta="{{ $pregunta->id }}" data-token="{{ csrf_token() }}"><img
                                        class="float-left img-likes" src="https://img.icons8.com/like" />
                                </button>
                                @endif
                                <aside id="contar-likes-{{ $pregunta->id }}" class="float-left likes mt-2">
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

    <!-- Creo el formulario para actualizar los likes por ajax -->
    {!! Form::open(['route' => ['like', ':id_pregunta'], 'method' => 'LIKE', 'id' => 'form-like']) !!}
    {!! Form::close() !!}

</div>
</div>


@endsection

@extends('layouts.master')

@section('content')
<div class="container-fluid w-fit-content h-fit-content">
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
            <a class="btn btn-info mb-3" href="{{ action('UsuariosControlador@editPerfil') }}">Editar perfil</a>
            @if( Session::has('success') )
            <aside class="mt-4 alert alert-success" role="alert">
                {{ session('success') }}
            </aside>
            @endif
            @if( Session::has('warning') )
            <aside class="mt-4 alert alert-warning" role="alert">
                {{ session('warning') }}
            </aside>
            @endif
        </div>

        <div class="col-md-6 offset-md-1">

            <!-- ZONA DE PREGUNTAS AL USUARIO -->

            <h1 class="display-4 letraTitulo">Tus preguntas</h1>
            <h4 class="text-white">Preguntas realizadas para ti</h4>

            @if ( $preguntas_a_ti->isEmpty() )
            <aside class="mt-4 text-center alert alert-warning" role="alert">
                No tienes preguntas ahora mismo ...
            </aside>
            @else

            <div class="row mt-5">

                <!-- ZONA PARA METER LAS PREGUNTAS DESDE LA BASE DE DATOS-->

                @foreach ( $preguntas_a_ti as $pregunta )
                <div class="col-sm-6 mb-5">
                    <div class="card text-white bg-secondary">
                        <div class="card-body">
                            @if ( date('H') - $pregunta->created_at->hour == 0 )
                            <span class="float-right badge badge-success ml-3 mb-2">Nueva</span>
                            @endif
                            <h6 class="card-text ml-3">{{ $pregunta->pregunta }}</h6>
                            <div class="float-right">
                                <button href="" class="btn btn-secondary btn-sm"> <i class="fa fa-reply"></i>
                                    Responder</button>
                            </div>
                            <div class="float-left mt-2">
                                <img class="float-left img-likes" src="{{ url('imagenes/preguntas/mg_t.png') }}" />
                                <aside class="float-left likes ml-2">{{ $pregunta->likes }}</aside>
                            </div>
                        </div>
                        <div class="card-footer">
                            <aside class="float-left tiempo">
                                {{ $pregunta->created_at->diffForHumans(date('Y-m-d H:i:s')) }}
                            </aside>
                            <span class="badge badge-info tema">{{ $pregunta->tema }}</span>
                            <div class="text-right float-right">
                                <a
                                    href="{{ action('PreguntasControlador@eliminarPregunta', ['id_pregunta' => $pregunta->id]) }}"><i
                                        class="fa fa-times text-danger" aria-aside="Close" data-toggle="tooltip"
                                        data-placement="right" title="Eliminar pregunta"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach

                <!-- --------------------------------------------------- -->

            </div>



            @if( Session::has('eliminada') )
            <aside class="mt-4 text-center alert alert-warning" role="alert">
                {{ session('eliminada') }}
            </aside>
            @endif

            <div class="mb-5 text-center">
                <a class="btn btn-lg btn-success" href="{{ action('UsuariosControlador@tusPreguntas') }}">Ver todas</a>
            </div>

            @endif

            <hr />

            <!-- ZONA DE PREGUNTAS REALIZADAS -->

            <h1 class="display-4 letraTitulo">Preguntas realizadas</h1>
            <h4 class="text-white">Preguntas realizadas por ti</h4>

            @if ( $preguntas_por_ti->isEmpty() )
            <aside class="mt-4 text-center alert alert-warning" role="alert">
                No has realizado ninguna pregunta ...
            </aside>
            @else

            <div class="row mt-5">

                <!-- ZONA PARA METER LAS PREGUNTAS DESDE LA BASE DE DATOS-->

                @foreach ( $preguntas_por_ti as $pregunta )
                <div class="col-sm-6 mb-5">
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
                            <h6 class="card-text ml-3 texto-pregunta">{{ $pregunta->pregunta }}</h6>
                        </div>
                        <div class="card-footer">
                            <aside class="float-left tiempo">
                                {{ $pregunta->created_at->diffForHumans(date('Y-m-d H:i:s')) }}
                            </aside>
                            <span class="badge badge-info tema">{{ $pregunta->tema }}</span>
                            <div class="float-right ml-3">
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
                                <aside id="contar-likes-{{ $pregunta->id }}" class="float-left likes mt-2 ml-2">
                                    {{ $pregunta->likes }}</aside>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach

                <!-- --------------------------------------------------- -->

            </div>
            <div class="mb-5 text-center">
                <a class="btn btn-lg btn-success" href="{{ action('UsuariosControlador@preguntasRealizadas') }}">Ver todas</a>
            </div>

            @endif

            <!-- Creo el formulario para actualziar los likes por ajax -->
            {!! Form::open(['route' => ['like', ':id_pregunta'], 'method' => 'LIKE', 'id' => 'form-like']) !!}
            {!! Form::close() !!}

        </div>
    </div>
</div>
@endsection

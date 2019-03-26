@extends('layouts.master')

@section('content')
<div class="container-fluid w-fit-content h-fit-content">
    <div class="mt-5 row">

        <!-- ZONA PARA MOSTRAR INFORMACIÓN DEL PERFIL PÚBLICO -->

        <div class="card-perfil col-md-3 offset-md-1">
            <div class="card fit-content">
                <img class="img-perfil" src="{{ url('storage/imagenes/usuarios') }}/{{ $usuario->avatar }}" />
                <table class="table mr-3">
                    <tr>
                        <th>Usuario</th>
                        <td>{{ $usuario->name }}</td>
                    </tr>
                    <tr>
                        <th>Fecha de creación</th>
                        <td>{{ $usuario->created_at->toDateString() }}</td>
                    </tr>
                </table>
            </div>
            <br />
            <a class="btn btn-info mb-3" href="{{ url('home') }}">Volver</a>
        </div>
        

        <div class="col-md-6 offset-md-1">

            <!-- ZONA DE PREGUNTAS AL USUARIO -->

            <h1 class="display-4 letraTitulo">Perfil público</h1>
            <h4 class="text-white">Preguntas para {{ $usuario->name }}</h4>

            @if ( $preguntas->isEmpty() )
            <aside class="mt-4 text-center alert alert-warning" role="alert">
                Éste usuario no tiene preguntas ahora mismo ...
            </aside>
            @else

            <div class="row mt-5">

                <!-- ZONA PARA METER LAS PREGUNTAS DESDE LA BASE DE DATOS-->

                @foreach ( $preguntas as $pregunta )
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
                                {{ $pregunta->created_at->diffForHumans() }}
                            </aside>
                            <span class="badge badge-info tema">{{ $pregunta->tema }}</span>
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
                        </div>
                    </div>
                </div>
                @endforeach

            @endif

            <!-- --------------------------------------------------- -->

            <!-- Creo el formulario para actualizar los likes por ajax -->
            {!! Form::open(['route' => ['like', ':id_pregunta'], 'method' => 'LIKE', 'id' => 'form-like']) !!}
            {!! Form::close() !!}

            </div>
        </div>
    </div>
</div>
@endsection

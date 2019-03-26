@extends('layouts.master')

@section('content')
<div class="container-fluid w-fit-content h-fit-content">
    <div class="col-md-10 offset-md-1 mb-5">
        <aside class="mt-5 ml-3">
            <h1 class="display-4 letraTitulo">Tus preguntas</h1>
            <h4 class="text-white">Preguntas realizadas para ti</h4>
        </aside>

        @if ( $preguntas_a_ti->isEmpty() )
        <aside class="mx-auto col-sm-4 mt-4 text-center alert alert-warning" role="alert">
            No tienes preguntas ahora mismo ...
        </aside>
        @else

        <div class="row mt-5">

            @foreach ( $preguntas_a_ti as $pregunta )
            <div class="col-sm-4 mb-5">
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
        </div>

        @if( Session::has('eliminada') )
        <aside class="mx-auto col-sm-4 mt-4 text-center alert alert-warning" role="alert">
            {{ session('eliminada') }}
        </aside>
        @endif

        @endif

        <aside class="text-center">
            <a class="btn btn-info col-sm-4 mt-4 text-center" href="{{ url('perfil') }}">Volver</a>
        </aside>

        <!-- Creo el formulario para actualizar los likes por ajax -->
        {!! Form::open(['route' => ['like', ':id_pregunta'], 'method' => 'LIKE', 'id' => 'form-like']) !!}
        {!! Form::close() !!}

    </div>
</div>
@endsection

@extends('layouts.master')

@section('content')
<div class="container-fluid w-fit-content h-fit-content">
    <div class="col-md-10 offset-md-1 mb-5">
        <aside class="mt-5 ml-3">
            <h1 class="display-4 letraTitulo">Preguntas realizadas</h1>
            <h4 class="text-white">Preguntas realizadas por ti</h4>
        </aside>

        @if ( $preguntas_por_ti->isEmpty() )
        <aside class="mx-auto col-sm-4 mt-4 text-center alert alert-warning" role="alert">
            No tienes preguntas realizadas ahora mismo ...
        </aside>
        @else

        <div class="row mt-5">

            @foreach ( $preguntas_por_ti as $pregunta )
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
        </div>

        <aside class="text-center">
            <a class="btn btn-info col-sm-4 mt-4 text-center" href="{{ url()->previous() }}">Volver</a>
        </aside>

        @endif

        <!-- Creo el formulario para actualziar los likes por ajax -->
        {!! Form::open(['route' => ['like', ':id_pregunta'], 'method' => 'LIKE', 'id' => 'form-like']) !!}
        {!! Form::close() !!}
    </div>
</div>
@endsection

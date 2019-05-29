@extends('layouts.master')

@section('content')

<div class="container-fluid w-fit-content h-fit-content">
    <div class="mt-5 row">
        <div class="col-md-8 mx-auto">
            <h1 class="display-5 letraTitulo"><i class="fas fa-book-open"></i> Temas</h1>
            <div class="row mt-5">
                @foreach ($temas as $tema)
                <div class="col-sm-4">
                    <div class="card mb-3">
                        <div class="card-body">
                            <h5 class="card-title">{{ $tema->tema }}</h5>
                            <p class="card-text">Preguntas del tema: {{ $tema->nPreguntas }}</p>
                            <a href="{{ action('PreguntasControlador@preguntasTema', ['tema' => $tema->tema]) }}"
                                class="btn btn-primary">Ver
                                este tema</a>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            <aside class="text-center">
                <a class="btn btn-info mt-4 mb-3 text-center" href="{{ url('home') }}"><i class="fas fa-home"></i> Inicio</a>
            </aside>
        </div>
    </div>
</div>

@endsection

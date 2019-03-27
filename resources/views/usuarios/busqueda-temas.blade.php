@extends('layouts.master')

@section('content')

<div class="container-fluid w-fit-content h-fit-content">
    <div class="mt-5 row">
        <div class="col-md-6 offset-md-3">
            <h1 class="display-5 letraTitulo">Temas</h1>
            <div class="row mt-5">
                @foreach ($temas as $tema)
                <div class="col-sm-4">
                    <div class="input-group mb-3">
                        <nav type="text" class="form-control" value="{{ $tema->tema }}"
                            aria-describedby="button-addon2">{{ $tema->tema }}</nav>
                        <div class="input-group-append">
                            <a class="btn btn-primary" id="button-addon2"
                                href="{{ action('PreguntasControlador@preguntasTema', ['tema' => $tema->tema]) }}">Ver
                                este tema</a>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</div>

@endsection

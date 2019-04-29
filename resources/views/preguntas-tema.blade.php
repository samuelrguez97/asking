@extends('layouts.master')

@section('content')
<div class="container-fluid w-fit-content h-fit-content">
    <div class="mt-5 row">

        <div class="col-md-10 offset-md-1">

            <!-- ZONA DE PREGUNTAS AL USUARIO -->

            <h1 class="display-5 letraTitulo">Temas</h1>
            <h4 class="text-white">Preguntas relacionadas con el tema: {{ $tema }}</h4>

            @if ( $preguntas->isEmpty() )
            <aside class="mt-4 text-center alert alert-warning" role="alert">
                Éste tema no tiene preguntas ahora mismo ...
            </aside>
            @else

            <div class="row mt-5">

                <!-- ZONA PARA METER LAS PREGUNTAS DESDE LA BASE DE DATOS-->

                @include('partials.ask_external')

                @include('partials.see_answer')

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

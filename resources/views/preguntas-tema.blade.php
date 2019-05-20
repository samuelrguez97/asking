@extends('layouts.master')

@section('content')
<div class="container-fluid w-fit-content h-fit-content">
    <div class="mt-5 row">

        <div class="col-md-10 offset-md-1">

            <!-- ZONA DE PREGUNTAS AL USUARIO -->

            <h1 class="display-5 letraTitulo">Temas</h1>
            <h4 class="text-white">Preguntas relacionadas con el tema: {{ $tema }}</h4>

            @if ( $preguntas->isEmpty() )
            <aside class="col-4 offset-4 mt-4 text-center alert alert-warning" role="alert">
                Éste tema no tiene preguntas ahora mismo ...
            </aside>

            @else

            <div class="row mt-5">

                <!-- ZONA PARA METER LAS PREGUNTAS DESDE LA BASE DE DATOS-->

                @include('partials.ask_external')

                @include('partials.see_answer')

                <!-- --------------------------------------------------- -->

            </div>

            @endif

            <aside class="text-center mb-3">
                @if (url()->previous() == url('buscar'))
                <a class="btn btn-info col-sm-1 mt-4 text-center" href="{{ url('home') }}">Volver</a>
                @else
                <a class="btn btn-info col-sm-1 mt-4 text-center" href="{{ url()->previous() }}">Volver</a>
                @endif 
            </aside>

        </div>
    </div>
</div>
@endsection

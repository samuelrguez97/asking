@extends('layouts.master')

@section('content')
<div class="container-fluid w-fit-content h-fit-content">
    <div class="col-md-8 mx-auto mb-5">
        <aside class="mt-5 ml-3">
            <h1 class="display-4 letraTitulo">Tus preguntas respondidas</h1>
            <h4 class="text-white">Preguntas realizadas para ti</h4>
        </aside>

        @if ( $preguntas->isEmpty() )
        <aside class="mx-auto mt-4 text-center alert alert-warning" role="alert">
            No tienes preguntas ahora mismo ...
        </aside>
        @else

        <div class="row mt-5">

        @include('partials.ask_external')

        @include('partials.see_answer')
        
        </div>

        @endif

        <aside class="text-center">
            <a class="btn btn-info mt-4 mb-2 text-center" href="{{ url('perfil') }}"><i class="fas fa-arrow-left"></i> Volver</a>
        </aside>

    </div>
</div>
@endsection
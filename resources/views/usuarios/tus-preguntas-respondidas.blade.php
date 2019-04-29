@extends('layouts.master')

@section('content')
<div class="container-fluid w-fit-content h-fit-content">
    <div class="col-md-10 offset-md-1 mb-5">
        <aside class="mt-5 ml-3">
            <h1 class="display-4 letraTitulo">Tus preguntas respondidas</h1>
            <h4 class="text-white">Preguntas realizadas para ti</h4>
        </aside>

        @if ( $preguntas->isEmpty() )
        <aside class="mx-auto col-sm-4 mt-4 text-center alert alert-warning" role="alert">
            No tienes preguntas ahora mismo ...
        </aside>
        @else

        <div class="row mt-5">

        @include('partials.ask_external')

        @include('partials.see_answer')
        
        </div>

        @if( Session::has('eliminada') )
        <aside class="mx-auto col-sm-4 mt-4 text-center alert alert-warning" role="alert">
            {{ session('eliminada') }}
        </aside>
        @endif

        @endif

        <aside class="text-center">
            <a class="btn btn-info col-sm-1 mt-4 text-center" href="{{ url('perfil') }}">Volver</a>
        </aside>

        <!-- Creo el formulario para actualizar los likes por ajax -->
        {!! Form::open(['route' => ['like', ':id_pregunta'], 'method' => 'LIKE', 'id' => 'form-like']) !!}
        {!! Form::close() !!}

    </div>
</div>
@endsection
@extends('layouts.master')

@section('content')
<div class="container-fluid w-fit-content h-fit-content">
    <div class="col-md-8 mx-auto mb-5">
        <aside class="mt-5 ml-3">
            <h1 class="display-4 letraTitulo">Tus preguntas</h1>
            <h4 class="text-white">Preguntas realizadas para ti</h4>
        </aside>

        @if( Session::has('eliminada') )
        <div class="row">
            <aside class="mx-auto mt-4 alert alert-danger text-center" role="alert">
                {{ session('eliminada') }}
            </aside>
        </div>
        @endif

        @if( Session::has('respondida') )
        <div class="row">
            <aside class="mx-auto mt-4 alert alert-success text-center" role="alert">
                {{ session('respondida') }}
            </aside>
        </div>
        @endif

        @if ($errors->any())
        <div class="row">
            <div class="mt-4 mx-auto alert alert-danger">
                @foreach ($errors->all() as $error)
                @if ($loop->last)
                {{ $error }}
                @else
                {{ $error }}
                <hr />
                @endif
                @endforeach
            </div>
        </div>
        @endif

        @if ( $preguntas_a_ti->isEmpty() )
        <div class="row">
            <aside class="mx-auto mt-4 alert alert-warning text-center" role="alert">
                No tienes preguntas ahora mismo ...
            </aside>
        </div>
        @else

        <div class="row mt-5">

        @include('partials.ask_yours')

        @include('partials.respond_answer')
        
        </div>

        @endif

        <aside class="text-center">
            <a class="btn btn-info mt-4 mb-2 text-center" href="{{ url('home') }}"><i class="fas fa-home"></i> Inicio</a>
            <a class="btn btn-success mt-4 mb-2 text-center" href="{{ url('perfil') }}"><i class="fas fa-user"></i> Tu perfil</a>
        </aside>

    </div>
</div>
@endsection

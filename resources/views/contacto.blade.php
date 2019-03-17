@extends('layouts.master')

@section('content')

<div class="container mt-5 text-white">
    <div class="row justify-content-center">
        <div class="col-md-8 h-50">

        <div class="text-center mb-4">
            <h2 class="letraTitulo">Contacto</h2>
        </div>

            <form method="POST" action="">
                @csrf

                <div class="form-group row">

                    <div class="col-md-6 offset-md-3">
                        <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}"
                            required placeholder="E-mail">

                    </div>
                </div>

                <div class="form-group row">

                    <div class="col-md-6 offset-md-3">
                        <textarea id="texto-contacto" name="texto-contacto" required placeholder="Introduce tu consulta aquí"></textarea>
                    </div>
                </div>

                <div class="form-group row mb-0 mx-auto">
                    <div class="col-md-7 mx-auto text-center">
                        <button type="submit" class="boton btn-sm draw-border">
                            Enviar
                        </button>
                    </div>
                </div>

            </form>

        </div>
    </div>
</div>

@endsection

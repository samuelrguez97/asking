@extends('layouts.master')

@section('content')
<div class="container mt-5 text-white">
    <div class="row justify-content-center">
        <div class="col-md-8">

            @if (session('status'))
            <div class="alert alert-success text-center" role="alert">
                {{ session('status') }}
            </div>
            @endif

            <div class="text-center mb-4">
                <h2 class="letraTitulo">Recuperar contraseña</h2>
            </div>

            <form method="POST" action="{{ route('password.email') }}">
                @csrf

                <div class="form-group row">

                    <div class="col-md-6 offset-md-3">
                        <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}"
                            name="email" value="{{ old('email') }}" required placeholder="{{ __('E-mail') }}">

                        @if ($errors->has('email'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('email') }}</strong>
                        </span>
                        @endif
                    </div>
                </div>

                <div class="form-group row mb-0">
                    <div class="col-md-6 offset-md-4">
                        <button type="submit" class="boton btn-sm draw-border">
                            {{ __('Enviar link de recuperación') }}
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

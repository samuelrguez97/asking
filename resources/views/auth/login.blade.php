@extends('layouts.master')

@section('content')
<div class="cont-log_reg mt-5 text-white">

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <div class="text-center mb-4">
            <h2 class="letraTitulo">Login</h2>
        </div>

        <div class="form-group row">

            <div class="col-md-6 offset-md-3">
                <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}"
                    name="email" value="{{ old('email') }}" required autofocus placeholder="E-mail">

                @if ($errors->has('email'))
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('email') }}</strong>
                </span>
                @endif
            </div>
        </div>

        <div class="form-group row">
            <div class="col-md-6 offset-md-3">
                <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}"
                    name="password" required placeholder="Contraseña">

                @if ($errors->has('password'))
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('password') }}</strong>
                </span>
                @endif
            </div>
        </div>

        <div class="form-group row">
            <div class="col-md-6 offset-md-3">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="remember" id="remember"
                        {{ old('remember') ? 'checked' : '' }}>

                    <nav class="form-check-label" for="remember">
                        Recuérdame
                    </nav>
                </div>
            </div>
        </div>

        <div class="form-group row mb-0">
            <div class="col-md-7 offset-md-3">
                <button type="submit" class="boton btn-sm draw-border">
                    Entrar
                </button>

                @if (Route::has('password.request'))
                <a class="btn btn-link" href="{{ route('password.request') }}">
                    ¿Has olvidado tu contraseña?
                </a>
                @endif
            </div>
        </div>

    </form>
</div>
@endsection

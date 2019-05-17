@extends('layouts.master')

@section('content')
<div class="cont-log_reg mt-5 text-white">
    <div class="row">
        <div class="col-md-8 mx-auto">
            <form method="POST" action="{{ route('register') }}">
                @csrf

                <div class="text-center mb-4">
                    <h2 class="letraTitulo">Registro</h2>
                </div>

                <div class="form-group row">

                    <div class="col-md-8 offset-md-2">
                        <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name"
                            value="{{ old('name') }}" required autofocus placeholder="Usuario">

                        @if ($errors->has('name'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('name') }}</strong>
                        </span>
                        @endif
                    </div>
                </div>

                <div class="form-group row">

                    <div class="col-md-8 offset-md-2">
                        <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}"
                            name="email" value="{{ old('email') }}" required placeholder="E-mail">

                        @if ($errors->has('email'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('email') }}</strong>
                        </span>
                        @endif
                    </div>
                </div>

                <div class="form-group row">

                    <div class="col-md-8 offset-md-2">
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

                    <div class="col-md-8 offset-md-2">
                        <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required
                            placeholder="Confirmar contraseña">
                    </div>
                </div>

                <div class="text-center">
                    <button type="submit" class="boton btn-sm draw-border">
                        Registrarse
                    </button>
                </div>

            </form>
        </div>
    </div>
</div>
@endsection

@extends('layouts.master')

@section('content')
<br /><br />
<div class="container mt-5 text-white">
    <div class="row justify-content-center">
        <div class="col-md-8">

            <form method="POST" action="{{ route('register') }}">
                @csrf

                <div class="form-group row">

                    <div class="col-md-6 offset-md-3">
                        <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}"
                            name="name" value="{{ old('name') }}" required autofocus placeholder="Usuario">

                        @if ($errors->has('name'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('name') }}</strong>
                        </span>
                        @endif
                    </div>
                </div>

                <div class="form-group row">

                    <div class="col-md-6 offset-md-3">
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
                        <input id="password-confirm" type="password" class="form-control" name="password_confirmation"
                            required placeholder="Confirmar contraseña">
                    </div>
                </div>

                <div class="form-group row mb-0 mx-auto">
                    <div class="col-md-6 offset-md-5">
                        <button type="submit" class="boton btn-sm draw-border">
                            Registrarse
                        </button>
                    </div>
                </div>

                <hr>

                <div class="mx-auto text-center">
                    <label class="col-md-4">¿Ya registrado? Entra <a href="{{ url('/login') }}">aquí</a>.</label>
                </div>

            </form>

        </div>
    </div>
</div>
@endsection

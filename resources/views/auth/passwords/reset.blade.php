@extends('layouts.master')

@section('content')
<div class="container mt-5 text-white">
    <div class="row justify-content-center">
        <div class="col-md-8">

            <form method="POST" action="{{ route('password.update') }}">
                @csrf

                <div class="text-center mb-4">
                    <h2 class="letraTitulo">Cambiar contraseña</h2>
                </div>

                <input type="hidden" name="token" value="{{ $token }}">

                <div class="form-group row">
                    <div class="col-md-6 offset-md-3">
                        <aside class="aside-edit">Email</aside><input id="email" type="email"
                            class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email"
                            value="{{ $email ?? old('email') }}" required autofocus>

                        @if ($errors->has('email'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('email') }}</strong>
                        </span>
                        @endif
                    </div>
                </div>

                <div class="form-group row">

                    <div class="col-md-6 offset-md-3">
                        <aside class="aside-edit">Contraseña</aside><input id="password" type="password"
                            class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password"
                            required>

                        @if ($errors->has('password'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('password') }}</strong>
                        </span>
                        @endif
                    </div>
                </div>

                <div class="form-group row">

                    <div class="col-md-6 offset-md-3">
                        <aside class="aside-edit">Confirmar contraseña</aside><input id="password-confirm"
                            type="password" class="form-control" name="password_confirmation" required>
                    </div>
                </div>

                <div class="form-group row mb-0">
                    <div class="col-md-6 offset-md-4">
                        <button type="submit" class="btn btn-primary">
                            {{ __('Reset Password') }}
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

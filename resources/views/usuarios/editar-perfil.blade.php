@extends('layouts.master')

@section('content')
<aside class="row mt-5">
    <aside class="col-md-4 mx-auto text-white">

        <form method="post" action="{{ action('UsuariosControlador@makeEdit') }}" enctype="multipart/form-data">

            @csrf

            <div class="text-center mb-4">
                <h2 class="letraTitulo">Editar perfil</h2>
            </div>

            <aside class="form-group row">
                <aside class="col-md-10 offset-md-1">
                    <aside class="aside-edit">Contraseña actual *</aside><input class="input-edit" type="password"
                        name="clave_actual" />
                    <small class="text-muted">Debes introducir la <strong>contraseña actual</strong> para realizar
                        cambios.</small>
                    <hr />
                </aside>
            </aside>

            <aside class="form-group row">
                <aside class="col-md-10 offset-md-1">
                    <aside class="aside-edit">Usuario</aside><input class="input-edit" type="text" name="usuario" />
                </aside>
            </aside>
            <aside class="form-group row">
                <aside class="col-md-10 offset-md-1">
                    <aside class="aside-edit">Email</aside><input class="input-edit" type="text" name="email" />
                </aside>
            </aside>
            <aside class="form-group row">
                <aside class="col-md-10 offset-md-1">
                    <aside class="aside-edit">Nueva contraseña</aside><input class="input-edit" type="password"
                        name="nueva_clave" />
                </aside>
            </aside>
            <aside class="form-group row">
                <aside class="col-md-10 offset-md-1">
                    <aside class="aside-edit">Imagen de perfil</aside><input type="file" id="avatar" name="avatar"
                        accept="image/png, image/jpeg">
                </aside>
            </aside>
            <aside class="form-group row">
                <aside class="col-md-10 offset-md-1 mt-3">
                    <button type="submit" name="submit" class="btn btn-sm btn-success">Editar</button>
                    <a class="ml-3 btn btn-sm btn-warning"
                        href="{{ action('UsuariosControlador@getPerfil') }}">Cancelar</a>
                </aside>
            </aside>

            @if( Session::has('error') )
            <aside class="mt-4 alert text-center alert-danger" role="alert">
                {{ session('error') }}
            </aside>
            @endif

            @if ($errors->any())
            <div class="mt-4 text-center alert alert-danger">
                @foreach ($errors->all() as $error)
                    @if ($loop->last)
                        {{ $error }}
                    @else
                        {{ $error }}
                        <hr />
                    @endif
                @endforeach
            </div>
            @endif

        </form>
    </aside>
</aside>
@endsection

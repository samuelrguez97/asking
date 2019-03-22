@extends('layouts.master')

@section('content')
<aside class="container-fluid w-fit-content h-fit-content">
    <aside class="mt-5 row">
        <aside class="col-md-4 mx-auto text-white">

            <form method="post" action="{{ action('UsuariosControlador@makeEdit') }}" enctype="multipart/form-data">

                @csrf

                <aside class="text-center mb-4">
                    <h1 class="letraTitulo">Editar perfil</h1>
                </aside>

                <aside class="form-group row">
                    <aside class="col-md-8 offset-md-2">
                        <aside class="aside-edit">Usuario</aside><input class="input-edit" type="text" name="usuario"
                            value="{{ Auth::user()->name }}" />
                    </aside>
                </aside>
                <aside class="form-group row">
                    <aside class="col-md-8 offset-md-2">
                        <aside class="aside-edit">Email</aside><input class="input-edit" type="text" name="email"
                            value="{{ Auth::user()->email }}" />
                    </aside>
                </aside>
                <aside class="form-group row">
                    <aside class="col-md-8 offset-md-2">
                        <aside class="aside-edit">Contraseña actual</aside><input class="input-edit" type="password"
                            name="antigua-clave" />
                    </aside>
                </aside>
                <aside class="form-group row">
                    <aside class="col-md-8 offset-md-2">
                        <aside class="aside-edit">Nueva contraseña</aside><input class="input-edit" type="password"
                            name="nueva-clave" />
                    </aside>
                </aside>
                <aside class="form-group row">
                    <aside class="col-md-8 offset-md-2">
                        <aside class="aside-edit">Imagen de perfil</aside><input type="file" id="avatar" name="avatar" accept="image/png, image/jpeg">
                    </aside>
                </aside>
                <aside class="form-group row">
                    <aside class="col-md-8 offset-md-2 mt-3">
                        <button type="submit" name="submit" class="btn btn-sm btn-success">Enviar</button>
                        <a class="ml-3 btn btn-sm btn-warning"
                            href="{{ action('UsuariosControlador@getPerfil') }}">Cancelar</a>
                    </aside>
                </aside>

                @if( Session::has('error') )
                <aside class="alert alert-danger" role="alert">
                    {{ session('error') }}
                </aside>
                @endif

                @if ($errors->any())
                    <div class="alert alert-danger">
                        @foreach ($errors->all() as $error)
                            {{ $error }}
                        @endforeach
                    </div>
                @endif

            </form>
        </aside>
    </aside>
</aside>
@endsection

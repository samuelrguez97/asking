@extends('layouts.master')

@section('content')
<div class="mx-auto">
    <div class="card">
        @if ( Auth::user()->img )
            <img src="{{ Auth::user()->img }}" />
        @else
            <div class="p-3 mb-2 bg-warning text-dark">No tiene foto de perfil</div>
        @endif
        <table class="table">
            <tr>
                <th>Usuario</th>
                <td>{{ Auth::user()->name }}</td>
            </tr>
            <tr>
                <th>E-mail</th>
                <td>{{ Auth::user()->email }}</td>
            </tr>
            <tr>
                <th>Fecha de creación</th>
                <td>{{ Auth::user()->created_at }}</td>
            </tr>
        </table>
    </div>
    <br/>
    <div class="col-md-5 mx-auto">
        <button type="button" class="btn btn-success" action="#">Editar perfil</button>
    </div>
</div>
@endsection
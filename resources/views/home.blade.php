@extends('layouts.master')

@section('content')
<div class="container mx-auto mt-5">
    <form class=".form_pregunta" action="" method="post">
        <label>
            <p class="label-txt">Introduce el usuario</p>
            <input type="text" class="input" name="usuario">
            <div class="line-box">
                <div class="line"></div>
            </div>
        </label>
        <label>
            <p class="label-txt">Introduce tu pregunta</p>
            <input type="text" class="input" name="pregunta">
            <div class="line-box">
                <div class="line"></div>
            </div>
        </label>
        <label>
            <p class="label-txt">Selecciona el tópico</p>
            <div class="select" name="topico">
                <select>
                    <option>Selecciona</option>
                    <option>Prueba 1</option>
                </select>
                <div class="select_arrow">
                </div>
            </div>
        </label>
        <div class="text-center">
            <button id="enviar_pregunta" type="submit">Enviar pregunta</button>
        </div>
    </form>
</div>
@endsection

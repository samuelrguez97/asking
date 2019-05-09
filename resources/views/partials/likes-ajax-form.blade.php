<!-- Creo el formulario para actualizar los likes por ajax -->
{!! Form::open(['route' => ['like', ':id_pregunta'], 'method' => 'LIKE', 'id' => 'form-like', 'class' => 'd-none']) !!}
{!! Form::close() !!}
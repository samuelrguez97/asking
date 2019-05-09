<!-- Creo el formulario para ver la respuesta por ajax -->
{!! Form::open(['route' => ['answer', ':id_pregunta'], 'method' => 'ANWSWER', 'id' => 'form-answer', 'class' => 'd-none']) !!}
{!! Form::close() !!}
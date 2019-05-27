@foreach ( $preguntas_a_ti as $pregunta )
<div class="col-sm-6 mb-5">
    <div class="card text-white bg-transparent bordes-ask">
        <div class="card-body">
            @if ( date('H') - $pregunta->created_at->hour == 0 )
            <span class="float-right badge badge-success ml-3 mb-2">Nueva</span>
            @endif
            <h6 class="card-text ml-3">{{ $pregunta->pregunta }}</h6>
            <div class="float-right mt-2">
                <button data-toggle="modal" data-target="#responder" data-id-pregunta="{{ $pregunta->id }}"
                    class="responder btn btn-secondary btn-sm"> <i class="fa fa-reply"></i>
                    Responder</button>
            </div>
            <div class="float-left mt-2">
                <button id="boton-env-resp" class="float-left btn btn-sm like text-white"
                    data-id-pregunta="{{ $pregunta->id }}" data-token="{{ csrf_token() }}"><i
                        class="{{ Auth::check() ? ($preguntas_like->contains('id_pregunta', $pregunta->id) ? 'color-like fas' : 'far') : 'far' }} far fa-heart fa-lg"></i>
                </button>
                <aside id="contar-likes-{{ $pregunta->id }}" class="float-left likes">
                    {{ $pregunta->likes }}</aside>
            </div>
        </div>
        <div class="card-footer">
            <aside class="float-left tiempo">
                {{ $pregunta->created_at->diffForHumans() }}
            </aside>
            <a href="{{ action('PreguntasControlador@preguntasTema', ['tema' => $pregunta->tema]) }}" data-toggle="tooltip" data-placement="bottom" title="Ver preguntas del tema">
                <span class="badge badge-info tema">{{ $pregunta->tema }}</span>
            </a>
            <div class="text-right float-right">
                <a href="{{ action('PreguntasControlador@eliminarPregunta', ['id_pregunta' => $pregunta->id]) }}"><i
                        class="fa fa-times text-danger" aria-aside="Close" data-toggle="tooltip" data-placement="top"
                        title="Eliminar pregunta"></i></a>
            </div>
        </div>
    </div>
</div>
@endforeach

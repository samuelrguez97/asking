@foreach ( $preguntas_a_ti as $pregunta )
<div class="col-sm-6 mb-5">
    <div class="card text-white bg-transparent bordes-ask">
        <div class="card-body">
            @if ( date('H') - $pregunta->created_at->hour == 0 )
            <span class="float-right badge badge-success ml-3 mb-2">Nueva</span>
            @endif
            <h6 class="card-text ml-3">{{ $pregunta->pregunta }}</h6>
            <div class="float-right">
                <button href="" class="btn btn-secondary btn-sm"> <i class="fa fa-reply"></i>
                    Responder</button>
            </div>
            <div class="float-left mt-2">
                @if ($preguntas_like->contains('id_pregunta', $pregunta->id))
                <button class="float-left btn btn-sm like text-white" data-id-pregunta="{{ $pregunta->id }}"
                    data-token="{{ csrf_token() }}"><img class="float-left img-likes"
                        src="https://img.icons8.com/color/48/000000/filled-like.png" />
                </button>
                @else
                <button class="float-left btn btn-sm like text-white" data-id-pregunta="{{ $pregunta->id }}"
                    data-token="{{ csrf_token() }}"><img class="float-left img-likes"
                        src="https://img.icons8.com/like" />
                </button>
                @endif
                <aside id="contar-likes-{{ $pregunta->id }}" class="float-left likes mt-2">
                    {{ $pregunta->likes }}</aside>
            </div>
        </div>
        <div class="card-footer">
            <aside class="float-left tiempo">
                {{ $pregunta->created_at->diffForHumans() }}
            </aside>
            <span class="badge badge-info tema">{{ $pregunta->tema }}</span>
            <div class="text-right float-right">
                <a href="{{ action('PreguntasControlador@eliminarPregunta', ['id_pregunta' => $pregunta->id]) }}"><i
                        class="fa fa-times text-danger" aria-aside="Close" data-toggle="tooltip" data-placement="right"
                        title="Eliminar pregunta"></i></a>
            </div>
        </div>
    </div>
</div>
@endforeach

@foreach ( $preguntas as $pregunta )
<div class="col-4 mb-5">
    <div class="card text-white bg-transparent bordes-ask">
        <div class="card-header fit-content">
            <div class="pregunta-user">
                <aside class="float-left">
                    <img src="{{ url('storage/imagenes/usuarios') }}/{{ $usuarios->where('name', $pregunta->usuario)->first()->avatar }}"
                        class="mr-3 img-thumbnail min-img-perfil" alt="avatar">
                    <div class="media-body">
                        <h6>{{ $pregunta->usuario }}</h6>
                    </div>
                </aside>
                <aside class="float-right">
                    @if ($pregunta->respuesta == 0)
                    <span class="float-right badge badge-warning ml-3 mb-2">Sin respuesta</span>
                    @else
                    <button class="btn btn-secondary btn-sm">Ver respuesta</button>
                    @endif
                </aside>
            </div>
        </div>
        <div class="card-body">
            <h6 class="card-text ml-3 texto-pregunta">{{ $pregunta->pregunta }}</h6>
        </div>
        <div class="card-footer">
            <aside class="float-left tiempo">
                {{ $pregunta->created_at->diffForHumans() }}
            </aside>
            <span class="badge badge-info tema">{{ $pregunta->tema }}</span>
            <div class="float-right ml-3">
                @if (Auth::check())
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
    </div>
</div>
@endforeach

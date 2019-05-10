@foreach ( $preguntas as $pregunta )
<div class="{{ Request::segment(1) == 'perfil-publico' ? 'col-sm-6' : 'col-4' }} mb-5">
    <div class="card text-white bg-transparent bordes-ask">
        <div class="card-header fit-content">
            <div class="pregunta-user">
                <aside class="float-left">
                    <a class="profile-user" href="{{ action('UsuariosControlador@getPerfilPublico', ['nombre' => $pregunta->usuario]) }}"
                        class="text-muted">
                        <img src="{{ url('storage/imagenes/usuarios') }}/{{ $usuarios->where('name', $pregunta->usuario)->first()->avatar }}"
                            class="mr-3 rounded min-img-perfil" alt="avatar">
                        <div class="media-body">
                            <h6>{{ $pregunta->usuario }}</h6>
                        </div>
                    </a>
                </aside>
                <aside class="float-left p-2 texto-pregunta">
                    <h6 class="card-text ml-3">{{ $pregunta->pregunta }}</h6>
                </aside>
                <aside id="aRespuesta" class="float-right mt-2">
                    @if ($pregunta->respuesta == 0)
                    <span class="float-right badge badge-warning ml-3 mb-2">Sin respuesta</span>
                    @else
                    <button id="ver-respuesta-go" data-id-pregunta="{{ $pregunta->id }}" class="answer btn btn-secondary btn-sm">Ver respuesta</button>
                    @endif
                </aside>
            </div>
        </div>
        <div class="card-footer">
            <aside class="float-left tiempo">
                {{ $pregunta->created_at->diffForHumans() }}
            </aside>
            <a href="{{ action('PreguntasControlador@preguntasTema', ['tema' => $pregunta->tema]) }}">
                <span class="badge badge-info tema">{{ $pregunta->tema }}</span>
            </a>
            <div class="float-right ml-3">
                <button class="float-left btn btn-sm like text-white" data-id-pregunta="{{ $pregunta->id }}"
                    data-token="{{ csrf_token() }}"><i
                        class="{{ Auth::check() ? ($preguntas_like->contains('id_pregunta', $pregunta->id) ? 'color-like fas' : 'far') : ''}} fa-heart fa-lg"></i>
                </button>
                <aside id="contar-likes-{{ $pregunta->id }}" class="float-left likes">
                    {{ $pregunta->likes }}</aside>
            </div>
        </div>
    </div>
</div>
@endforeach

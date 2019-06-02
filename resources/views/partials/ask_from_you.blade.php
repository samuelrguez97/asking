@foreach ( $preguntas_por_ti as $pregunta )
<div class="col-sm-6 mb-5">
    <div class="card text-white bg-transparent bordes-ask">
        <div class="card-header fit-content">
            <div class="pregunta-user">
                <aside class="for">
                    <aside class="float-left mr-1 for-ask">Ask</aside>
                    Para
                </aside>
                <aside class="float-left">
                    <a class="profile-user" data-toggle="tooltip" data-placement="bottom" title="Ir a su perfil"
                        href="{{ action('UsuariosControlador@getPerfilPublico', ['nombre' => $usuarios->where('id', $pregunta->id_usuario)->first()->name]) }}"
                        class="text-muted">
                        <img src="{{ url('storage/imagenes/usuarios') }}/{{ $usuarios->where('id', $pregunta->id_usuario)->first()->avatar }}"
                            class="mr-3 rounded min-img-perfil" alt="avatar">
                        <div class="media-body">
                            <h6>{{ $usuarios->where('id', $pregunta->id_usuario)->first()->name }}</h6>
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
                    <button id="ver-respuesta-go" data-id-pregunta="{{ $pregunta->id }}"
                        class="answer btn btn-secondary btn-sm"><i class="far fa-eye"></i> Ver respuesta</button>
                    @endif
                </aside>
            </div>
        </div>
        <div class="card-footer">
            <aside class="float-left tiempo">
                {{ $pregunta->created_at->diffForHumans() }}
            </aside>
            <a href="{{ action('PreguntasControlador@preguntasTema', ['tema' => $pregunta->tema]) }}" data-toggle="tooltip" data-placement="bottom" title="Ver preguntas del tema">
                <span class="badge badge-info tema">{{ $pregunta->tema }}</span>
            </a>
            <aside class="float-right">
                <div class="float-left btn-group mr-2" role="group">
                    <a class="btn btn-sm btn-primary"
                        href="{{ action('UsuariosControlador@getPerfilPublico', ['nombre' => $usuarios->where('id', $pregunta->id_usuario)->first()->name]) }}"
                        data-toggle="tooltip" data-placement="bottom" title="Ir a su perfil">
                        <i class="fas fa-user"></i>
                    </a>
                    <a class="btn btn-sm btn-success"
                        href="{{ action('PreguntasControlador@sendPreguntaUser', ['user' => $usuarios->where('id', $pregunta->id_usuario)->first()]) }}"
                        data-toggle="tooltip" data-placement="bottom" title="Preguntar a este usuario"><i
                            class="fas fa-question-circle"></i></a>
                </div>
                <div class="float-left">
                    <button class="float-left btn btn-sm like text-white" data-id-pregunta="{{ $pregunta->id }}"
                        data-token="{{ csrf_token() }}"><i
                            class="{{ Auth::check() ? ($preguntas_like->contains('id_pregunta', $pregunta->id) ? 'color-like fas' : 'far') : 'far'}} fa-heart fa-lg"></i>
                    </button>
                    <aside id="contar-likes-{{ $pregunta->id }}" class="float-left likes">{{ $pregunta->likes == 0 ? '' : $pregunta->likes }}</aside>
                </div>
            </aside>
        </div>
    </div>
</div>
@endforeach

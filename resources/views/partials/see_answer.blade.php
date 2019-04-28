@if (!empty(session('ver_pregunta')))
@php
$ver_pregunta = session('ver_pregunta');
$ver_preguntas_like = session('ver_preguntas_like');
$ver_respuesta = session('ver_respuesta');
@endphp
<aside id="verRespuesta" class="modal" tabindex="-1" role="dialog">
    <aside class="modal-dialog modal-dialog-centered" role="document">
        <aside class="modal-content">
            <aside class="p-2">
                <aside class="row">
                    <div class="col-sm-12">
                        <div class="card text-white bg-transparent bordes-ask">
                            <div class="card-header fit-content">
                                <div class="ver_pregunta-user">
                                    <aside class="float-left">
                                        <a href="{{ action('UsuariosControlador@getPerfilPublico', ['nombre' => $ver_pregunta->usuario]) }}"
                                            class="text-muted">
                                            <img src="{{ url('storage/imagenes/usuarios') }}/{{ $usuarios->where('name', $ver_pregunta->usuario)->first()->avatar }}"
                                                class="mr-3 img-thumbnail min-img-perfil" alt="avatar">
                                            <div class="media-body">
                                                <h6>{{ $ver_pregunta->usuario }}</h6>
                                            </div>
                                        </a>
                                    </aside>
                                    <aside class="float-left p-2 texto-pregunta">
                                        <h6 class="card-text ml-3">{{ $ver_pregunta->pregunta }}</h6>
                                    </aside>
                                </div>
                            </div>
                            <div class="card-footer">
                                <aside class="float-left tiempo">
                                    {{ $ver_pregunta->created_at->diffForHumans() }}
                                </aside>
                                <div class="float-right ml-3">
                                    <aside class="float-left btn btn-sm text-white"><i class="{{ Auth::check() ? ($ver_preguntas_like->contains('id_pregunta', $ver_pregunta->id) ? 'color-like' : '') : ''}}
                                    far fa-heart fa-lg"></i>
                                    </aside>
                                    <aside id="contar-likes-{{ $ver_pregunta->id }}" class="float-left likes">
                                        {{ $ver_pregunta->likes }}</aside>
                                </div>
                            </div>
                        </div>
                    </div>
                </aside>
                <aside class="float-left ml-4 mt-3 separador-respuesta"></aside>
                <aside class="float-left respuesta p-3 text-white">{{ $ver_respuesta->respuesta }}</aside>
            </aside>
        </aside>
    </aside>
</aside>
@endif

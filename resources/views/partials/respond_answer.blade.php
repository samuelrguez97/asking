<aside id="responder" class="modal" tabindex="-1" role="dialog">
    <aside class="modal-dialog modal-dialog-centered" role="document">
        <aside class="modal-content">
            <form action="{{ action('PreguntasControlador@sendRespuesta') }}" method="post">
                <div class="text-white header-answer mb-2">
                    <h4 class="float-left">Responder a la pregunta</h4>
                    <button class="btn btn-transparent float-right" data-dismiss="modal">
                        <i class="fa fa-times text-danger" aria-aside="Close" data-toggle="tooltip"
                            data-placement="right" title="Eliminar pregunta"></i>
                    </button>
                </div>
                @csrf
                <aside class="modal-body text-white">
                    <input id="respuesta" type="text" class="form-control" placeholder="Introduce tu respuesta"
                        name="respuesta" data-emojiable="true" data-emoji-input="unicode" value="{{ old('respuesta') }}"
                        required>
                    <input id="send-respuesta-id" type="hidden" name="id_pregunta" value="" />
                </aside>
                <aside class="float-right mt-3 mr-3">
                    <button type="submit" class="btn btn-primary mr-1">Enviar respuesta</button>
                    <button data-dismiss="modal" class="btn btn-secondary">Cancelar</button>
                </aside>
                @if( Session::has('error') )
                <aside class="mt-4 alert alert-danger" role="alert">
                    {{ session('error') }}
                </aside>
                Session::forget('error');
                @endif
            </form>
        </aside>
    </aside>
</aside>

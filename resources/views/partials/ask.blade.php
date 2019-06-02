<div class="card contenedor_pregunta">
    <aside class="text-center">
        <img class="img_ask" src="{{ url('imagenes/favicon/favicon.png') }}">
    </aside>
    <form class=".form_pregunta" action="{{ action('PreguntasControlador@sendPregunta') }}" method="post">

        @csrf
        <label>
            <p class="label-txt">Busca el usuario al que quieres preguntar</p>
            <div class="select mt-4">
                <select id="busqueda_usuario" name="usuario" class="selectpicker" data-live-search="true"
                    title="Escribe el usuario..." data-width="auto" data-size="4">
                    @if (app('request')->input('user') && $usuarios->where('id', app('request')->input('user'))->first())
                    <option
                        data-content="<img src='{{ url('storage/imagenes/usuarios') }}/{{ $usuarios->where('id', app('request')->input('user'))->first()->avatar }}'
                            class='mr-3 rounded min-img-perfil float-left' alt='avatar'><h6 class='float-left'>{{ $usuarios->where('id', app('request')->input('user'))->first()->name }}</h6>"
                        value="{{ $usuarios->where('id', app('request')->input('user'))->first()->name }}" selected>
                    </option>
                    @endif
                    @if (old('usuario'))
                    <option
                        data-content="<img src='{{ url('storage/imagenes/usuarios') }}/{{ $usuarios->where('name', old('usuario'))->first()->avatar }}'
                            class='mr-3 rounded min-img-perfil float-left' alt='avatar'><h6 class='float-left'>{{ $usuarios->where('name', old('usuario'))->first()->name }}</h6>"
                        value="{{ $usuarios->where('name', old('usuario'))->first()->name }}" selected>
                    </option>
                    @endif
                </select>
            </div>
        </label>
        <hr/>
        <label>
            <p id="titulo-pregunta" class="ml-2 ask-txt float-left">Introduce la pregunta</p>
            <input id="pregunta" type="text" class="form-control" name="pregunta" placeholder="Formula tu pregunta"
                data-emojiable="true" data-emoji-input="unicode" value="{{ old('pregunta') }}" max="140">
        </label>
        <div class="clearfix"></div>
        <div id="normas" style="display: none;" class="float-right card w-50 mr-5" style="width: 18rem;">
            <div class="card-body">
                <h5 class="card-title">Normas</h5>
                <h6 class="card-subtitle mb-2 text-muted">Normas de la comunidad</h6>
                <ul class="card-text">
                    <li>Prohibido el uso de palabras susceptibles y/o ofensivas en las preguntas.</li>
                    <li>Ante cualquier indicio de acoso o bulling se eliminara la pregunta.</li>
                    <li>Si la pregunta es considerada ofensiva por parte del usuario tendrá total libertad de
                        eliminarla.</li>
                </ul>
                <a href="#" id="normasCerrar" class="text-white btn btn-info text-center">Cerrar</a>
            </div>
        </div>
        <label class="mt-3">
            <p class="label-txt">Selecciona el tema</p>
            <div class="select mt-4">
                <select id="tema" name="tema" class="selectpicker" title="Seleccione un tema...">
                    @if(isset($temas))
                    @foreach($temas as $tema)
                    @if (old('tema'))
                    @if (old('tema') == $tema->tema)
                    <option selected value="{{ $tema->tema }}">{{ $tema->tema }}</option>
                    @else
                    <option value="{{ $tema->tema }}">{{ $tema->tema }}</option>
                    @endif
                    @else
                    <option value="{{ $tema->tema }}">{{ $tema->tema }}</option>
                    @endif
                    @endforeach
                    @endif
                </select>
            </div>
        </label>
        <label class="fix-height">
            <div id="normas" class="float-left">
                <input type="checkbox" name="normas" {{ old('normas') ? 'checked' : '' }} />
                <span class="terms-size text-white">Estoy de acuerdo con <a href="#" id="normasAbrir">las
                        normas de la
                        comunidad</a> * </span>
            </div>
        </label>
        <div class="clearfix"></div>
        <div class="text-center mt-5">
            <button class="btn btn-success" type="submit" name="submit">Enviar pregunta</button>
        </div>
    </form>
</div>

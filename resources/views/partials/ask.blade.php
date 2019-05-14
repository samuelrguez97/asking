<div class="card contenedor_pregunta">
    <aside class="text-center">
        <img class="img_ask" src="{{ url('imagenes/favicon/favicon.png') }}">
    </aside>
    <form class=".form_pregunta" action="{{ action('PreguntasControlador@sendPregunta') }}" method="post">

        @csrf

        <label>
            <input type="text" class="w-user input text-white" placeholder="Introduce el usuario" name="usuario"
                value="{{ app('request')->input('user') ? app('request')->input('user') : old('usuario') }}">
            <div class="line-box w-user">
                <div class="line"></div>
            </div>
        </label>
        <label>
            <p class="label-txt">O busque el usuario</p>
            <div class="select">
                <select id="busqueda_usuario" name="usuario" class="selectpicker" data-live-search="true" title="Busque al usuario..."></select>
            </div>
        </label>
        <label>
            <input type="text" class="input text-white" name="pregunta" placeholder="Introduce tu pregunta"
                data-emojiable="true" data-emoji-input="unicode" value="{{ old('pregunta') }}">
            <div class="line-box">
                <div class="line"></div>
            </div>
        </label>
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
        <label>
            <p class="label-txt">Selecciona el tema</p>
            <div class="select">
                <select name="tema" class="selectpicker" title="Seleccione un tema...">
                    @if(isset($temas))
                    @foreach($temas as $tema)
                    <option value="{{ $tema->tema }}">{{ $tema->tema }}</option>
                    @endforeach
                    @endif
                </select>
            </div>
        </label>
        <label class="fix-height">
            <div id="normas" class="float-left">
                <input type="checkbox" name="normas" />
                <span class="terms-size text-white">Estoy de acuerdo con <a href="#" id="normasAbrir">las
                        normas de la
                        comunidad</a> * </span>
            </div>
        </label>
        <div class="clearfix"></div>
        <div class="text-center mt-5">
            <button class="btn-sm" id="enviar_pregunta" type="submit" name="submit">Enviar pregunta</button>
        </div>
    </form>
</div>

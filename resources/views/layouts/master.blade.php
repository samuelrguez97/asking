<html lang="es">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="csrf-token" content="{{ csrf_token() }}" />

    <!-- Favicon -->
    <link rel="icon" type="image/png" sizes="32x32" href="{{ url('imagenes/favicon/favicon.png') }}">

    <!-- CSS propio -->
    <link rel="stylesheet" href="{{ url('css/miCSS.css') }}">
    <link rel="stylesheet" href="{{ url('css/botonInicioCSS.css') }}">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{ url('/assets/bootstrap/css/bootstrap.css') }}" integrity="" crossorigin="anonymous">

    <!-- Google Fonts CSS -->
    <link href="https://fonts.googleapis.com/css?family=Asap" rel="stylesheet">

    <!-- Emojis CSS -->
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css" rel="stylesheet">
    <link href="{{ url('emojis/css/emoji.css') }}" rel="stylesheet">

    <!-- Notificaciones CSS -->
    <link href="{{ url('plugins/overhang.js/dist/overhang.min.css') }}" rel="stylesheet">

    <!-- Otros CSS-->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css"
        integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ url('css/buscarCSS.css') }}">
    <link rel="stylesheet" href="{{ url('css/formularioPreguntaCSS.css') }}">

    <!-- Titulo -->
    <title>Asking - {{ Request::path() }}</title>
</head>

<body>
    @include('partials.navbar')
    @include('partials.likes-ajax-form')
    @include('partials.answer-ajax-form')
    <div class="row firefox-height {{ Request::is('home') || Request::is('home/ordenar-likes') ? '' : 'h-100' }}">
        <div class="col-md-10 offset-md-1">
            <div
                class="{{ Request::is('home') || Request::is('home/ordenar-likes') ? 'arregloHome' : '' }} container-contenido margen-fixed h-fit-content colorBackground padding-top-ie">
                @yield('content')
            </div>
        </div>
    </div>

    @include('partials.footer')

    <!-- jQuery primero, luego JQuery UI, despues Popper.js y por ultimo Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.js"
        integrity="sha256-2Kok7MbOyxpgUVvAk/HJ2jigOSYS2auK4Pfzbm7uH60=" crossorigin="anonymous"></script>
    <script src='http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.5/jquery-ui.min.js'></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js"
        integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous">
    </script>
    <script src="{{ url('/assets/bootstrap/js/bootstrap.min.js') }}" integrity="" crossorigin="anonymous"></script>
    <!-- Emojis JS -->
    <script src="{{ url('emojis/js/config.js') }}"></script>
    <script src="{{ url('emojis/js/util.js') }}"></script>
    <script src="{{ url('emojis/js/jquery.emojiarea.js') }}"></script>
    <script src="{{ url('emojis/js/emoji-picker.js') }}"></script>
    <!-- Script insertar emojis en los input -->
    <script>
        $(function () {
            // Initializes and creates emoji set from sprite sheet
            window.emojiPicker = new EmojiPicker({
                emojiable_selector: '[data-emojiable=true]',
                assetsPath: "{{ url('emojis/img/') }}",
                popupButtonClasses: 'fa fa-smile-o text-white set-back'
            });
            // Finds all elements with `emojiable_selector` and converts them to rich emoji input fields
            // You may want to delay this step if you have dynamically created input fields that appear later in the loading process
            // It can be called as many times as necessary; previously converted input fields will not be converted again
            window.emojiPicker.discover();
        });

    </script>
    <!-- Mostrar modal de enviar respuesta -->
    <script>
        $(document).ready(function () {

            var id_pregunta = $('#boton-env-resp').data("id-pregunta");
            $("#send-respuesta-id").val(id_pregunta);

        });

    </script>
    <!-- Notificaciones JS -->
    <script src="{{ url('plugins/overhang.js/dist/overhang.min.js') }}"></script>
    <!-- Mis JavaScript -->
    <script src="{{ url('js/miJS.js') }}"></script>
    <script src="{{ url('js/likes.js') }}"></script>
    <script src="{{ url('js/answer.js') }}"></script>
    <script src="{{ url('js/scroll.js') }}"></script>
    <script src="{{ url('js/cargar-emojis-respuesta.js') }}"></script>
</body>

</html>

<html lang="es">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Favicon -->
    <link rel="icon" type="image/png" sizes="32x32" href="{{ url('imagenes/favicon/favicon.png') }}">

    <!-- CSS propio -->
    <link rel="stylesheet" href="{{ url('css/miCSS.css') }}">
    <link rel="stylesheet" href="{{ url('css/botonInicioCSS.css') }}">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{ url('/assets/bootstrap/css/bootstrap.css') }}" integrity="" crossorigin="anonymous">

    <!-- Google Fonts CSS -->
    <link href="https://fonts.googleapis.com/css?family=Asap" rel="stylesheet">

    <!-- Otros CSS-->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU"
        crossorigin="anonymous">
    <link rel="stylesheet" href="{{ url('css/buscarCSS.css') }}">
    <link rel="stylesheet" href="{{ url('css/formularioPreguntaCSS.css') }}">

    <!-- Titulo -->
    <title>Asking - {{ Request::path() }}</title>
</head>

<body>
    @include('partials.navbar')

    <div class="margen-fixed container-fluid h-fit-content w-fit-content colorBackground">
        @yield('content')
    </div>

    @include('partials.footer')
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.js" integrity="sha256-2Kok7MbOyxpgUVvAk/HJ2jigOSYS2auK4Pfzbm7uH60="
        crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut"
        crossorigin="anonymous"></script>
    <script src="{{ url('/assets/bootstrap/js/bootstrap.min.js') }}" integrity="" crossorigin="anonymous"></script>
    <!-- Optional JavaScript -->
    <script src="{{ url('js/miJS.js') }}"></script>
</body>

</html>

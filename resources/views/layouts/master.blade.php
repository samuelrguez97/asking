<html lang="es">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- CSS propio -->
    <link rel="stylesheet" href="css/miCSS.css">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{ url('/assets/bootstrap/css/bootstrap.min.css') }}" integrity="" crossorigin="anonymous">
  
    <title>Asking</title>
  </head>
  <body>
  @include('partials.navbar')
	
	<div class="container-fluid h-100 colorBackground d-flex">
		@yield('content')
	</div>

  @include('partials.footer')
    <!-- Optional JavaScript -->
		<script src="js/miJS.js"></script>
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>
    <script src="{{ url('/assets/bootstrap/js/bootstrap.min.js') }}" integrity="" crossorigin="anonymous"></script>
  </body>
</html>
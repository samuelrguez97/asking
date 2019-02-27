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
		<div class="container-fluid colorBackground text-white d-flex h-100 align-items-center" >
			<div class="mx-auto text-center">
				<img src="https://i.ibb.co/GQjFrd9/logo.png" alt="logo">			
				<h2 class="text-white-50 mx-auto mt-2 mb-5">Tu web de preguntas anónimas</h2>
				<hr class="my-4">
				<!-- Boton del modal -->
				@if ( Auth::check() )
				<a class="botonInicio" id="botonInicio" href=" {{ action('PreguntasControlador@principal') }} ">
					Empezar
				</a>
				@else
				<a class="botonInicio" id="botonInicio" data-toggle="modal" data-target="#empezar">
					Empezar
				</a>
				@endif
			</div>
		</div>
		<!-- Footer -->
		<div class="content colorBackground-darker text-white">
			<footer class="page-footer font-small">
			<!-- Copyright -->
			<div class="footer-copyright text-center py-3">© 2019 Copyright:
				<a href="#" >Asking | Samuel Rodríguez Aguilar</a>
			</div>
			<!-- Copyright -->
			</footer>
		</div>
		<!-- Footer -->
		<!-- Modal -->
		<div class="modal fade" id="empezar" tabindex="-1" role="dialog" aria-labelledby="empezar" aria-hidden="true">
			<div class="modal-dialog modal-dialog-centered" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="empezar">¿Qué deseas hacer?</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<div class="modal-body">
						<p>Puedes <a href="{{ url('/register') }}">registrarte</a>, o si ya tienes cuenta <a href="{{ url('/login') }}">entrar</a>.</p>
						<p>¡O puedes dirigirte a realizar preguntas ahora mismo!</p>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
						<a type="button" class="btn btn-primary" href="/asking/public/home">Empezar a preguntar</a>
					</div>
				</div>
			</div>
		</div>
		<!-- Modal -->
		<!-- Optional JavaScript -->
		<script src="js/miJS.js"></script>
		<!-- jQuery first, then Popper.js, then Bootstrap JS -->
		<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>
		<script src="{{ url('/assets/bootstrap/js/bootstrap.min.js') }}" integrity="" crossorigin="anonymous"></script>
  </body>
</html>
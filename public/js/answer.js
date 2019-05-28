// Defino el método que se dispara al dar el boton answer
$('.answer').on("click", function (e) {

    // Metodo para prevenir que la página recargue
    e.preventDefault();

    // Recojo el id de la pregunta desde el atributo data que está definido
    var id_pregunta = $(this).data('idPregunta');
    // Asigno a una varaible el formulario
    var form = $('#form-answer');
    // Reemplaza en el atributo action la parte final de la URL que se completa con el id de la pregunta
    var url = form.attr('action').replace(':id_pregunta', id_pregunta);
    // Serializo el formulario para enviarlo por ajax
    var data = form.serialize();

    var anterior_content;

    // Paso el token de seguridad csrf del formulario a la peticion ajax (método de seguridad)
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
    });

    // Realizo la peticion ajax
    $.ajax({
        url: url, // le paso la url asociada al método del controlador
        type: "POST", // digo que  es de tipo POST el envío
        data: data, // le paso los datos serializados

        beforeSend: function () {
            $('#verRespuesta').modal('show');
            anterior_content = $('.modal-content').html();
            $('.modal-content').css('width', '25%');
            $('.modal-content').html('<div class="text-center text-warning p-3"><div class="mb-2">Cargando...</div><div class="spinner-border" role="status"></div></div>');
        },
        success: function (data) { // en caso de hacer la peticion correctamente ..
            // recibo los datos y se asignan la variable data
            // hecho esto, asocio todos los datos y los implemento a sus respectivos campos para mostrar la pregunta y la respuesta
            $('.modal-content').css('width', '100%');
            $('.modal-content').html(anterior_content);
            $('#rProfile-user').attr('href', 'http://localhost/asking/public/perfil-publico/' + data.nombre);
            $('#rNombre').html(data.nombre);
            $('#rImagen').attr('src', 'http://localhost/asking/public/storage/imagenes/usuarios/' + data.imagen[0]);
            $('#respuesta').html(data.respuesta.respuesta);
            $('#rTemaA').attr('href', 'http://localhost/asking/public/temas/' + data.pregunta.tema);
            $('#rTema').html(data.pregunta.tema);
            $('#rTiempo').html(data.tiempo);
            $('#rLike').attr('data-id-pregunta', data.pregunta.id);
            $('#rLike').attr('data-token', data.token);
            $('#rLikeI').attr('class', data.clase_like);
            $('#rLikes').html(data.pregunta.likes == 0 ? "" : data.pregunta.likes);
            $('#rPregunta').html(data.pregunta.pregunta);


        },
        error: function () { // si no se hace correctamente lanzo un mensaje de error desconocido para feedback del usuario
            $("body").overhang({
                type: "error",
                message: "Ha ocurrido un error, inténtelo de nuevo",
                duration: 1
            });
        }
    });

});

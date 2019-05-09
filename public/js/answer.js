$(document).ready(function () {

    // Defino el método que se dispara al dar el boton like
    $('.answer').click(function (e) {

        // Metodo para prevenir que la página recargue
        e.preventDefault();

        // Recojo el id de la pregunta desde el atributo data que está definido
        var id_pregunta = $(this).data('idPregunta');
        // Asigno a una varaible el formulario
        var form = $('#form-answer');
        // Meto el boton que ejecuta la acción en una variable
        var boton = $(this);
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
            beforeSend: function() {
                $('#verRespuesta').modal('show');
                anterior_content = $('.modal-content').html();
                $('.modal-content').html('<div class="text-center p-3"><div class="spinner-border text-warning" role="status"></div></div>');
            },
            success: function (data) { // en caso de hacer la peticion correctamente ..
                // recibo los datos y se asignan la variable data
                $('.modal-content').html(anterior_content);
                $('#respuesta').html(JSON.stringify(data.respuesta.respuesta));
                
            },
            error: function () { // si no se hace correctamente es por un 401 unauthorithed, debido a que no hay usuario activo
                // muestro una notificacion del plugin overhang
                $("body").overhang({
                    type: "error",
                    message: "Debes estar registrado.",
                    duration: 1
                });
            }
        });

    });
});

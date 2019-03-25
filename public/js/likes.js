$(document).ready(function () {
    
    // Defino el método que se dispara al dar el boton like
    $('.like').click(function (e) {

        // Metodo para prevenir que la página recargue
        e.preventDefault();

        // Recojo el id de la pregunta desde el atributo data que está definido
        var id_pregunta = $(this).data('idPregunta');
        // Asigno a una varaible el formulario
        var form = $('#form-like');
        // Meto el boton que ejecuta la acción en una variable
        var boton = $(this);
        // Reemplaza en el atributo action la parte final de la URL que se completa con el id de la pregunta
        var url = form.attr('action').replace(':id_pregunta', id_pregunta);
        // Serializo el formulario para enviarlo por ajax
        var data = form.serialize();
        
        // Paso el token de seguridad csrf del formulario a la peticion ajax (método de seguridad de laravel)
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
            success: function (data) { // en caso de hacer la peticion correctamente ..
                // recibo los datos y se asignan  la variable data

                // compruebo si la acción es like o dislike
                if (data == 'like') {
                    // en caso de ser like cambio el corazon a uno coloreado y sumo 1 like en ese momento para feedback del usuario
                    boton.find("img").attr("src", "https://img.icons8.com/color/48/000000/filled-like.png");
                    boton.next().html(parseInt(boton.next().html(), 10) + 1);
                } else {
                    // en caso de ser dislike cambio el corazon a uno vacio y resto 1 like en ese momento para feedback del usuario
                    boton.find("img").attr("src", "https://img.icons8.com/like");
                    boton.next().html(parseInt(boton.next().html(), 10) - 1);
                }

            },
            error: function () { // si no se hace correctamente es por un 401 unauthorithed, debido a que no hay usuario activo
                // muestro una notificacion del plugin overhang
                $("body").overhang({ 
                    type: "error",
                    message: "Debes estar registrado.",
                    closeConfirm: "true"
                  });
            }

        });

    });
});

// Defino el método que se dispara al dar el boton like
$(document).on("click", ".like", function (e) {
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
        success: function (data) { // en caso de hacer la peticion correctamente ..
            // recibo los datos y se asignan la variable data

            // compruebo si la acción es like o dislike
            if (data == 'like') {
                // en caso de ser like cambio el corazon a uno coloreado y sumo 1 like en ese momento para feedback del usuario
                // Compruebo si se da like desde el modal
                var atribId = boton.attr("id");

                if (typeof atribId !== typeof undefined && atribId !== false && atribId == "rLike") {
                    // Si es asi cambio el like exterior asociado a este like y su pregunta correspondiente para un mayor feedback del usuario
                    boton2 = $("button[data-id-pregunta='" + boton.attr('data-id-pregunta') + "'][class='float-left btn btn-sm like text-white']").first();
                    boton2.find("i").addClass("color-like fas");
                    boton2.find("i").removeClass("far");
                    // Compruebo si el contador de likes esta vacio (es decir es igual a 0) para actuar con concordancia
                    var htmlLikes = boton2.next().html() == "" ? 1 : parseInt(boton2.next().html()) + 1;
                    boton2.next().html(htmlLikes).animate({
                        fontSize: '+=2'
                    }, 100).animate({
                        fontSize: '-=2'
                    }, 100);
                }
                // y cambio el color del like dado
                boton.find("i").addClass("color-like fas");
                boton.find("i").removeClass("far");
                // Compruebo si el contador de likes esta vacio (es decir es igual a 0) para actuar con concordancia
                var htmlLikes = boton.next().html() == "" ? 1 : parseInt(boton.next().html()) + 1;
                boton.next().html(htmlLikes).animate({
                    fontSize: '+=2'
                }, 100).animate({
                    fontSize: '-=2'
                }, 100);
            } else {
                // en caso de ser dislike cambio el corazon a uno vacio y resto 1 like en ese momento para feedback del usuario
                // Compruebo si se da dis-like desde el modal
                var atribId = boton.attr("id");

                if (typeof atribId !== typeof undefined && atribId !== false && atribId == "rLike") {
                     // Si es asi cambio el like exterior asociado a este like y su pregunta correspondiente para un mayor feedback del usuario
                    boton2 = $("button[data-id-pregunta='" + boton.attr('data-id-pregunta') + "'][class='float-left btn btn-sm like text-white']").first();
                    boton2.find("i").removeClass("color-like fas");
                    boton2.find("i").addClass("far");
                    // Compruebo si el contador de likes esta a 1 para actuar con concordancia
                    var htmlLikes = boton2.next().html() == 1 ? "" : parseInt(boton.next().html()) - 1;
                    boton2.next().html(htmlLikes).animate({
                        fontSize: '-=2'
                    }, 100).animate({
                        fontSize: '+=2'
                    }, 100);
                }

                // y cambio el color del like dado
                boton.find("i").removeClass("color-like fas");
                boton.find("i").addClass("far");
                // Compruebo si el contador de likes esta a 1 para actuar con concordancia
                var htmlLikes = boton.next().html() == 1 ? "" : parseInt(boton.next().html()) - 1;
                boton.next().html(htmlLikes).animate({
                    fontSize: '-=2'
                }, 100).animate({
                    fontSize: '+=2'
                }, 100);
            }
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


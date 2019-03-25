$(document).ready(function () {
    
    $('.like').click(function (e) {

        // Metodo para hacer que la página no recargue
        e.preventDefault();

        var id_pregunta = $(this).data('idPregunta');
        var form = $('#form-like');
        var boton = $(this);
        var url = form.attr('action').replace(':id_pregunta', id_pregunta);
        var data = form.serialize();
        
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
        });

        $.ajax({
            url: url,
            type: "POST",
            data: data,
            processData: false,
            contentType: false,
            success: function (data) {
                
                if (data == 'like') {
                    boton.find("img").attr("src", "https://img.icons8.com/color/48/000000/filled-like.png");
                    boton.next().html(parseInt(boton.next().html(), 10) + 1);
                } else {
                    boton.find("img").attr("src", "https://img.icons8.com/like");
                    boton.next().html(parseInt(boton.next().html(), 10) - 1);
                }

            },
            error: function () {
                $("body").overhang({
                    type: "error",
                    message: "Debes estar registrado.",
                    closeConfirm: "true"
                  });
            }

        });

    });
});

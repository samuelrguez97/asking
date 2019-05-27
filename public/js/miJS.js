$(document).ready(function () {

    $(function () {
        $('[data-toggle="tooltip"]').tooltip()
    })

    $(function () {
        $('[data-toggle="popover"]').popover()
    })

    $('.input').focus(function () {
        $(this).parent().find(".label-txt").addClass('label-active');
    });

    $(".input").focusout(function () {
        if ($(this).val() == '') {
            $(this).parent().find(".label-txt").removeClass('label-active');
        };
    });

    $('div[class="select"]').click(function () {
        $('option[value="Selecciona"]').attr("disabled", "disabled");
    });

    $('#normasAbrir').click(function () {
        $('#normas').slideToggle('slow');
    });

    $('#normasCerrar').click(function () {
        $('#normas').slideUp('slow');
    });

    $('#opciones-cuenta').click(function () {
        $('#opciones-cuenta').toggleClass('fa-sort-down');
        $('#opciones-cuenta').toggleClass('fa-sort-up');
        $('#opciones').slideToggle('slow');
    });

});

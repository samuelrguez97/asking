$(document).ready(function () {

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

});

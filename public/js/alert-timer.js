// Defino el metodo que hace desaparecer las alertas despues de unos segundos
$(document).ready(function() {
    if ($(".alert-danger").length != 0) {
        $(".alert-danger").fadeTo(2000, 500).slideUp(500, function(){
            $(".alert-danger").slideUp(500);
        });
    }
    if ($(".alert-success").length != 0) {
        $(".alert-success").fadeTo(2000, 500).slideUp(500, function(){
            $(".alert-success").slideUp(500);
        });
    }
});
$(document).ready(function(){
    var pageURL = $(location).attr("href");
    if (pageURL == 'http://localhost/asking/public/home?' || pageURL == 'http://localhost/asking/public/home/ordenar-likes') {
        $('#tituloPreguntas')[0].scrollIntoView();
    }
});
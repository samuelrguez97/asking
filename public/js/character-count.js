// Defino el método que cuenta el número de carácteres en un input
$(document).on("keyup", '.emoji-wysiwyg-editor', function (e) {
    var size = $(this).text().length;
    if (size != 0) {
        if ($("#badge-char").length == 0) {
            var badge = document.createElement("span");
            badge.setAttribute("id", "badge-char");
            badge.setAttribute("class", "badge badge-primary float-left mt-2 ml-2");
            badge.textContent = size+"/140";
            $(".emoji-picker-icon").before(badge);
        } else {
            var n = parseInt($("#badge-char").text());
            if ($(this).text().length < n) {
                var dif = n-$(this).text().length;
                $("#badge-char").html(n-dif+"/140");
            } else {
                var dif = $(this).text().length-n;
                $("#badge-char").html(n+dif+"/140");
            }
        }
    } else {
        if ($("#badge-char").length != 0) {
            $("#badge-char").remove();
        }
    }
});

$(document).ready(function() {
    if ($("#old-badge-char").length != 0) {
        var oldAsk = $(".emoji-wysiwyg-editor").text().length;
        $("#old-badge-char").html(oldAsk+"/140");
        $("#old-badge-char").attr("id", "badge-char");
    }
});
$(document).ready(function () {
    var icon_cookie = getCookie("index-icon");
    var edit_image = getCookie("edit-image");
    
    //Cookie inicio index
    if (icon_cookie == 1) {
        $(".icon-bars").click();
    } else if (icon_cookie == 2) {
        $(".icon-images").click();
    }

    //Cookie edit image
    if (edit_image == 0) {
        $('.int-input-check').prop('checked', false);
        $(".div-form-imagen").hide();
    } else if (edit_image == 1) {
        $('.int-input-check').prop('checked', true);
        $(".div-form-imagen").show();
    }

    //Modal
    $(".open-modal-img").click(function () {
        var nombre = $(this).children(".modal-juego-nombre").val();
        var desarrolladora = $(this).children(".modal-juego-desarrolladora").val();
        var desarrolladora_slug = $(this).children(".modal-juego-desarrolladora-slug").val();
        var generos = [],
        inputs = $(this).children('input[type="hidden"].modal-juego-genero');
        for (var i = 0; i < inputs.length; i++) {
          generos.push(inputs[i].value);
        }
        var generos_slugs = [],
        inputs = $(this).children('input[type="hidden"].modal-juego-genero-slug');
        for (var i = 0; i < inputs.length; i++) {
          generos_slugs.push(inputs[i].value);
        }
   
        var descripcion = $(this).children(".modal-juego-descripcion").val();
        var slug = $(this).children(".modal-juego-slug").val();
        var fecha = $(this).children(".modal-juego-fecha").val();

        $(".JuegoModalNombre").text(nombre);
        $(".JuegoModalDesarrolladora").text(desarrolladora);
        $(".JuegoModalDesarrolladora").attr("href", "/desarrolladora/"+ desarrolladora_slug)
        $(".JuegoModalDescripcion").text(descripcion);
        var frase = "'¿ Estas seguro de eliminar el juego "+nombre+" ?'";
        $('.modal-button-danger').attr('onclick', 'return confirm('+frase+')');
        $(".JuegoModalGeneros").empty();
        for (var i = 0; i < generos.length; i++) {
          $(".JuegoModalGeneros").append("<a href='/genero/"+generos_slugs[i]+"' class='tags-generos'>"+generos[i]+'</a>');
        }
        $(".JuegoModalFecha").text(fecha);
        $(".modal-button-warning").attr("href", "/juegos/" + slug);
        $(".modal-button-danger").attr("href", "/juegos/delete/" + slug);

    });


    //Button interruptor edit imagen
    $(".slider").click(function () {
        var expiryDate = new Date();
        if ($('.int-input-check').is(':checked')) {
            $(".div-form-imagen").hide();
            document.cookie = "edit-image=0;" + expiryDate.setMonth(expiryDate.getMonth() + 1) + "; path=/";
        } else {
            $(".div-form-imagen").show();
            document.cookie = "edit-image=1;" + expiryDate.setMonth(expiryDate.getMonth() + 1) + "; path=/";
        }   

    });

    //Bootrap multiselect
    var multipleCancelButton = new Choices('#choices-multiple-remove-button', {
        removeItemButton: true,
        maxItemCount:5,
        searchResultLimit:5,
        renderChoiceLimit:0
    });

});

//Eliminar valores duplicados del multiselect
$("#choices-multiple-remove-button option").val(function(idx, val) {
  $(this).siblings('[value="'+ val +'"]').remove();
});

//Obtener el valor de la cookie
function getCookie(c_name) {
    var c_value = document.cookie,
        c_start = c_value.indexOf(" " + c_name + "=");
    if (c_start == -1) c_start = c_value.indexOf(c_name + "=");
    if (c_start == -1) {
        c_value = null;
    } else {
        c_start = c_value.indexOf("=", c_start) + 1;
        var c_end = c_value.indexOf(";", c_start);
        if (c_end == -1) {
            c_end = c_value.length;
        }
        c_value = unescape(c_value.substring(c_start, c_end));
    }
    return c_value;
}

$(".alert").click(function () {
    $(".alert").remove();
});

//Input type=file
$(document).on('click', '.upload-field', function () {
    var file = $(this).parent().parent().parent().find('.input-file');
    file.trigger('click');
});

$(document).on('change', '.input-file', function () {
    $(this).parent().find('.form-control').val($(this).val().replace(/C:\\fakepath\\/i, ''));
});

//Index-1
$(".icon-bars").click(function () {
    $("#index-1").css("display", "block");
    $("#index-2").css("display", "none");
    $(".div-icons-bars-images").css("margin-left", "0px");
    $(".div-form-search").css("margin-right", "0px");
    $(".icon-bars").css("color", "#ffc107");
    $(".icon-images").css("color", "white");
    var expiryDate = new Date();
    document.cookie = "index-icon=1;" + expiryDate.setMonth(expiryDate.getMonth() + 1) + "; path=/";
});

//Index-2
$(".div-icon-images").click(function () {
    $("#index-1").css("display", "none");
    $("#index-2").css("display", "inline-block");
    $(".div-icons-bars-images").css("margin-left", "20px");
    $(".div-form-search").css("margin-right", "20px");
    $(".icon-bars").css("color", "white");
    $(".icon-images").css("color", "#ffc107");
    var expiryDate = new Date();
    document.cookie = "index-icon=2;" + expiryDate.setMonth(expiryDate.getMonth() + 1) + "; path=/";
});
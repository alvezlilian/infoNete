
function muestraEdiciones(idPublicacion) {
    var parametros = {
        "publicacion" : idPublicacion
    };
    $.ajax({
        data:  parametros,
        url:   '/contenidista/obtenerPublicaciones',
        type:  'POST',
        beforeSend: function () {
        },
        success:  function (response) {
            $("#edicion").html(response);
        },
        error: function (){
            alert("error");
        }
    });
}
function muestraSecciones(idEdicion) {
    var parametros = {
        "edicion" : idEdicion
    };
    $.ajax({
        data:  parametros,
        url:   '/contenidista/obtenerSecciones',
        type:  'POST',
        beforeSend: function () {
        },
        success:  function (response) {
            $("#seccion").html(response);
        },
        error: function (){
            alert("error");
        }
    });
}
/*function obtenerIdPublicacion(idPublicacion) {
    var parametros = {
        "idPublicacion" : idPublicacion
    };
    $.ajax({
        data:  parametros,
        url:   '/lector/verEdiciones',
        type:  'POST',
        success:  function (data) {
        },
        error: function (){
            alert("error");
        }
    });
}*/
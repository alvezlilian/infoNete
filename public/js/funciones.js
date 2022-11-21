
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
/*function obtenerIdPublicacion(idPublicacion,funcion) {
    controller='/contenidista/'
    var parametros = {
        "idPublicacion" : idPublicacion,
        "funcion": controller+funcion+"Publicacion"
    };
    $.ajax({
        data:  parametros,
        url:   parametros["funcion"],
        type:  'POST',
        beforeSend: function () {
        },
        success:  function () {
        },
        error: function (){
            alert("error");
        }
    });
}*/
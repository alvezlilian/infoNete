
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
function muestraEdicionesANotas(idPublicacion) {
    var parametros = {
        "publicacion" : idPublicacion
    };
    $.ajax({
        data:  parametros,
        url:   '/contenido/obtenerPublicaciones',
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
function muestraSeccionesANotas(idEdicion) {
    var parametros = {
        "edicion" : idEdicion
    };
    $.ajax({
        data:  parametros,
        url:   '/contenido/obtenerSecciones',
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

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

//funciones del editor de texto

    tinymce.init({
    selector: '#contenidoNoticia',
    plugins: 'anchor autolink charmap codesample emoticons image link lists media searchreplace table visualblocks wordcount checklist mediaembed casechange export formatpainter pageembed linkchecker a11ychecker tinymcespellchecker permanentpen powerpaste advtable advcode editimage tinycomments tableofcontents footnotes mergetags autocorrect',
    toolbar: 'undo redo | blocks fontfamily fontsize | bold italic underline strikethrough | link image media table mergetags | addcomment showcomments | spellcheckdialog a11ycheck | align lineheight | checklist numlist bullist indent outdent | emoticons charmap | removeformat',
    tinycomments_mode: 'embedded',
    tinycomments_author: 'Author name',
    mergetags_list: [
{ value: 'First.Name', title: 'First Name' },
{ value: 'Email', title: 'Email' },
    ],
});
    function guardarContenido() {
    var x = tinymce.get("contenidoNoticia").getContent();
    document.getElementById("demo").innerHTML = x;
    console.log(x)
}

function pararEnvio() {

    document.getElementById("formContenido").addEventListener("click", function(event){
        event.preventDefault() });
    var x = tinymce.get("contenidoNoticia").getContent();
    var y = document.getElementById("prueba").value = x;
    if (document.getElementById("prueba").value != "") {
        document.getElementById("formContenido").submit();
        alert("se creo la noticia")

    } else {
       document.getElementById("msj").innerHTML = "El contenido es obligatorio"
 console.log(document.getElementById("imagenVieja").value)
    }
    }

function muestraSeccionesContenidista(idEdicion) {
    var parametros = {
        "edicion" : idEdicion
    };
    $.ajax({
        data:  parametros,
        url:   '/contenidista/obtenerSeccionesContenidista',
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
function muestraNotas(idSeccion){
    var parametros = {
        "seccion" : idSeccion
    };
    $.ajax({
        data:  parametros,
        url:   '/contenidista/obtenerNotas',
        type:  'POST',
        beforeSend: function () {
        },
        success:  function (response) {
            $("#notas").html(response);
        },
        error: function (){
            alert("error");
        }
    });
}



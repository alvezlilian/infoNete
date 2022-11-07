$(document).ready(function () {
    if (window.XMLHttpRequest) {
        xmlhttp=new XMLHttpRequest();
    } else {
        xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
    }
    xmlhttp.onreadystatechange=function() {
        if (this.readyState==4 && this.status==200) {
            document.getElementById("seccionNoticia").innerHTML=this.responseText;
        }
    }
    xmlhttp.open("POST","ContenidoController.php/secciones=",true);
    xmlhttp.send();});

}
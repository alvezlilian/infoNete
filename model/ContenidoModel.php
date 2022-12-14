<?php

class ContenidoModel {
    private $database;

    public function __construct($database) {
        $this->database = $database;
    }
    public function getSeccionesInexistenes($idEdicion){
        $sql= "SELECT * FROM seccion where id not in(select idSeccion from edicion_seccion where idEdicion='$idEdicion')";
        return $this->database->query($sql);
    }
    public function getSeccionesDeLaEdicion($idEdicion){
        $sql= "SELECT * FROM seccion where id in(select idSeccion from edicion_seccion where idEdicion='$idEdicion')";
        return $this->database->query($sql);
    }
public function getSecciones(){
    $sql = 'SELECT * FROM seccion';
    return $this->database->query($sql);

}
    public function getPublicaciones() {
        $sql = 'SELECT * FROM publicacion';
        return $this->database->query($sql);
    }

    public function getEdicionesxIdPublicacion($idPublicacion){
        $sql = "SELECT * FROM edicion where edicion.idPublicacion='$idPublicacion'";
        return $this->database->query($sql);

    }
    public function getContenido($idEscritor){
        $sql = "SELECT nota.* ,edicion.descrip as descripEdicion,seccion.descrip 
        as descripSeccion,estadodepublicacion.Estado as estado, publicacion.informacion AS publicacion
                FROM nota JOIN seccion ON nota.idSeccion=seccion.id 
                    JOIN edicion on nota.idEdicion=edicion.id
                    JOIN publicacion on edicion.idPublicacion=publicacion.id
                    join estadodepublicacion on estadodepublicacion.id = nota.idEstado 
                WHERE nota.idEscritor='$idEscritor' and estadodepublicacion.Estado='pendiente'";

        return $this->database->query($sql);

    }
    public function nuevaNoticia($tituloNoticia, $subtitulo, $edicion, $seccionNoticia, $precioNoticia, $descripcionNoticia, $archivo,$link,$idUsuario){

       $valor=1;

        $sql="INSERT INTO nota( Titulo, Subtitulo, contenido, idSeccion, idEdicion,precio,Imagen,idEstado,link,idEscritor)
                    VALUES ('$tituloNoticia','$subtitulo','$descripcionNoticia','$seccionNoticia','$edicion','$precioNoticia','$archivo','$valor','$link',$idUsuario)";
                   $this->database->execute($sql);


    }
    public function EditNota($id){
        $sql = "SELECT nota.* ,edicion.descrip as descripEdicion,seccion.descrip as descripSeccion,estadodepublicacion.Estado as Estado FROM nota 
                 JOIN seccion ON nota.idSeccion=seccion.id 
                JOIN edicion on nota.idEdicion=edicion.id 
                 join estadodepublicacion on estadodepublicacion.id = nota.idEstado 
                  WHERE nota.id='$id'";
        return $this->database->query($sql);
    }
    public function actualizarNota($id,$tituloNoticia, $subtitulo, $precioNoticia, $descripcionNoticia, $archivo,$link){
        $sql="UPDATE nota 
              SET Titulo='$tituloNoticia',Subtitulo='$subtitulo',Imagen='$archivo',`contenido`='$descripcionNoticia',`link`='$link',`precio`='$precioNoticia'
              WHERE id='$id'";
        return $this->database->execute($sql);
    }

    public function eliminarNota($id){
        $sql="DELETE FROM nota WHERE id=$id";
      return  $this->database->execute($sql);
    }



}
<?php

class ContenidoModel {
    private $database;

    public function __construct($database) {
        $this->database = $database;
    }
public function getSecciones(){
    $sql = 'SELECT * FROM seccion';
    return $this->database->query($sql);

}

    public function getEdiciones(){
        $sql = 'SELECT * FROM edicion';
        return $this->database->query($sql);

    }
    public function getContenido(){
        $sql = "SELECT nota.* ,edicion.descrip as descripEdicion,seccion.descrip as descripSeccion,estadodepublicacion.Estado as estado 
                FROM nota JOIN seccion ON nota.idSeccion=seccion.id 
                JOIN edicion on nota.idEdicion=edicion.id 
             join estadodepublicacion on estadodepublicacion.id = nota.idEstado";

        return $this->database->query($sql);

}
public function nuevaNoticia($tituloNoticia, $subtitulo, $edicion, $seccionNoticia, $precioNoticia, $descripcionNoticia, $archivo,$link){

       $valor=1;

        $sql="INSERT INTO nota( Titulo, Subtitulo, contenido, idSeccion, idEdicion,precio,Imagen,idEstado,link)
                    VALUES ('$tituloNoticia','$subtitulo','$descripcionNoticia','$seccionNoticia','$edicion','$precioNoticia','$archivo','$valor','$link')";
                   $this->database->execute($sql);


    }
    public function EditNota($id){
        $sql = "SELECT nota.* ,edicion.descrip as descripEdicion,seccion.descrip as descripSeccion,estadodepublicacion.Estado as estado FROM nota 
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
<?php

class ContenidoModel {
    private $database;

    public function __construct($database) {
        $this->database = $database;
    }
public function getSecciones(){
    $sql = 'SELECT * FROM infonete.seccion';
    return $this->database->query($sql);

}

    public function getEdiciones(){
        $sql = 'SELECT * FROM infonete.edicion';
        return $this->database->query($sql);

    }
    public function getContenido(){
        $sql = 'SELECT * FROM infonete.nota JOIN infonete.seccion ON nota.idSeccion=seccion.id 
                                            JOIN infonete.edicion on nota.idEdicion=edicion.id 
                                            join infonete.estadodepublicacion on estadodepublicacion.id = nota.idEstado';
        return $this->database->query($sql);

}
public function nuevaNoticia($tituloNoticia, $subtitulo, $edicion, $seccionNoticia, $precioNoticia, $descripcionNoticia, $archivo,$link){

       $valor=1;

        $sql="INSERT INTO infonete.nota( Titulo, Subtitulo, contenido, idSeccion, idEdicion,precio,Imagen,idEstado,link)
                    VALUES ('$tituloNoticia','$subtitulo','$descripcionNoticia','$seccionNoticia','$edicion','$precioNoticia','$archivo','$valor','$link')";
                   $this->database->execute($sql);


    }
    public function EditNota($id){
        $sql = "SELECT * FROM infonete.nota JOIN infonete.seccion ON nota.idSeccion=seccion.id 
                                            JOIN infonete.edicion on nota.idEdicion=edicion.id 
                                            join infonete.estadodepublicacion on estadodepublicacion.id = nota.idEstado
                                            WHERE nota.idNota='$id'";
        return $this->database->query($sql);
    }
    public function actualizarNota($id,$tituloNoticia, $subtitulo, $precioNoticia, $descripcionNoticia, $archivo,$link){
        $sql="UPDATE infonete.nota 
              SET Titulo='$tituloNoticia',Subtitulo='$subtitulo',Imagen='$archivo',`contenido`='$descripcionNoticia',`link`='$link',`precio`='$precioNoticia'
              WHERE idNota='$id'";
        return $this->database->execute($sql);
    }

    public function eliminarNota($id){
        $sql="DELETE FROM infonete.nota WHERE idNota=$id";
      return  $this->database->execute($sql);
    }



}
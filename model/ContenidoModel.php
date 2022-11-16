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
        $sql = 'SELECT * FROM infonete.nota';
        return $this->database->query($sql);

}
public function nuevaNoticia($tituloNoticia,$subtitulo,$edicion,$seccionNoticia,$precioNoticia,$descripcionNoticia,$archivo){
       $sqlEstado="SELECT `id`FROM infonete.estadodepublicacion WHERE Estado='pendiente'";
       $estado=$this->database->query($sqlEstado);
       $valor=1;

        $sql="INSERT INTO infonete.nota( Titulo, Subtitulo, contenido, idSeccion, idEdicion,precio,Imagen,idEstado)
                    VALUES ('$tituloNoticia','$subtitulo','$descripcionNoticia','$seccionNoticia','$edicion','$precioNoticia','$archivo','$valor')";
                    $this->database->execute($sql);


    }


}
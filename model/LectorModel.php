<?php

class LectorModel
{
    private $database;

    public function __construct($database)
    {
        $this->database = $database;
    }
    //Consultas
    public function getPublicaciones() {
        $sql = 'SELECT * FROM publicacion';
        return $this->database->query($sql);
    }
    public function getEdicionesxId($idPublicacion){
        $sql = "SELECT * FROM edicion where idPublicacion='$idPublicacion'";
        return $this->database->query($sql);
    }
    public function getNotas(){
        $sql="SELECT nota.* ,edicion.descrip as descripEdicion,seccion.descrip as descripSeccion,
                publicacion.informacion as publicacion
                FROM nota JOIN seccion ON nota.idSeccion=seccion.id 
                JOIN edicion on nota.idEdicion=edicion.id 
                JOIN estadodepublicacion on estadodepublicacion.id=nota.idEstado
         		JOIN publicacion on publicacion.id=edicion.idPublicacion
                WHERE estadodepublicacion.id=1";
        $result = $this->database->Query($sql);
        shuffle($result);
        return $result;
    }
    public function getNotaCompletaxIdNota($idNota){
        $sql="SELECT nota.* ,edicion.descrip as descripEdicion,seccion.descrip as descripSeccion,publicacion.informacion as publicacion
                FROM nota JOIN seccion ON nota.idSeccion=seccion.id 
                JOIN edicion on nota.idEdicion=edicion.id 
                JOIN estadodepublicacion on estadodepublicacion.id=nota.idEstado
         		JOIN publicacion on publicacion.id=edicion.idPublicacion
                WHERE estadodepublicacion.id=1 AND nota.id='$idNota'";
        return $this->database->Query($sql);
    }
    public function getNotasxEdicion($idEdicion){
        $sql="SELECT nota.* ,edicion.descrip as descripEdicion,seccion.descrip as descripSeccion,publicacion.informacion as publicacion
                FROM nota JOIN seccion ON nota.idSeccion=seccion.id 
                JOIN edicion on nota.idEdicion=edicion.id 
                JOIN estadodepublicacion on estadodepublicacion.id=nota.idEstado
         		JOIN publicacion on publicacion.id=edicion.idPublicacion
                WHERE estadodepublicacion.id=1 AND nota.idEdicion='$idEdicion'";
        return $this->database->Query($sql);
    }
}
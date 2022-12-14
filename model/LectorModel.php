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
                WHERE estadodepublicacion.id=2";
        $result = $this->database->Query($sql);
        shuffle($result);
        return $result;
    }
    public function getNotaCompletaxIdNota($idNota){
        $sql="SELECT nota.* ,edicion.descrip as descripEdicion,seccion.descrip as descripSeccion,publicacion.informacion as publicacion,
                usuario.nombreApellido AS nombreApellido
                FROM nota JOIN seccion ON nota.idSeccion=seccion.id 
                JOIN edicion on nota.idEdicion=edicion.id 
                JOIN estadodepublicacion on estadodepublicacion.id=nota.idEstado
         		JOIN publicacion on publicacion.id=edicion.idPublicacion
                JOIN usuario on nota.idEscritor=usuario.id
                WHERE estadodepublicacion.id=2 AND nota.id='$idNota'";
        return $this->database->Query($sql);
    }
    public function getNotasxEdicion($idEdicion){
        $sql="SELECT nota.* ,edicion.descrip as descripEdicion,seccion.descrip as descripSeccion,publicacion.informacion as publicacion
                FROM nota JOIN seccion ON nota.idSeccion=seccion.id 
                JOIN edicion on nota.idEdicion=edicion.id 
                JOIN estadodepublicacion on estadodepublicacion.id=nota.idEstado
         		JOIN publicacion on publicacion.id=edicion.idPublicacion
                WHERE estadodepublicacion.id=2 AND nota.idEdicion='$idEdicion'";
        return $this->database->Query($sql);
    }
    public function getContenidista(){
        $sql = "SELECT DISTINCT usuario.* FROM nota
        JOIN usuario on nota.idContenidista=usuario.id
        JOIN rol on usuario.idRol=rol.id
        where rol.descripcion='CONTENIDISTA'";
        return $this->database->query($sql);
    }
    public function buscarNota($idNota, $idUsuario){
        $sql = "SELECT * FROM compraNoticias WHERE idNoticia = '$idNota' AND idUsuario = '$idUsuario'";
        $res = $this->database->Query($sql);
        if($res){
            return true;
        }else{
            return false;
        }
    }
    public function comprarNota($idUsuario, $idNota, $precioNota){

        $sql = "INSERT INTO compraNoticias (idUsuario, idNoticia, precio) VALUES ('$idUsuario', '$idNota', '$precioNota')";
        $this->database->execute($sql);

    }
    public function buscarEdicion($idNota, $idUsuario){
        $sql = "SELECT * FROM compraEdicion WHERE idEdicion = '$idNota' AND idUsuario = '$idUsuario'";
        $res = $this->database->Query($sql);
        if($res){
            return true;
        }else{
            return false;
        }
    }

    public function comprarEdicion($idUsuario, $idEdicion, $precioEdicion){

        $sql = "INSERT INTO compraEdicion (idUsuario, idEdicion, precio) VALUES ('$idUsuario', '$idEdicion', '$precioEdicion')";
        $this->database->execute($sql);

    }
}


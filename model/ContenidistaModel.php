<?php

class ContenidistaModel {
    private $database;

    public function __construct($database) {
        $this->database = $database;
    }

    public function getPublicaciones() {
        $sql = 'SELECT * FROM publicacion';
        return $this->database->query($sql);
    }
    public function getPublicacionxId($idPublicacion) {
        $sql = "SELECT * FROM publicacion where id='$idPublicacion'";
        return $this->database->queryNum($sql);
    }
    public function altaPublicacion($nombre,$ruta){
        $sql = "INSERT INTO publicacion(informacion,ruta) VALUES ('$nombre','$ruta')";
        $this->database->execute($sql);
    }
    public function getSecciones(){
        $sql = 'SELECT * FROM seccion';
        return $this->database->query($sql);
    }
    public function getSeccionesInexistenes($idEdicion){
        $sql= "SELECT * FROM seccion where id not in(select idSeccion from edicion_seccion where idEdicion='$idEdicion')";
        return $this->database->query($sql);
    }
    public function getSeccionesExistenes($idEdicion){
        $sql= "SELECT * FROM seccion where id in(select idSeccion from edicion_seccion where idEdicion='$idEdicion')";
        return $this->database->query($sql);
    }
    public function altaEdicion($idPublicacion,$numeroEdicion,$valor){
        $sql = "INSERT INTO edicion (idPublicacion,num,valor) VALUES ('$idPublicacion','$numeroEdicion','$valor')";
        $this->database->execute($sql);
        return $this->database->insert();
    }
    public function getEdiciones($idPublicacion){
        $sql = "SELECT * FROM edicion where idPublicacion='$idPublicacion'";
        return $this->database->query($sql);
    }
    public function altaEdicionSeccion($lastInsertedId,$idSeccion){
        $sql = "INSERT INTO edicion_seccion (idEdicion,idSeccion) VALUES ('$lastInsertedId','$idSeccion')";
        $this->database->execute($sql);
    }
    public function buscarEdicionxNum($numEdicion,$idPublicacion){
        $sql = "SELECT * FROM edicion where num='$numEdicion' and idPublicacion='$idPublicacion'";
        if($this->database->query($sql))
            return true;
        else
            return false;
    }
    //MODIFICACIONES
    public function updatePublicacion($idPublicacion,$nombre,$ruta){
        if($ruta!='public/img/publications/')
            $sql = "UPDATE publicacion SET informacion='$nombre',ruta='$ruta' where id='$idPublicacion'";
        else
            $sql = "UPDATE publicacion SET informacion='$nombre' where id='$idPublicacion'";

        $this->database->execute($sql);
    }
    //ELIMINACIONES
    public function deletePublicacion($idPublicacion){
        $sql = "DELETE FROM publicacion WHERE id='$idPublicacion'";
        $this->database->execute($sql);
    }
    public function deleteEdicionxPublicacion($idPublicacion){
        $sql = "DELETE FROM edicion WHERE idPublicacion='$idPublicacion'";
        $this->database->execute($sql);
    }

}
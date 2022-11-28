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
        $sql = "INSERT INTO edicion (idPublicacion,descrip,valor) VALUES ('$idPublicacion','$numeroEdicion','$valor')";
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
        $sql = "SELECT * FROM edicion where descrip='$numEdicion' and idPublicacion='$idPublicacion'";
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
public function  verNotasPendientes(){
    $sql = "SELECT nota.* ,edicion.descrip as descripEdicion,seccion.descrip as descripSeccion,estadodepublicacion.Estado as estado,publicacion.informacion
                FROM nota JOIN seccion ON nota.idSeccion=seccion.id 
                    JOIN edicion on nota.idEdicion=edicion.id
                    join estadodepublicacion on estadodepublicacion.id = nota.idEstado
                join publicacion on edicion.idPublicacion=publicacion.id
                WHERE  estadodepublicacion.Estado='pendiente'";
    return $this->database->query($sql);
}
public function cambiarNotaAPublicado($id){

        $sql="UPDATE nota SET idEstado=(SELECT estadodepublicacion.id FROM estadodepublicacion WHERE estadodepublicacion.Estado='publicado') WHERE nota.id='$id'";
        $this->database->execute($sql);

    }
    public function verMasNota($id){
        $sql = "SELECT nota.* ,edicion.descrip as descripEdicion,seccion.descrip as descripSeccion,estadodepublicacion.Estado as Estado, publicacion.informacion FROM nota 
                 JOIN seccion ON nota.idSeccion=seccion.id 
                JOIN edicion on nota.idEdicion=edicion.id 
                 join estadodepublicacion on estadodepublicacion.id = nota.idEstado 
                                 join publicacion on edicion.idPublicacion=publicacion.id

                  WHERE nota.id='$id'";
        return $this->database->query($sql);
    }
    public function getNotas($id){
        $sql="SELECT nota.*,estadodepublicacion.estado from nota 
JOIN estadodepublicacion on estadodepublicacion.id=nota.idEstado  WHERE nota.idSeccion in (SELECT edicion_seccion.idSeccion FROM edicion_seccion 
  JOIN edicion on edicion_seccion.idEdicion=edicion.id
  JOIN publicacion ON edicion.idPublicacion=edicion.idPublicacion
 JOIN seccion on edicion_seccion.idSeccion=seccion.id
 WHERE seccion.id='$id')and estadodepublicacion.Estado='publicado'";
        return $this->database->query($sql);



    }
    public function darDeBajaPublicacion($id){

        $sql="UPDATE nota SET idEstado=(SELECT estadodepublicacion.id FROM estadodepublicacion WHERE estadodepublicacion.Estado='baja') WHERE nota.id='$id'";
       $this->database->execute($sql);

    }

}
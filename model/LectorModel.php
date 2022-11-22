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

}
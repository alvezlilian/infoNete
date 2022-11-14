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
    public function alta($nombre,$ruta){
        $sql = "INSERT INTO publicacion(informacion,ruta) VALUES ('$nombre','$ruta')";
        $this->database->execute($sql);
    }
}
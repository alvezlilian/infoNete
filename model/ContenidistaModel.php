<?php

class ContenidistaModel {
    private $database;

    public function __construct($database) {
        $this->database = $database;
    }

    public function getPublicaciones() {
        $sql = 'SELECT * FROM infonete.publicacion';
        return $this->database->query($sql);
    }

    public function alta($nombre,$ruta){
        $sql = "INSERT INTO infonete.publicacion(informacion,ruta) VALUES ('$nombre','$ruta')";
        $this->database->execute($sql);
    }
    public function getSecciones(){
        $sql = 'SELECT * FROM infonete.seccion';
        return $this->database->query($sql);

    }
}
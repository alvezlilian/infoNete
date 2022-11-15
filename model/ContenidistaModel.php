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
    public function alta($nombre){
            $sql = "INSERT INTO infonete.publicacion(informacion) VALUES ('$nombre')";
            $this->database->execute($sql);
    }
}
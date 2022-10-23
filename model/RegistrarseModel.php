<?php

class RegistrarseModel
{
    private  $database;

    public function __construct( $database)
    {
        $this->database=$database;
    }
    public function alta($nombre,$email,$direccion,$clave){
        $sql2="INSERT INTO infonete.contasenia(clave) VALUES ('$clave')";
      $sql1="INSERT INTO infonete.usuario1(nombre1,direccion,email) VALUES ('$nombre','$direccion','$email')";
     $datos= $this->database->query($sql2);

        $this->database->execute($sql1);
    }
}
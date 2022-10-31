<?php

class RegistrarseModel
{
    private  $database;

    public function __construct($database)
    {
        $this->database=$database;
    }

    public function alta($nombre,$email,$direccion,$clave,$latitud,$longitud){

      $sql1="INSERT INTO infonete.usuario(nombre,ubicacion,email,latitud,longitud) VALUES ('$nombre','$direccion','$email','$latitud','$longitud')";
       $this->database->execute($sql1);
       $idUsuario=$this->database->insert();
      $sqlContrasenia="INSERT INTO infonete.contrasenia(clave,idUsuario) VALUES ('$clave','$idUsuario')";
      $this->database->execute($sqlContrasenia);

    }
}
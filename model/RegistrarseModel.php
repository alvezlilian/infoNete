<?php

class RegistrarseModel
{
    private  $database;

    public function __construct( $database)
    {
        $this->database=$database;
    }
    public function alta($nombre,$email,$direccion,$clave,$latitud,$longitud){

        $nombreIngresado = $this->sanitizarNombre($nombre);
        $emailIngresado = $this->sanitizarEmail($email);

        $sql1="INSERT INTO infonete.usuario(nombre,ubicacion,email,latitud,longitud) VALUES ('$nombreIngresado','$direccion', '$emailIngresado','$latitud','$longitud')";
        $this->database->execute($sql1);
        $idUsuario=$this->database->insert();
        $sqlContrasenia="INSERT INTO infonete.contrasenia(clave,idUsuario) VALUES ('$clave','$idUsuario')";
        $this->database->execute($sqlContrasenia);
    }

    public function sanitizarNombre($nombre){
        return $nombre = mysqli_real_escape_string($this->database, $_POST['nombre']);
    }

    public function sanitizarEmail($email){
        return $email = mysqli_real_escape_string($this->database, filter_var($_POST['email'], FILTER_VALIDATE_EMAIL));
    }


}
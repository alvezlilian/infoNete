<?php

class RegistrarseModel
{
    private  $database;

    public function __construct( $database)
    {
        $this->database=$database;
    }
    public function alta($nombre,$email,$direccion,$clave,$latitud,$longitud){

        $sql1="INSERT INTO infonete.usuario(nombre,ubicacion,email,latitud,longitud) VALUES ('$nombre','$direccion', '$email','$latitud','$longitud')";
        $this->database->execute($sql1);
        $idUsuario=$this->database->insert();
        $sqlContrasenia="INSERT INTO infonete.contrasenia(clave,idUsuario) VALUES ('$clave','$idUsuario')";
        $this->database->execute($sqlContrasenia);

        Redirect::doIt("/registrarse/validarUsuarioForm");
    }

    public function generarCodigoVerificacion(){
        $codigo = mt_rand(100000, 999999);
        // AGREGAR CAMPO codigo y cuentaValidada a tabla contrasenia
        // ejecutar sql para guardar el codigo
        return $codigo;
    }

    public function validarCodigoGenerado($codigo){

    }




}
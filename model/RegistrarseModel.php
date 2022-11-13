<?php

use \PHPMailer\Envio;

class RegistrarseModel
{
    private  $database;

    public function __construct( $database)
    {
        $this->database=$database;
    }
    public function alta($nombre,$email,$direccion,$clave,$latitud,$longitud){

        /*
        if(!$this->emailRegistrado($email)){
            //ACÁ VA LA VALIDACIÓN DE SI EL USUARIO EXISTE O NO
        }else{
            Redirect::doIt("/registrarse/registrarseForm");
        }
        */
        $sql1="INSERT INTO infonete.usuario(nombre,ubicacion,email,latitud,longitud,activo) VALUES ('$nombre','$direccion','$email','$latitud','$longitud',FALSE)";
        $this->database->execute($sql1);
        $idUsuario=$this->database->insert();
        $codigo = $this->generarCodigoVerificacion();
        $sqlContrasenia="INSERT INTO infonete.contrasenia(clave,idUsuario,codigo,validado) VALUES ('$clave','$idUsuario','$codigo',FALSE)";
        $this->database->execute($sqlContrasenia);
        
        Redirect::doIt("/registrarse/validarUsuarioForm");

    }

    public function emailRegistrado($email){
        $sql = "SELECT * FROM infonete.usuario WHERE email = '$email'";
        $result = $this->database->execute($sql);

        if(is_null($result)){
            return true;
        }else{
            return false;
        }
    }

    public function generarCodigoVerificacion(){
        $codigo = mt_rand(100000, 999999);
        return $codigo;
    }

    public function validarCodigoGenerado($codigo){

    }




}
<?php

class ValidarUsuarioModel
{
    private  $database;

    public function __construct($database)
    {
        $this->database=$database;
    }

    public function generarCodigoVerificacion(){
        return mt_rand(100000, 999999);
    }

    public function validarUsuario($codigo){


        $sql = "SELECT email,descripcion from usuario JOIN contrasenia on usuario.id = contrasenia.idUsuario join rol on usuario.idRol=rol.id WHERE usuario.email = '$email' AND contrasenia.clave = '$clave'";
        $resultado = $this->database->query($sql);

        if(!isset($resultado)||$resultado==NULL){
            Redirect::doIt("/login/validarLogin");
        }
        return $resultado;
    }
}

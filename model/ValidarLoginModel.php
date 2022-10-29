<?php

class ValidarLoginModel
{
    private  $database;

    public function __construct($database)
    {
        $this->database=$database;
    }

    public function validarLogin($email,$clave){
        //SELECT usuario.* from usuario JOIN contrasenia on usuario.id = contrasenia.id_usuario WHERE usuario.email = "test@test.com" AND contrasenia.clave = "prueba123";
        //$sql = "SELECT usuario.email,rol.descripcion from usuario JOIN contrasenia on usuario.id = contrasenia.idUsuario join rol on usuario.idRol=rol.id WHERE usuario.email = '$email' AND contrasenia.clave = '$clave'";
        $sql = "SELECT email,descripcion from usuario JOIN contrasenia on usuario.id = contrasenia.idUsuario join rol on usuario.idRol=rol.id WHERE usuario.email = '$email' AND contrasenia.clave = '$clave'";
        $resultado = $this->database->execute($sql);

        if(!isset($resultado)||$resultado==NULL){
             Redirect::doIt("/login/validarLogin");
        }
        return $resultado;
    }
}

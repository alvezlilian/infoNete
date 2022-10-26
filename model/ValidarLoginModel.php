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
        $sql = "SELECT * from usuario JOIN contrasenia on usuario.id = contrasenia.id_usuario WHERE usuario.email = '$email' AND contrasenia.clave = '$clave'";
        $resultado = $this->database->query($sql);

        die($resultado["clave"]);
        /*if($resultado["clave"] = $clave){
            return true;
        }
        return false;*/
    }
}

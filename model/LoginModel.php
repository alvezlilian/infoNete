<?php

class LoginModel
{


      private $database;

    public function __construct( $database){
        $this->database=$database;
    }
    public function verificarUsuario($email,$clave){
        $sql="SELECT usuario.id 

             FROM infonete.usuario LEFT JOIN infonete.contrasenia on usuario.id=contrasenia.id 
             WHERE usuario.email='$email' AND contrasenia.clave='$clave'";
            return $this->database->query($sql);
    }
    public function validaLogin($email,$clave){
        $sql = "SELECT nombre,descripcion from usuario JOIN contrasenia on usuario.id = contrasenia.idUsuario join rol on usuario.idRol=rol.id WHERE usuario.email = '$email' AND contrasenia.clave = '$clave'";
        $resultado = $this->database->queryNum($sql);
        
        if(!isset($resultado)||$resultado==NULL){
             Redirect::doIt("/login/validarLogin");
        }
        
        return $resultado;
    }
}
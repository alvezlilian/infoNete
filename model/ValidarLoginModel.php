<?php

class ValidarLoginModel
{
    private  $database;

    public function __construct($database)
    {
        $this->database=$database;
    }

    public function validarLogin($email,$clave){
        $sql = "SELECT email,descripcion from usuario JOIN contrasenia on usuario.id = contrasenia.idUsuario join rol on usuario.idRol=rol.id WHERE usuario.email = '$email' AND contrasenia.clave = '$clave'";
        $resultado = $this->database->query($sql);

        if(!isset($resultado)||$resultado==NULL){
             Redirect::doIt("/login/validarLogin");
        }
        return $resultado;
    }

    public function crearSesionUsuario($email){
        if (!isset($_SESSION))
        {
            session_start();
            $_SESSION['email']=$email;
            session_destroy();
        }else{
            die("HOLAAAAA");
        }

        if (!isset($_SESSION['email'])){
            die("asdasdasdasdasdsad");
        }
    }

    public function getIdByMail($email){
        $sql = "SELECT id from usuario WHERE usuario.email = '$email'";
        return $resultado = $this->database->query($sql);
    }
    
    public function cerrarSesion(){
        session_destroy();
    }
}

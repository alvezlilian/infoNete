<?php

class ValidarLoginModel
{
    private  $database;

    public function __construct($database)
    {
        $this->database=$database;
    }

    public function validarLogin($email,$clave){
        $sql = "SELECT nombre,descripcion from infonete.usuario JOIN infonete.contrasenia on usuario.id = contrasenia.idUsuario join infonete.rol on usuario.idRol=rol.id WHERE usuario.email = '$email' AND contrasenia.clave = '$clave'";
        $resultado = $this->database->queryNum($sql);

        if(!isset($resultado)||$resultado==NULL){
             Redirect::doIt("/login/validarLogin");
        }
        return $resultado;
    }

    public function crearSesionUsuario($email){
        if (!isset($_SESSION))
        {
            session_start();
            $_SESSION['user']=$email;
            session_destroy();
        }else{
            die("HOLAAAAA");
        }

        if (!isset($_SESSION['email'])){
            die("asdasdasdasdasdsad");
        }
    }

    public function getIdByMail($email){
        $sql = "SELECT id from infonete.usuario WHERE usuario.email = '$email'";
        return $resultado = $this->database->query($sql);
    }
    
    public function cerrarSesion(){
        session_destroy();
    }
}

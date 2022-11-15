<?php

class ValidarLoginModel
{
    private  $database;

    public function __construct($database)
    {
        $this->database=$database;
    }

    public function validaLogin($email,$clave){

        $sql1 = "SELECT clave FROM infonete.contrasenia WHERE idUsuario = (SELECT id FROM infonete.usuario WHERE email = '$email')";
        $hash = $this->database->query($sql1);
        var_dump($hash);
        die();
        if (password_verify($clave, $hash)) {
            $sql2 = "SELECT nombre,idRol from infonete.usuario WHERE email = '$email'";
            $resultado = $this->database->query($sql2);
            var_dump($resultado);
            die();
            return $resultado;
        } else {
            //Redirect::doIt("/login/validarLogin");
        }
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
        $sql = "SELECT id from usuario WHERE usuario.email = '$email'";
        return $resultado = $this->database->query($sql);
    }
    
    public function cerrarSesion(){
        session_destroy();
    }
}

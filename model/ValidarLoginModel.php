<?php

class ValidarLoginModel
{
    private  $database;

    public function __construct($database)
    {
        $this->database=$database;
    }

    public function validarLogin($email,$clave){
        $resultado = 0;
        $sql1 = "SELECT clave FROM infonete.contrasenia WHERE idUsuario = (SELECT id FROM infonete.usuario WHERE email = '$email')";
        $hash = $this->database->query($sql1);

        if ((password_verify($clave, $hash))) {
            $sql2 = "SELECT id FROM infonete.usuario WHERE email = '$email'";
            $idTableUser = $this->database->query($sql2);

            $sql3 = "SELECT idUsuario FROM infonete.contrasenia WHERE clave = '$hash'";
            $idTableContra = $this->database->query($sql3);

            if($idTableUser == $idTableContra){
                $sql4 = "SELECT nombre,idRol FROM infonete.usuario WHERE email = '$email'";
                $resultado = $this->database->query($sql4);
            }
        }

        if(!isset($resultado)||$resultado==NULL){
            $mensaje['mensaje'] = "Codigo erroneo";
            Redirect::doIt("/login/validarLogin",$mensaje);
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

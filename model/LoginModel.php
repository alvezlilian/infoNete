<?php

class LoginModel
{
    private $database;

    public function __construct( $database){
        $this->database=$database;
    }

    public function validarLogin($email,$clave){
        $resultado = 0;
        $sql1 = "SELECT clave FROM contrasenia WHERE idUsuario = (SELECT id FROM usuario WHERE email = '$email')";
        $resHash = $this->database->queryNum($sql1);
        $parseHash = implode($resHash);
        $hash = substr($parseHash, 0, 60);

        $validarHash = (password_verify($clave, $hash));

        if ($validarHash) {
            $sql2 = "SELECT id FROM usuario WHERE email = '$email'";
            $resIdTableUser = $this->database->queryNum($sql2);
            $idTableUser = implode($resIdTableUser);

            $sql3 = "SELECT idUsuario FROM contrasenia WHERE clave = '$hash'";
            $resIdTableContra = $this->database->queryNum($sql3);
            $idTableContra = implode($resIdTableContra);

            if($idTableUser == $idTableContra){
                $sql4 = "SELECT nombre,idRol FROM usuario WHERE email = '$email'";
                $resultado = $this->database->queryNum($sql4);
            }
        }
        return $resultado;
    }

    public function getIdByMail($email){

        $sql = "SELECT id from usuario WHERE email = '$email'";

        return $resultado = $this->database->queryNum($sql);
    }

    public function getDescripcionById($idRol){
        $sql = "SELECT descripcion FROM rol WHERE id = '$idRol'";
        return $resultado = $this->database->queryNum($sql);
    }

}


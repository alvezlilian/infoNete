<?php

class LoginModel
{
    private $database;

    public function __construct( $database){
        $this->database=$database;
    }
<<<<<<< HEAD
    public function verificarUsuario($email,$clave){
        $sql = "SELECT usuario.id FROM infonete.usuario LEFT JOIN infonete.contrasenia on usuario.id=contrasenia.id WHERE usuario.email='$email' AND contrasenia.clave='$clave'";
        return $this->database->query($sql);
    }

    public function validaLogin($email,$clave){
        $sql = "SELECT nombre,descripcion from usuario JOIN contrasenia on usuario.id = contrasenia.idUsuario join rol on usuario.idRol=rol.id WHERE usuario.email = '$email' AND contrasenia.clave = '$clave'";
        $resultado = $this->database->queryNum($sql);
        
        if(!isset($resultado)||$resultado==NULL){
             Redirect::doIt("/login/validarLogin");
=======
    public function validarLogin($email,$clave){
        $resultado = 0;
        $sql1 = "SELECT clave FROM infonete.contrasenia WHERE idUsuario = (SELECT id FROM infonete.usuario WHERE email = '$email')";
        $resHash = $this->database->queryNum($sql1);
        $parseHash = implode($resHash);
        $hash = substr($parseHash, 0, 60);

        $validarHash = (password_verify($clave, $hash));

        if ($validarHash) {
            $sql2 = "SELECT id FROM infonete.usuario WHERE email = '$email'";
            $resIdTableUser = $this->database->queryNum($sql2);
            $idTableUser = implode($resIdTableUser);

            $sql3 = "SELECT idUsuario FROM infonete.contrasenia WHERE clave = '$hash'";
            $resIdTableContra = $this->database->queryNum($sql3);
            $idTableContra = implode($resIdTableContra);

            if($idTableUser == $idTableContra){
                $sql4 = "SELECT nombre,idRol FROM infonete.usuario WHERE email = '$email'";
                $resultado = $this->database->query($sql4);
            }
>>>>>>> a4fd30874abc00a5400a1d40d7f55a01728cdb3f
        }


        return $resultado;
    }



    public function getIdByMail($email){
        $sql = "SELECT id from infonete.usuario WHERE usuario.email = '$email'";
        return $resultado = $this->database->query($sql);
    }


}
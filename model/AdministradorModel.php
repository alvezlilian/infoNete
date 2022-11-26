<?php

class AdministradorModel{

    private  $database;

    public function __construct( $database){ $this->database=$database; }

    public function alta($nombre,$email,$direccion,$clave){
        $sql1="INSERT INTO usuario(nombre,ubicacion,email,activo,idRol) VALUES ('$nombre','$direccion','$email',TRUE,1)";
        $this->database->execute($sql1);
        $idUsuario=$this->database->insert();
        $sqlContrasenia="INSERT INTO contrasenia(clave,idUsuario,validado) VALUES ('$clave','$idUsuario',TRUE)";
        $this->database->execute($sqlContrasenia);
    }

    public function verificarEmail($email){
        $sql="SELECT * FROM usuario WHERE email = '$email'";
        $result = $this->database->query($sql);
        if(empty($result)){
            return true;
        }else{
            return false;
        }
    }

}
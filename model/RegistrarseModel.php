<?php

class RegistrarseModel
{
    private  $database;

    public function __construct( $database)
    {
        $this->database=$database;
    }
    public function alta($nombre,$email,$direccion,$clave,$latitud,$longitud, $codigo){

        $sql1="INSERT INTO usuario(nombre,ubicacion,email,latitud,longitud,activo,idRol) VALUES ('$nombre','$direccion','$email','$latitud','$longitud',FALSE,1)";
        $this->database->execute($sql1);
        $idUsuario=$this->database->insert();

        $sqlContrasenia="INSERT INTO contrasenia(clave,idUsuario,codigo,validado) VALUES ('$clave','$idUsuario','$codigo',FALSE)";
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

    public function validarCodigoRegistro($codigo){
        $sql = "SELECT * FROM contrasenia WHERE codigo = '$codigo'";
        $result = $this->database->query($sql);
        if(!(empty($result))){
            $insert1="UPDATE contrasenia SET validado=TRUE WHERE codigo='$codigo'";
            $this->database->execute($insert1);
            $insert2="UPDATE usuario SET activo=TRUE WHERE id = (select idUsuario from infonete.contrasenia where codigo = '$codigo');";
            $this->database->execute($insert2);
            return true;
        }else{
            return false;
        }
    }



}
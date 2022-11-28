<?php

class AdministradorModel{

    private  $database;

    public function __construct( $database){ $this->database=$database; }

    public function alta($nombre,$email,$direccion,$rol, $clave){
        $sql1="INSERT INTO usuario(nombre,ubicacion,email,activo,idRol) VALUES ('$nombre','$direccion','$email',TRUE,'$rol')";
        $this->database->execute($sql1);
        $idUsuario=$this->database->insert();
        $sqlContrasenia="INSERT INTO contrasenia(clave,idUsuario,validado) VALUES ('$clave','$idUsuario',TRUE)";
        $this->database->execute($sqlContrasenia);
    }

    public function baja($id){
        $filter = $id['id'];
        $sql="DELETE FROM usuario WHERE id = '$filter'";
        $this->database->execute($sql);
    }

    public function updateUsuario($id, $nombre, $email, $claveEncriptada){
    //UPDATE `usuario` SET `id`='[value-1]',`nombre`='[value-2]',`ubicacion`='[value-3]',`email`='[value-4]',`latitud`='[value-5]',`longitud`='[value-6]',`activo`='[value-7]',`idRol`='[value-8]' WHERE 1
        $sql = "UPDATE usuario SET nombre= '$nombre', email = '$email' WHERE id = '$id'";
        $this->database->execute($sql);
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

    public function getUserByMail($email){
        $sql = "SELECT id from usuario WHERE email = '$email'";
        return $resultado = $this->database->query($sql);
    }

    public function agregar_contenidista($nombre,$email,$direccion,$clave){
        $sql1="INSERT INTO usuario(nombre,ubicacion,email,activo,idRol) VALUES ('$nombre','$direccion','$email',TRUE,4)";
        $this->database->execute($sql1);
        $idUsuario=$this->database->insert();
        $sqlContrasenia="INSERT INTO contrasenia(clave,idUsuario,validado) VALUES ('$clave','$idUsuario',TRUE)";
        $this->database->execute($sqlContrasenia);
    }

    public function getUsuarios(){
        $sql = "SELECT * from usuario";
        return $resultado = $this->database->query($sql);
    }

}


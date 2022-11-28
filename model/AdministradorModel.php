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

    public function updateUsuario($id, $nombre, $email, $ubicacion, $rol){
        $userId = $id['id'];
        $sql = "UPDATE usuario SET nombre='$nombre', email='$email', ubicacion='$ubicacion', idRol='$rol' WHERE id='$userId'";
        $this->database->execute($sql);
    }

    public function existeMail($email){
        $sql="SELECT email FROM usuario WHERE email = '$email'";
        $result = $this->database->queryNum($sql);
        if (is_null($result)){
            return false;
        }
        return $result['email'] == $email;
    }

    public function getUserByMail($email){
        $sql = "SELECT * from usuario WHERE email = '$email'";
        return $resultado = $this->database->queryNum($sql);
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

    public function getPublicaciones() {
        $sql = 'SELECT * FROM publicacion';
        return $this->database->query($sql);
    }

    public function eliminarPublicacionPor($id){
        $sql="DELETE FROM publicacion WHERE id = '$id'";
        $this->database->execute($sql);
    }
}


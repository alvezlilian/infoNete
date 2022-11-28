<?php

class AdministradorModel{

    private  $database;

    public function __construct( $database){ $this->database=$database; }

    public function alta($nombre,$email,$direccion,$rol, $clave){
        $sql1="INSERT INTO usuario(nombreApellido,ubicacion,email,activo,idRol) VALUES ('$nombre','$direccion','$email',TRUE,'$rol')";
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
        $sql = "UPDATE usuario SET nombreApellido='$nombre', email='$email', ubicacion='$ubicacion', idRol='$rol' WHERE id='$userId'";
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
        $sql1="INSERT INTO usuario(nombreApellido,ubicacion,email,activo,idRol) VALUES ('$nombre','$direccion','$email',TRUE,4)";
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
    public function listaDeContenidista(){
        $sql="SELECT  usuario.*, rol.descripcion FROM usuario join rol on usuario.idRol= rol.id WHERE rol.descripcion='CONTENIDISTA'";
        return $this->database->query($sql);

    }
    public function listaDeLectores(){
        $sql="SELECT usuario.*, nota.id as notaId,nota.Titulo, seccion.descrip as descripSeccion, edicion.descrip as descripEdicion,publicacion.informacion FROM usuario 
              JOIN compranoticias ON usuario.id=compranoticias.idUsuario join nota on nota.id=compranoticias.idNoticia 
              JOIN seccion on seccion.id=nota.idSeccion JOIN edicion on edicion.id=nota.idEdicion 
              JOIN publicacion on publicacion.id=edicion.idPublicacion";
        return $this->database->query($sql);

    }public function ContarNotasVendidas(){
        $sql="SELECT nota.id, COUNT(*) as cantidad FROM nota JOIN compranoticias ON compranoticias.idNoticia=nota.id GROUP BY nota.id";
    return $this->database->query($sql);


    }
    public function  contarEdicionesVendidas(){
        $sql="SELECT edicion.descrip AS descripEdicion, COUNT(*) as cantidad FROM edicion JOIN compraedicion ON compraedicion.idEdicion=edicion.id GROUP BY edicion.descrip";
        return $this->database->query($sql);

    }
}


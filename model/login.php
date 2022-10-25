<?php 
include_once('usuario.php');

private  $database;

    public function __construct( $database)
    {
        $this->database=$database;
    }
    public function validarLogin($email,$clave){
        $sql2="SELECT * FROM usuario where ";
        $sql1="INSERT INTO infonete.usuario1(nombre1,direccion,email) VALUES ('$nombre','$direccion','$email')";
        $datos= $this->database->query($sql2);

        $this->database->execute($sql1);
    }
  
}
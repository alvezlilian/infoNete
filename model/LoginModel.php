<?php

class LoginModel
{


      private $database;

    public function __construct( $database)
    {
        $this->database=$database;
    }
    public function verificarUsuario($email,$clave){
        $sql="SELECT usuario.id 

             FROM infonete.usuario LEFT JOIN infonete.contrasenia on usuario.id=contrasenia.id 
             WHERE usuario.email='$email' AND contrasenia.clave='$clave'";
    return $this->database->query($sql);



}}
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
             FROM infonete.usuario LEFT JOIN infonete.contasenia on usuario.idClave=contasenia.id 
             WHERE usuario.email='$email' AND contasenia.clave='$clave'";
    return $this->database->query($sql);


}}
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
             FROM usuario LEFT JOIN contasenia on usuario.idClave=contasenia.id 
             WHERE usuario.email='$email' AND ancontasenia.clave='$clave'";
        $this->database->execute($sql);

}}
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


             FROM usuario LEFT JOIN contasenia on usuario.idClave=contasenia.id 
             WHERE usuario.email='$email' AND ancontasenia.clave='$clave'";
        $this->database->execute($sql);

}}
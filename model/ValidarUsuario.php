<?php

class ValidarUsuarioModel
{
    private  $database;

    public function __construct($database)
    {
        $this->database=$database;
    }

    public function generarCodigoVerificacion(){
        return mt_rand(100000, 999999);
    }

    public function validarUsuario($codigo){

        $resultado = "SELECT * from infonete.contrasenia WHERE contrasenia.clave = '$codigo' ";
        //$resultado = $this->database->query($sql);

        if(!isset($resultado)||$resultado==NULL){
            Redirect::doIt("/");
        }
        return $resultado;
    }
}

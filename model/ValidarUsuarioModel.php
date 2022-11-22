<?php

class ValidarUsuarioModel
{
    private  $database;

    public function __construct($database)
    {
        $this->database=$database;
    }



    public function validarUsuario($codigo){

        $resultado = "SELECT * from contrasenia WHERE contrasenia.clave = '$codigo' ";
        //$resultado = $this->database->query($sql);

        if(!isset($resultado)||$resultado==NULL){
            Redirect::doIt("/");
        }
        return $resultado;
    }
}

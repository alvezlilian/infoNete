<?php

class RegistrarseController
{

    private $renderer;
    private $model;

    public function __construct($render, $model)
    {
        $this->renderer = $render;
        $this->model = $model;
    }
    public function list(){
        echo "hola";

    }
    public function alta(){
    $this->renderer->render("registrarseForm.mustache");
    }
    function is_valid_email($str)
    {
        $matches = null;
        return (1 === preg_match('/^[A-z0-9\\._-]+@[A-z0-9][A-z0-9-]*(\\.[A-z0-9_-]+)*\\.([A-z]{2,6})$/', $str, $matches));
    }
    function encriptarClave($clave){
        return password_hash($clave, PASSWORD_DEFAULT);
    }
    function validarEnvioDatosForm($emailValido){
        if($emailValido == 1){
            return true;
        }elseif($emailValido == 0 OR $emailValido == false){
            return false;
        }
    }
    public function procesarAlta(){
        $nombre=$_POST["nombre"];
        $email=$_POST["email"];
        $clave =$_POST["clave"];
        $direccion=$_POST["direccion"];
        $latitud=$_POST["latitud"];
        $longitud=$_POST["longitud"];

        $claveEncriptada=$this->encriptarClave($clave);
        $emailValido = $this->is_valid_email($email);

        if($this->validarEnvioDatosForm($emailValido)){
            $this->model->alta($nombre,$email,$direccion,$claveEncriptada,$latitud,$longitud);
            Redirect::doIt("/");
        }

    }
    public function validarUsuario(){
        $this->renderer->render("validarUsuarioForm.mustache");
    }

}
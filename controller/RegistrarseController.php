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
        echo "adios";
    }

    public function alta(){
    $this->renderer->render("registrarseForm.mustache");
    }

    function encriptarClave($clave){
        return password_hash($clave, PASSWORD_DEFAULT);
    }

    public function generarCodigoVerificacion(){
        $codigo = mt_rand(100000, 999999);
        return $codigo;
    }

    public function procesarAlta(){
        $nombre=$_POST["nombre"];
        $email=$_POST["email"];
        $clave =$_POST["clave"];
        $direccion=$_POST["direccion"];
        $latitud=$_POST["latitud"];
        $longitud=$_POST["longitud"];
        $claveEncriptada=$this->encriptarClave($clave);

        if($this->estaRegistrado($email)){
            $codigo= $this->generarCodigoVerificacion();
            $this->model->alta($nombre,$email,$direccion,$claveEncriptada,$latitud,$longitud,$codigo);
            $this->renderer->render("validarUsuarioForm.mustache");
        }else{
            $mensaje['mensaje'] = "Ha ocurrido un error inesperado, reintente en unos minutos";
            $this->renderer->render("registrarseForm.mustache",$mensaje);
        }

    }

    public function estaRegistrado($email){
        return $result = $this->model->verificarEmail($email);

    }

    //
    public function verificacion(){
        $email=$_GET['email'];
        $hash=$_GET['hash'];
        $this->registroModel->verificacionHash($email,$hash);
        echo $this->render->render("view/inicio.php");

    }



    public function validarCodigo(){
        $codigo = $this->model->validarCodigoRegistro($_POST['codigo']);
        if($codigo){
            $this->renderer->render("login.mustache");
        }else{
            $mensaje['mensaje'] = "Codigo erroneo";
            $this->renderer->render("validarUsuarioForm.mustache",$mensaje);
        }
    }

}
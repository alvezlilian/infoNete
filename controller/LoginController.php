<?php

class LoginController
{
    private $renderer;
    private $model;


    public function __construct($render, $model)
    {
        $this->renderer = $render;
        $this->model = $model;
    }

    public function list(){
        die("hola");
    }

    public function validarLogin(){
        if (isset($_SESSION['rol'])){
            Redirect::doIt('/');
        }
        $data = VerOcultarBotones::verOcultar();
        $this->renderer->render("loginView.mustache",$data);
    }

    public function procesarLogin(){
        $email= $_POST['email'];
        $clave= $_POST['clave'];

        if ($clave == "" || $email == ""){
            Redirect::doIt('/login/validarLogin');
        }
        $data = $this->model->validarLogin($email,$clave);
        $rolDescripcion = $this->model->getDescripcionById($data["idRol"]);
        $nombre = $data["nombre"];
        $descripcion = $rolDescripcion['descripcion'];
        $this->validarResultado($data);
        ValidatorSession::sessionInit($nombre, $descripcion);
        ValidatorSession::routerSession();
    }

    public function validarResultado($data){
        if(!isset($data)||$data==NULL){
            $mensaje['mensaje'] = "Clave o Correo Incorrectos";
            $this->renderer->render("loginView.mustache",$mensaje);
        }
    }

    public function cerrarSesion(){
        if (!isset($_SESSION['rol'])){
            Redirect::doIt('/');
        }
        if (isset($_SESSION['rol'])) {
            session_destroy();
            Redirect::doIt('/');
        }
    }


}
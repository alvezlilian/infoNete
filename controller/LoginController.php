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
        $data['rol'] = ValidatorSession::setSession();
        $this->renderer->render("loginView.mustache", $data);
    }

    public function procesarLogin(){
        $email=$_POST['email'];
        $clave=$_POST['clave'];
        $data=  $this->model->validarLogin($email,$clave);

        $this->validarResultado($data);

        ValidatorSession::sessionInit($data);
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
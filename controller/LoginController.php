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
    }

    public function validarLogin(){
    $this->renderer->render("loginView.mustache");

    }
    public function procesarLogin(){
        $email=$_POST["email"];
        $clave=$_POST["clave"];
        $resultado = $this->model->validarLogin($email,$clave);

        if($resultado){
            Redirect::doIt("/");
        }else{
            Redirect::doIt("https://www.google.com.ar/?hl=es-419");
        }
    }

}
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
    public function login(){
    $this->renderer->render("registrarseForm.mustache");

    }
    public function procesarLogin(){
        $email=$_POST["email"];
        $clave=$_POST["clave"];
    $this->model->validarLogin($nombre,$clave);
    Redirect::doIt("/");
    }

}
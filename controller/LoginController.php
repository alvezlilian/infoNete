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
    public function iniciarsesion(){
        $this->renderer->render("login.mustache");
    }
    public function verificarLogin(){
        $email=$_POST["email"];
        $clave=$_POST["clave"];
        $this->model->verificarUsuario($email,$clave);
        Redirect::doIt("/");
    }
}
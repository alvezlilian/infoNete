<?php

class LoginController
{
    private $renderer;
    private $model;
    private $session;

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
        
        foreach($resultado as $i){
            $_SESSION['rol']=$i['descripcion'];
        }
        $_SESSION['email']=$email;
        $_SESSION['rol'];

        session_start();
        Redirect::doIt("/");
    }

}
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
        $this->renderer->render("loginView.mustache");
    }
    public function procesarLogin(){
        $email=$_POST['email'];
        $clave=$_POST['clave'];
        $data=  $this->model->validaLogin($email,$clave);
        ValidatorSession::sessionInit($data);
        ValidatorSession::routerSession();
    }

    public function cerrarSesion(){
        if (isset($_SESSION['email'])) {
            session_destroy();
        }
        if(!isset($_session['email'])){
            die("esta vacio");
        }
    }


}
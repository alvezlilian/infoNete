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
        if(!isset($_SESSION)){
            $this->renderer->render("loginView.mustache");
        }else{
            $this->renderer->render("tourView.mustache");
        }
    }

    public function procesarLogin(){
        $email=$_POST["email"];
        $clave=$_POST["clave"];
        $resultado = $this->model->validarLogin($email,$clave);

        session_start();
        $_SESSION['rol']= $resultado['descripcion'];
        $_SESSION['name']=$resultado['nombre'];

        Redirect::doIt("/lector/index_lector");
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
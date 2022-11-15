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
        echo("hola");

    }

    public function validarLogin(){
        $this->renderer->render("loginView.mustache");
    }

    public function procesarLogin(){
        $email=$_POST["email"];
        $clave=$_POST["clave"];

        $data=  $this->model->validaLogin($email,$clave);

        session_start();


        /*$resultado ="";
        $_SESSION['rol']= $resultado['descripcion'];
        $_SESSION['name']=$resultado['nombre'];*/


        $_SESSION['rol']= $data['descripcion'];
        $_SESSION['name']=$data['nombre'];

        switch ($data['descripcion']) {
            case "ADMINISTRADOR":
                Redirect::doIt("/");
                break;
            case "CONTENIDISTA":
                Redirect::doIt("/contenidista/home");
                break;
            case "ESCRITOR":
                Redirect::doIt("/");
                break;
            case "LECTOR":
                Redirect::doIt("/");
                break;
            default:
            Redirect::doIt("/");
                break;
        } 


        //Redirect::doIt("/",$data);

        //session_start();
        

       //Redirect::doIt("/lector/index_lector");*/
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
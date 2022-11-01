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
    public function iniciarSesion(){
        $this->renderer->render("loginView.mustache");
    }
    public function validarLogin(){
        $email=$_POST["email"];
        $clave=$_POST["clave"];
       $data['usuario']=  $this->model->verificarUsuario($email,$clave);
       if(count($data)>0){
           Redirect::doIt("/",$data);
       }else{
           Redirect::doIt("loginView.mustache",$data);
       }



    }
}
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
    public function alta(){
    $this->renderer->render("registrarseForm.mustache");

    }
    public function procesarAlta(){
        $nombre=$_POST["nombre"];
        $email=$_POST["email"];
        $clave=$_POST["clave"];
        $direccion=$_POST["direccion"];
        $passwordHash = password_hash($clave, PASSWORD_DEFAULT);
    $this->model->alta($nombre,$email,$direccion,$passwordHash);
    Redirect::doIt("/");
    }

}
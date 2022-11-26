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
        if (isset($_SESSION['rol'])){
            Redirect::doIt('/');
        }
        $data = VerOcultarBotones::verOcultar();
        $this->renderer->render("loginView.mustache",$data);
    }

    public function procesarLogin(){
        $email= $_POST['email'];
        $clave= $_POST['clave'];

        if ($clave == "" || $email == ""){
            Redirect::doIt('/login/validarLogin');
        }
        $data = $this->model->validarLogin($email,$clave);
        $rolDescripcion = $this->model->getDescripcionById($data["idRol"]);
        $buscarId = $this->model->getIdByMail($email);

        $nombre = $data["nombre"];
        $descripcion = $rolDescripcion['descripcion'];
        $id = $buscarId;

        $this->validarResultado($data);
        ValidatorSession::sessionInit($nombre, $descripcion, $id);
        ValidatorSession::routerSession();
    }

    public function validarResultado($data){
        if(!isset($data)||$data==NULL){
            $mensaje['mensaje'] = "Clave o Correo Incorrectos";
            $this->renderer->render("loginView.mustache",$mensaje);
        }
    }

    public function cerrarSesion(){
       ValidatorSession::cerrarSesion();
    }


}
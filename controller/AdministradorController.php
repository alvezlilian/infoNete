<?php

class AdministradorController{
    private $renderer;
    private $model;

    public function __construct($render, $model) {
        $this->renderer =$render;
        $this->model = $model;
    }
    public function list(){
        if (!ValidatorSession::tienePermiso($_SESSION['rol'])){
            Redirect::doIt('/');
        }
    }

    public function home(){
        $data = ValidatorSession::getSession();
        $this->renderer->render("adminViewHome.mustache", $data);
    }

    function encriptarClave($clave){
        $data = ValidatorSession::getSession();
        return password_hash($clave, PASSWORD_DEFAULT);
    }

    public function acciones(){
        $data = ValidatorSession::getSession();
        $this->renderer->render("usuarios-action.mustache",$data);
    }

    public function alta_usuario(){
        $data = ValidatorSession::getSession();
        $this->renderer->render("admin-alta-usuario.mustache",$data);

    }

    public function modificar_usuario(){
        $data = ValidatorSession::getSession();
        $this->renderer->render("admin-modificar-usuario.mustache",$data);

    }

    public function eliminar_usuario(){
        $data = ValidatorSession::getSession();
        $this->renderer->render("admin-eliminar-usuario.mustache",$data);

    }

    public function alta_contenidista(){
        $data['rol'] = ValidatorSession::getSession();
        $this->renderer->render("admin-eliminar-usuario.mustache",$data);
    }
    public function nuevo_usuario(){
        $nombre=$_POST["nombre"];
        $email=$_POST["email"];
        $clave =$_POST["clave"];
        $direccion=$_POST["direccion"];
        $claveEncriptada=$this->encriptarClave($clave);
        if($this->estaRegistrado($email)){
            $this->model->alta($nombre, $email, $direccion, $claveEncriptada);
            Redirect::doIt('/administrador/home');
        }
    }

    public function estaRegistrado($email){
        return $result = $this->model->verificarEmail($email);
    }
}
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
        if (!ValidatorSession::tienePermiso($_SESSION['rol'])){
            ValidatorSession::routerSession();
        }
        $data = ValidatorSession::setSession();
        $this->renderer->render("adminViewHome.mustache", $data);
    }

    function encriptarClave($clave){
        return password_hash($clave, PASSWORD_DEFAULT);
    }

    public function acciones(){
        if (!ValidatorSession::tienePermiso($_SESSION['rol'])){
            ValidatorSession::routerSession();
        }
        $data = ValidatorSession::setSession();
        $this->renderer->render("usuarios-action.mustache",$data);
    }

    public function alta_usuario(){
        if (!ValidatorSession::tienePermiso($_SESSION['rol'])){
            ValidatorSession::routerSession();
        }
        $data = ValidatorSession::setSession();
        $this->renderer->render("admin-alta-usuario.mustache",$data);
    }

    public function modificar_usuario(){
        if (!ValidatorSession::tienePermiso($_SESSION['rol'])){
            ValidatorSession::routerSession();
        }
        $data = ValidatorSession::setSession();
        $this->renderer->render("admin-modificar-usuario.mustache",$data);

    }

    public function eliminar_usuario(){
        if (!ValidatorSession::tienePermiso($_SESSION['rol'])){
            ValidatorSession::routerSession();
        }
        $data = ValidatorSession::setSession();
        $usuarios['usuarios'] = $this->model->getUsuarios();
        $this->renderer->render("admin-eliminar-usuario.mustache",$usuarios);
    }

    public function alta_contenidista(){
        if (!ValidatorSession::tienePermiso($_SESSION['rol'])){
            ValidatorSession::routerSession();
        }
        $data['rol'] = ValidatorSession::setSession();
        $this->renderer->render("admin-alta-contenidista.mustache",$data);
    }

    public function nuevo_usuario(){
        $nombre=$_POST["nombre"];
        $email=$_POST["email"];
        $clave =$_POST["clave"];
        $direccion=$_POST["direccion"];
        $rol = $_POST['rol'];
        $claveEncriptada=$this->encriptarClave($clave);
        if($this->estaRegistrado($email)){
            $this->model->alta($nombre, $email, $direccion, $rol, $claveEncriptada);
            Redirect::doIt('/administrador/home');
        }
    }

    public function baja_usuario(){
        $id['id'] = $_POST['id'];
        $this->model->baja($id);
        Redirect::doIt('/administrador/eliminar_usuario');
    }

    public function update_usuario(){
        $nombre=$_POST["nombre"];
        $email=$_POST["email"];
        $clave =$_POST["clave"];
        $claveEncriptada=$this->encriptarClave($clave);
        if($this->estaRegistrado($email)){
            $id = $this->model->getUserByMail($email);
            $this->model->update_usuario($id, $nombre, $email, $claveEncriptada);
            Redirect::doIt('/administrador/home');
        }
    }

    public function nuevo_contenidista(){
        $nombre=$_POST["nombre"];
        $email=$_POST["email"];
        $clave =$_POST["clave"];
        $direccion=$_POST["direccion"];
        $claveEncriptada=$this->encriptarClave($clave);
        if($this->estaRegistrado($email)){
            $this->model->agregar_contenidista($nombre, $email, $direccion, $claveEncriptada);
            Redirect::doIt('/administrador/home');
        }
    }

    public function estaRegistrado($email){
        return $result = $this->model->verificarEmail($email);
    }
}
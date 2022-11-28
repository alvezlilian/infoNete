<?php

class AdministradorController{
    private $renderer;
    private $model;
    private $domPdf;

    public function __construct($render, $model,$domPdf) {
        $this->renderer =$render;
        $this->model = $model;
        $this->domPdf=$domPdf;
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
        $email = $_POST['email'];

        if($this->estaRegistrado($email)){
            $usuario = $this->model->getUserByMail($email);
            $this->renderer->render("admin-modificar-usuario.mustache",$usuario, $data);
        }
        Redirect::doIt('/administrador/buscar_usuario');
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

    public function buscar_usuario(){
        if (!ValidatorSession::tienePermiso($_SESSION['rol'])){
            ValidatorSession::routerSession();
        }
        $data['rol'] = ValidatorSession::setSession();
        $this->renderer->render("admin-buscar-usuario-actualizar.mustache",$data);
    }

    public function ver_publicaciones(){
        $data['publicaciones'] = $this->model->getPublicaciones();
        $data['rol'] = $_SESSION['rol'];
        $this->renderer->render("admin-publicaciones.mustache", $data);
    }

    public function eliminar_publicacion(){
        $id = $_POST['id'];
        $this->model->eliminarPublicacionPor($id);
        Redirect::doIt('/administrador/ver_publicaciones');
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
        $ubicacion = $_POST['direccion'];
        $rol = $_POST['rol'];
            $id = $this->model->getUserByMail($email);
            $this->model->updateUsuario($id, $nombre, $email, $ubicacion, $rol);
            Redirect::doIt('/administrador/acciones');

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
        return $result = $this->model->existeMail($email);
    }
public function verReporte(){
        $data['contenidistas']=$this->model->listaDeContenidista();
$data['lectores']=$this->model->listaDeLectores();
$data['notasVendidas']=$this->model->ContarNotasVendidas();
$data['edicionesVendidas']=$this->model->contarEdicionesVendidas();
    $this->renderer->render("reporte.mustache", $data);


}
public function imprimirReporte(){
    $data['contenidistas']=$this->model->listaDeContenidista();
    $data['lectores']=$this->model->listaDeLectores();
    $data['notasVendidas']=$this->model->ContarNotasVendidas();
    $data['edicionesVendidas']=$this->model->contarEdicionesVendidas();
    $html= $this->renderer->render("reporte.mustache", $data);
    $this->domPdf->imp($html);
}
}
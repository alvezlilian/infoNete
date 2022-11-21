<?php
class ContenidistaController{

    private $renderer;
    private $model;

    public function __construct($render, $model) {
       $this->renderer =$render;
        $this->model = $model;
    }

    public function list(){       
    }

    public function home(){   
        if (!ValidatorSession::tienePermiso($_SESSION['rol'])){
            ValidatorSession::routerSession();
        }
        $data['publicaciones'] = $this->model->getPublicaciones();
        $data['rol'] = $_SESSION['rol'];
        $this->renderer->render("contenidistaView.mustache",$data);
    }

    public function alta(){
        $data["CONTENIDISTA"]=true;
        $data['rol'] = $_SESSION['rol'];
        $this->renderer->render("altaPublicacion.mustache",$data);
    }

    public function procesarAlta(){
        $path="public/img/publications/";
        $nombre = $_POST["descrip"];

        $name_img=$_FILES['imagen']['name'];
        $archivoTemporal=$_FILES["imagen"]["tmp_name"];

        $path_complete=$path.$name_img;

        move_uploaded_file($archivoTemporal,$path_complete);

        $this->model->alta($nombre,$path_complete);

        Redirect::doIt('/contenidista/home');
    }

    public function agregarEdSe(){
        $data['secciones']=$this->model->getSecciones();
        $data['publicaciones'] = $this->model->getPublicaciones();
        $data["CONTENIDISTA"]=true;
        $data['rol'] = $_SESSION['rol'];
        $this->renderer->render("altaEdicionSeccion.mustache",$data);
    }
}
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

    public function home() {
        session_start();
        if(isset($_SESSION['name'])){
            $data['publicaciones'] = $this->model->getPublicaciones();
             $data["CONTENIDISTA"]=true; 
             $this->renderer->render("contenidistaView.mustache",$data);
        }
        else
        Redirect::doIt("/login/validarLogin");
       
    }
    public function alta(){
        session_start();
        if(isset($_SESSION['name'])){
             $data["CONTENIDISTA"]=true; 
             $this->renderer->render("altaPublicacion.mustache",$data);
        }
        else
        Redirect::doIt("/login/validarLogin");
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
        $this->renderer->render("altaEdicionSeccion.mustache",$data);
    }
}
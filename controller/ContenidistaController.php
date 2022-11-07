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
        $nombre = $_POST["descrip"];

        $this->model->alta($nombre);
        Redirect::doIt('/contenidista/home');
    }
}
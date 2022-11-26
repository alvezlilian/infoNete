<?php

class LectorController
{
    private $renderer;
    private $model;

    public function __construct($render, $model){
        $this->renderer = $render;
        $this->model = $model;
    }
    public function list(){
        if (!ValidatorSession::tienePermiso($_SESSION['rol'])){
            ValidatorSession::routerSession();
        }

    }
    public function verPublicaciones(){
        $data['publicaciones'] = $this->model->getPublicaciones();
        $data['rol'] = $_SESSION['rol'];
        $this->renderer->render("lectorPublicacionesView.mustache", $data);
    }
    public function verEdiciones(){
        $data['rol'] = $_SESSION['rol'];
        $idPublicacion = $_POST['idPublicacion'];
        $data['ediciones'] = $this->model->getEdicionesxId($idPublicacion);
        $this->renderer->render("lectorEdicionesView.mustache",$data);
    }

}
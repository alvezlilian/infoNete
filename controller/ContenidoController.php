<?php

class ContenidoController {
    private $renderer;
    private $view;

    public function __construct($render, $view) {
       $this->renderer =$render;
        $this->view = $view;
    }

    public function list() {

    }
    public function crearNoticia(){
        $this->renderer->render("contenidoForm.mustache");

    }
    public function cargarNoticia(){
        $nombreNoticia=$_POST["nombreNoticia"];
        $edicion=$_POST["edicion"];
        $seccionNoticia =$_POST["seccionNoticia"];
        $tipoNoticia=$_POST["tipoNoticia"];
        $precioNoticia=$_POST["precioNoticia"];
        $descripcionNoticia=$_POST["descripcionNoticia"];
        $tipoNoticia2=$_POST["tipoDescripcion"];
    }

}
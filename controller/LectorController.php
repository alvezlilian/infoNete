<?php

class LectorController
{
    private $renderer;
    private $model;

    public function __construct($render, $model)
    {
        $this->renderer = $render;
        $this->model = $model;
    }
    public function list(){
        if (!ValidatorSession::tienePermiso($_SESSION['rol'])){
            ValidatorSession::routerSession();
        }

    }
    public function home(){
        $data['notas']=$this->model->getNotas();
        $data['rol'] = $_SESSION['rol'];
        $this->renderer->render('lectorView.mustache', $data);

    }
    public function notaCompleta(){
        $idNota=$_GET["idNota"];
        $data['rol'] = $_SESSION['rol'];
        $data["nota"]=$this->model->getNotaCompletaxIdNota($idNota);
        $this->renderer->render("lectorViewNotaCompleta.mustache",$data);

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
    public function verNotasxEdicion(){
        $idEdicion = $_GET['idEdicion'];
        $data['notasEdicion'] = $this->model->getNotasxEdicion($idEdicion);
        $data['rol'] = $_SESSION['rol'];
        $this->renderer->render("lectorNotasView.mustache", $data);
    }
    public function comprarNota(){
        $data['rol'] = $_SESSION['rol'];
        $data['id'] = $_SESSION['id'];

        $idNota=$_GET["idNota"];
        $precioNota=$_GET["precio"];
        $idUsuario = $data['id'];

        $resultadoCompra = $this->model->comprarNota($idNota, $precioNota, $idUsuario);
        if($resultadoCompra){
            $respuesta = "Compra Exitosa";
            $this->renderer->render("respuestaCompra.mustache",$respuesta);
        }else{
            $respuesta = "Ya compró esta noticia";
            $this->verPublicaciones();
        }

    }
}
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
    public function home(){
        $data['contenidista']=$this->model->getContenidista();
        $data['notas']=$this->model->getNotas();
        $data['rol'] = $_SESSION['rol'];
        $this->renderer->render('lectorView.mustache', $data);

    }
    public function notaCompleta(){
        $data['contenidista']=$this->model->getContenidista();
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
    public function validarComprarNota(){
        $data['rol'] = $_SESSION['rol'];
        $data['id'] = $_SESSION['id'];

        $idNota=$_GET["idNota"];
        $precioNota=$_GET["precio"];
        $idUsuario = (int)$data['id'];
        $data['idNota'] = $idNota;
        $data['precio'] = $precioNota;
        $data['idUsuario'] = $idUsuario;

        $resultadoBusqueda = $this->model->buscarNota($idNota, $idUsuario);

        if(!$resultadoBusqueda){
            $this->renderer->render("validarCompraNota.mustache", $data);
        }else{
            $respuesta = "Ya compr?? esta noticia";
            $this->renderer->render('lectorView.mustache', $respuesta);
        }
    }

    public function comprarNota(){

        $data['rol'] = $_SESSION['rol'];
        $data['id'] = $_SESSION['id'];

        $idNota=$_POST["idNota"];
        $precioNota=$_POST["precio"];
        $idUsuario = (int)$data['id'];

        $precio = str_replace ( "$", '', $precioNota);
        $precioValidado = str_replace ( ".", '', $precio);

        $this->model->comprarNota($idUsuario, $idNota, $precioValidado);
        $respuesta = "Compra Exitosa";
        $this->renderer->render("respuestaCompra.mustache",$respuesta);
    }

    public function validarComprarEdicion(){
        $data['rol'] = $_SESSION['rol'];
        $data['id'] = $_SESSION['id'];

        $idNota=$_GET["idEdicion"];
        $precioNota=$_GET["precio"];
        $idUsuario = (int)$data['id'];
        $data['idNota'] = $idNota;
        $data['precio'] = $precioNota;
        $data['idUsuario'] = $idUsuario;

        $resultadoBusqueda = $this->model->buscarEdicion($idNota, $idUsuario);

        if(!$resultadoBusqueda){
            $this->renderer->render("validarCompraEdicion.mustache", $data);
        }else{
            $respuesta = "Ya compr?? esta edici??n";
            $this->renderer->render('lectorView.mustache', $respuesta);
        }
    }

    public function comprarEdicion(){
        $data['rol'] = $_SESSION['rol'];
        $data['id'] = $_SESSION['id'];

        $idEdicion=$_POST["idNota"];
        $precioNota=$_POST["precio"];
        $idUsuario = (int)$data['id'];

        $precio = str_replace ( "$", '', $precioNota);
        $precioValidado = str_replace ( ".", '', $precio);

        $this->model->comprarEdicion($idUsuario, $idEdicion, $precioValidado);
        $respuesta = "Compra Exitosa";
        $this->renderer->render("respuestaCompra.mustache",$respuesta);

    }
}
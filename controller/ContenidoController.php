<?php

class ContenidoController
{
    private $renderer;
    private $model;
    private $logger;


    public function __construct($render, $model,$logger)
    {
        $this->renderer = $render;
        $this->model = $model;
        $this->logger=$logger;

    }

    public function list()
    {

    }

    public function crearNoticia(){
        $data['rol'] = $_SESSION['rol'];
        $this->renderer->render("contenidoForm.mustache", $data);
    }

    public function cargarNoticia()
    {
        $carpeta="public/img/";

        $tituloNoticia = $_POST["tituloNoticia"];
        $subtitulo = $_POST["subtituloNoticia"];
        $edicion = $_POST["edicion"];
        $seccionNoticia = $_POST["seccionNoticia"];

        $precioNoticia = $_POST["precioNoticia"];
        $descripcionNoticia = $_POST["contenidoNoticia"];
        //tomamos el archivo file y lo guardo en las variables
        $archivo=$_FILES["imagen"]["name"];
        $archivoTemporal=$_FILES["imagen"]["tmp_name"];
        //muevo el archivo temporal a la carpera de destino
        move_uploaded_file($archivoTemporal,$carpeta.$archivo);

        $this->model->nuevaNoticia($tituloNoticia, $subtitulo, $edicion, $seccionNoticia, $precioNoticia, $descripcionNoticia, $archivo);

         Redirect::doIt("/");
    }

    public function secciones(){
        $date["secciones"]=$this->model->mostrarSecciones();
    }

}
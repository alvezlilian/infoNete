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

    $data['contenido']=$this->model->getContenido();
  //  $data['msj']=$msj;
        $this->renderer->render('listaContenido.mustache', $data);


    }
    public function editar(){
        $id=$_GET["id"];
        $date["nota"]=$this->model->EditNota($id);
        $this->renderer->render("edit.mustache",$date);

    }

    public function crearNoticia()

    {
        $data["secciones"]=$this->model->getSecciones();
        $data["ediciones"]=$this->model->getEdiciones();
        $this->renderer->render("contenidoForm.mustache",$data);

    }
    public function actualizar(){


        $carpeta="public/img/";
        $id=$_POST["id"];
        $tituloNoticia = $_POST["tituloNoticia"];
        $subtitulo = $_POST["subtituloNoticia"];
      $precioNoticia = $_POST["precioNoticia"];
        $descripcionNoticia =$_POST["contenidoNoticia"];
        //tomamos el archivo file y lo guardo en las variables
        $archivo=$_FILES["imagen"]["name"];

        $archivoTemporal=$_FILES["imagen"]["tmp_name"];
        //muevo el archivo temporal a la carpera de destino
        move_uploaded_file($archivoTemporal,$carpeta.$archivo);
       $link=$_POST["linkNoticia"];
        $this->model->actualizarNota($id,$tituloNoticia, $subtitulo, $precioNoticia, $descripcionNoticia, $archivo,$link);
        $this->list();
    }
    public function eliminar(){
      $msj="";
        $id=$_GET["id"];
      $fueEliminado=  $this->model->eliminarNota($id);
      if ($fueEliminado){
          $msj="se elimino correctamente";
      }else{
          $msj="hubo problemas al eliminar la nota";
      }
      $this->list();
    }

    public function cargarNoticia()
    {
        $carpeta="public/img/";
        $tituloNoticia = $_POST["tituloNoticia"];
        $subtitulo = $_POST["subtituloNoticia"];
        $edicion = $_POST["edicion"];
        echo ($edicion);
        $seccionNoticia = $_POST["seccion"];
        $precioNoticia = $_POST["precioNoticia"];

        $descripcionNoticia =$_POST["contenidoNoticia"];
        $link=$_POST["linkNoticia"];
        //tomamos el archivo file y lo guardo en las variables
       $archivo=$_FILES["imagen"]["name"];


        $archivoTemporal=$_FILES["imagen"]["tmp_name"];
        //muevo el archivo temporal a la carpera de destino
        move_uploaded_file($archivoTemporal,$carpeta.$archivo);


        $this->model->nuevaNoticia($tituloNoticia, $subtitulo, $edicion, $seccionNoticia, $precioNoticia, $descripcionNoticia, $archivo,$link);

       Redirect::doIt("contenido");
    }


}
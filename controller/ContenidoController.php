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
        if (!ValidatorSession::tienePermiso($_SESSION['rol'])){
            ValidatorSession::routerSession();
        }
    }


    public function home(){

        if (!ValidatorSession::tienePermiso($_SESSION['rol'])){
            ValidatorSession::routerSession();
        }

        $data['rol'] = $_SESSION['rol'];
        $data['contenido']=$this->model->getContenido();
        $this->renderer->render('listaContenido.mustache', $data);

    }
    public function editar(){
        if (!ValidatorSession::tienePermiso($_SESSION['rol'])){
            ValidatorSession::routerSession();
        }
        $date['rol'] = $_SESSION['rol'];

        $id=$_GET["id"];
        $date["nota"]=$this->model->EditNota($id);
        $this->renderer->render("edit.mustache",$date);

    }

    public function crearNoticia()

    {   if (!ValidatorSession::tienePermiso($_SESSION['rol'])){
        ValidatorSession::routerSession();
    }

        $data['rol'] = $_SESSION['rol'];

        $data["publicaciones"]=$this->model->getContenido();
        $this->renderer->render("contenidoForm.mustache",$data);

    }
    public function actualizar(){
        if (!ValidatorSession::tienePermiso($_SESSION['rol'])){
            ValidatorSession::routerSession();
        }        $data['rol'] = $_SESSION['rol'];

        $carpeta="public/img/notas/";
        $id=$_POST["id"];
        $tituloNoticia = $_POST["tituloNoticia"];
        $subtitulo = $_POST["subtituloNoticia"];
      $precioNoticia = $_POST["precioNoticia"];
        $descripcionNoticia =$_POST["contenidoNoticia"];
        //tomamos el archivo file y lo guardo en las variables
        $archivo=$_FILES["imagen"]["name"];
        $link=$_POST["linkNoticia"];

        if($archivo==""){
      $archivoViejo=$_POST["imagenVieja"];

    $this->model->actualizarNota($id,$tituloNoticia, $subtitulo, $precioNoticia, $descripcionNoticia, $archivoViejo,$link);
    $this->home();
}
else{

    $archivoTemporal=$_FILES["imagen"]["tmp_name"];
    //muevo el archivo temporal a la carpera de destino
    move_uploaded_file($archivoTemporal,$carpeta.$archivo);
    echo ($carpeta.$archivoTemporal);
    $this->model->actualizarNota($id,$tituloNoticia, $subtitulo, $precioNoticia, $descripcionNoticia, $archivo,$link);
    $this->home();
}


    }
    public function eliminar(){
        if (!ValidatorSession::tienePermiso($_SESSION['rol'])){
            ValidatorSession::routerSession();
        }
        $data['rol'] = $_SESSION['rol'];
        $id=$_GET["id"];
      $fueEliminado=  $this->model->eliminarNota($id);
      if ($fueEliminado){
          $msj="se elimino correctamente";
      }else{
          $msj="hubo problemas al eliminar la nota";
      }
      $this->home();
    }

    public function cargarNoticia()
    {
        if (!ValidatorSession::tienePermiso($_SESSION['rol'])){
            ValidatorSession::routerSession();
        }
        //$data['rol'] = $_SESSION['rol'];
        $idUsuario['id']=$_SESSION['id'];

        $carpeta="public/img/notas/";
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
          $this->model->nuevaNoticia($tituloNoticia, $subtitulo, $edicion, $seccionNoticia, $precioNoticia, $descripcionNoticia, $archivo,$link,$idUsuario['id']);










       Redirect::doIt("home");
    }


    public function obtenerSecciones(){

        $idEdicion = $_POST['edicion'];
        echo ($idEdicion);
        $seccionesDeLaEdicion = $this->model->getSeccionesDeLaEdicion($idEdicion);

        foreach ($seccionesDeLaEdicion as $seccion){
            echo "<option value = '". $seccion['id']."'>" . $seccion['descrip'] . "</option>";
        }


    }
    public function obtenerPublicaciones(){
        $ediciones = $this->model->getEdiciones($_POST['publicacion']);
        foreach ($ediciones as $i){
            echo "<option value = '". $i['id']."'>" . $i['descrip'] . "</option>";
        }
    }

}
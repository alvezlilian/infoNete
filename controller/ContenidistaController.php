<?php
class ContenidistaController{

    private $renderer;
    private $model;

    public function __construct($render, $model) {
        $this->renderer =$render;
        $this->model = $model;
    }

    public function list(){
        if (!ValidatorSession::tienePermiso($_SESSION['rol'])){
            ValidatorSession::routerSession();
        }
    }

    public function home(){

        $data['publicaciones'] = $this->model->getPublicaciones();
        $data['rol'] = $_SESSION['rol'];
        $this->renderer->render("contenidistaView.mustache",$data);
    }

    public function alta(){
        if (!ValidatorSession::tienePermiso($_SESSION['rol'])){
            ValidatorSession::routerSession();
        }
        $data["CONTENIDISTA"]=true;
        $data['alta'] = true;
        $this->renderer->render("publicacion.mustache",$data);
    }

    public function procesarAlta(){

        if (!ValidatorSession::tienePermiso($_SESSION['rol'])){
            ValidatorSession::routerSession();
        }
        $path="public/img/publications/";
        $nombre = $_POST["descrip"];

        $name_img=$_FILES['imagen']['name'];
        $archivoTemporal=$_FILES["imagen"]["tmp_name"];

        $path_complete=$path.$name_img;
        move_uploaded_file($archivoTemporal,$path_complete);
        if(isset($_POST['idPublicacion']))
            $this->model->updatePublicacion($_POST['idPublicacion'],$nombre,$path_complete);
        else
            $this->model->altaPublicacion($nombre,$path_complete);

        Redirect::doIt('/contenidista/home');
    }

    public function altaEdicion(){
        if (!ValidatorSession::tienePermiso($_SESSION['rol'])){
            ValidatorSession::routerSession();
        }
        $data['secciones']=$this->model->getSecciones();
        $data['publicaciones'] = $this->model->getPublicaciones();
        $data["CONTENIDISTA"]=true;
        $data['rol'] = $_SESSION['rol'];
        $this->renderer->render("altaEdicionSeccion.mustache",$data);
    }
    public function procesarAltaEdicionSeccion()
    {
        if (!ValidatorSession::tienePermiso($_SESSION['rol'])){
            ValidatorSession::routerSession();
        }
        $numEdicion = $_POST["edicion"];
        $valor = $_POST["valor"];
        $idPublicacion = (int)$_POST["publicacion"];
        $flag=$this->model->buscarEdicionxNum($numEdicion,$idPublicacion);
        $seccion =[];
        if($flag==false) {
            if(isset($_POST['seccion'])){
                foreach ($_POST['seccion'] as $i) {
                    array_push($seccion, (int)$i);
                }
                $idEdicion = $this->model->altaEdicion($idPublicacion, $numEdicion, $valor);
                foreach ($seccion as $i) {
                    $this->model->altaEdicionSeccion($idEdicion, $i);
                }
            }
            else{
                $idEdicion = $this->model->altaEdicion($idPublicacion, $numEdicion, $valor);
            }
            Redirect::doIt('/contenidista/home');
        }
        else {
            Redirect::doIt('/contenidista/altaEdicion');
        }
    }
    public function agregarSeccion(){
        if (!ValidatorSession::tienePermiso($_SESSION['rol'])){
            ValidatorSession::routerSession();
        }
        $data['secciones'] = $this->model->getSecciones();
        $data['publicaciones'] = $this->model->getPublicaciones();
        $data["CONTENIDISTA"] = true;
        $this->renderer->render("agregarSeccion.mustache", $data);
    }
    public function obtenerPublicaciones(){
        $ediciones = $this->model->getEdiciones($_POST['publicacion']);
        foreach ($ediciones as $i){
            echo "<option value = '". $i['id']."'>" . $i['descrip'] . "</option>";
        }
    }
    public function obtenerSecciones(){
        if (!ValidatorSession::tienePermiso($_SESSION['rol'])){
            ValidatorSession::routerSession();
        }
        $idEdicion = $_POST['edicion'];
        $seccionesInexistentes= $this->model->getSeccionesInexistenes($idEdicion);
        $seccionesExistentes = $this->model->getSeccionesExistenes($idEdicion);
        if($seccionesExistentes){
            echo"<h4>Secciones a agregar</h4>";
            foreach($seccionesExistentes as $seccion){
                echo "<input type='checkbox' checked=true name=seccion[] value='".$seccion['id']."'disabled>";
                echo "<label style='margin-right: 2%'>".$seccion['descrip']."</label>";
            }
            foreach($seccionesInexistentes as $seccion){
                echo "<input type='checkbox' name=seccion[] value='".$seccion['id']."'>";
                echo "<label style='margin-right: 2%'>".$seccion['descrip']."</label>";
            }
        }
        else{
            $totalSecciones = $this->model->getSecciones();
            foreach($totalSecciones as $seccion){
                echo "<input type='checkbox' name=seccion[] value='".$seccion['id']."'>";
                echo "<label style='margin-right: 2%'>".$seccion['descrip']."</label>";
            }
        }

    }
    public function procesaAltaSoloEdicionSeccion(){
        if (!ValidatorSession::tienePermiso($_SESSION['rol'])){
            ValidatorSession::routerSession();
        }
        $idEdicion = $_POST["edicion"];
        foreach ($_POST["seccion"] as $i) {
            $this->model->altaEdicionSeccion($idEdicion, $i);
        }
        redirect::doIt('/contenidista/home');
    }
    public function modificarPublicacion(){
        $data["CONTENIDISTA"]=true;
        $data['modificar'] = $this->model->getPublicacionxId($_POST['modificar']);
        $this->renderer->render("/publicacion.mustache",$data);
    }
    public function procesaEliminarPublicacion(){
        $this->model->deleteEdicionxPublicacion($_POST['eliminar']);
        $this->model->deletePublicacion($_POST['eliminar']);
        redirect::doIt("/contenidista/home");
    }
}
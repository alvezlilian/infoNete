<?php
class ContenidistaController
{

    private $renderer;
    private $model;

    public function __construct($render, $model)
    {
        $this->renderer = $render;
        $this->model = $model;
    }

    public function list()
    {
        if (!ValidatorSession::tienePermiso($_SESSION['rol'])) {
            ValidatorSession::routerSession();
        }
    }

    public function home()
    {

        $data['publicaciones'] = $this->model->getPublicaciones();
        $data['rol'] = $_SESSION['rol'];
        $this->renderer->render("contenidistaView.mustache", $data);
    }

    public function alta()
    {
        if (!ValidatorSession::tienePermiso($_SESSION['rol'])) {
            ValidatorSession::routerSession();
        }
        $data["CONTENIDISTA"] = true;
        $data['alta'] = true;
        $this->renderer->render("publicacion.mustache", $data);
    }

    public function procesarAlta()
    {

        if (!ValidatorSession::tienePermiso($_SESSION['rol'])) {
            ValidatorSession::routerSession();
        }
        $path = "public/img/publications/";
        $nombre = $_POST["descrip"];

        $name_img = $_FILES['imagen']['name'];
        $archivoTemporal = $_FILES["imagen"]["tmp_name"];

        $path_complete = $path . $name_img;
        move_uploaded_file($archivoTemporal, $path_complete);
        if (isset($_POST['idPublicacion']))
            $this->model->updatePublicacion($_POST['idPublicacion'], $nombre, $path_complete);
        else
            $this->model->altaPublicacion($nombre, $path_complete);

        Redirect::doIt('/contenidista/home');
    }

    public function altaEdicion()
    {
        if (!ValidatorSession::tienePermiso($_SESSION['rol'])) {
            ValidatorSession::routerSession();
        }
        $data['secciones'] = $this->model->getSecciones();
        $data['publicaciones'] = $this->model->getPublicaciones();
        $data["CONTENIDISTA"] = true;
        $data['rol'] = $_SESSION['rol'];
        $this->renderer->render("altaEdicionSeccion.mustache", $data);
    }

    public function procesarAltaEdicionSeccion()
    {
        if (!ValidatorSession::tienePermiso($_SESSION['rol'])) {
            ValidatorSession::routerSession();
        }
        $numEdicion = $_POST["edicion"];
        $valor = $_POST["valor"];
        $idPublicacion = (int)$_POST["publicacion"];
        $flag = $this->model->buscarEdicionxNum($numEdicion, $idPublicacion);
        $seccion = [];
        if ($flag == false) {
            if (isset($_POST['seccion'])) {
                foreach ($_POST['seccion'] as $i) {
                    array_push($seccion, (int)$i);
                }
                $idEdicion = $this->model->altaEdicion($idPublicacion, $numEdicion, $valor);
                foreach ($seccion as $i) {
                    $this->model->altaEdicionSeccion($idEdicion, $i);
                }
            } else {
                $idEdicion = $this->model->altaEdicion($idPublicacion, $numEdicion, $valor);
            }
            Redirect::doIt('/contenidista/home');
        } else {
            Redirect::doIt('/contenidista/altaEdicion');
        }
    }

    public function agregarSeccion()
    {
        if (!ValidatorSession::tienePermiso($_SESSION['rol'])) {
            ValidatorSession::routerSession();
        }
        $data['secciones'] = $this->model->getSecciones();
        $data['publicaciones'] = $this->model->getPublicaciones();
        $data["CONTENIDISTA"] = true;
        $this->renderer->render("agregarSeccion.mustache", $data);
    }

    public function obtenerPublicaciones()
    {
        $ediciones = $this->model->getEdiciones($_POST['publicacion']);
        foreach ($ediciones as $i) {
            echo "<option value = '" . $i['id'] . "'>" . $i['descrip'] . "</option>";
        }
    }

    public function obtenerSecciones()
    {
        if (!ValidatorSession::tienePermiso($_SESSION['rol'])) {
            ValidatorSession::routerSession();
        }
        $idEdicion = $_POST['edicion'];
        $seccionesInexistentes = $this->model->getSeccionesInexistenes($idEdicion);
        $seccionesExistentes = $this->model->getSeccionesExistenes($idEdicion);
        if ($seccionesExistentes) {
            echo "<h4>Secciones a agregar</h4>";
            foreach ($seccionesExistentes as $seccion) {
                echo "<input type='checkbox' checked=true name=seccion[] value='" . $seccion['id'] . "'disabled>";
                echo "<label style='margin-right: 2%'>" . $seccion['descrip'] . "</label>";
            }
            foreach ($seccionesInexistentes as $seccion) {
                echo "<input type='checkbox' name=seccion[] value='" . $seccion['id'] . "'>";
                echo "<label style='margin-right: 2%'>" . $seccion['descrip'] . "</label>";
            }
        } else {
            $totalSecciones = $this->model->getSecciones();
            foreach ($totalSecciones as $seccion) {
                echo "<input type='checkbox' name=seccion[] value='" . $seccion['id'] . "'>";
                echo "<label style='margin-right: 2%'>" . $seccion['descrip'] . "</label>";
            }
        }

    }

    public function procesaAltaSoloEdicionSeccion()
    {
        if (!ValidatorSession::tienePermiso($_SESSION['rol'])) {
            ValidatorSession::routerSession();
        }
        $idEdicion = $_POST["edicion"];
        foreach ($_POST["seccion"] as $i) {
            $this->model->altaEdicionSeccion($idEdicion, $i);
        }
        redirect::doIt('/contenidista/home');
    }

    public function modificarPublicacion()
    {
        $data["CONTENIDISTA"] = true;
        $data['modificar'] = $this->model->getPublicacionxId($_POST['modificar']);
        $this->renderer->render("/publicacion.mustache", $data);
    }

    public function procesaEliminarPublicacion()
    {
        $this->model->deleteEdicionxPublicacion($_POST['eliminar']);
        $this->model->deletePublicacion($_POST['eliminar']);
        redirect::doIt("/contenidista/home");
    }


    public function PublicacionesPendientes()
    {
        if (!ValidatorSession::tienePermiso($_SESSION['rol'])) {
            ValidatorSession::routerSession();
        }

        $data['rol'] = $_SESSION['rol'];
        $data['notas'] = $this->model->verNotasPendientes();

        $this->renderer->render("notasPendientesContenidista.mustache", $data);

    }

    public function publicar()
    {
        if (!ValidatorSession::tienePermiso($_SESSION['rol'])) {
            ValidatorSession::routerSession();
        }

        $data['rol'] = $_SESSION['rol'];
        $this->model->cambiarNotaAPublicado($_GET['id']);
        redirect::doIt("/contenidista/publicacionesPendientes");


    }

    public function verMasInfo()
    {
        if (!ValidatorSession::tienePermiso($_SESSION['rol'])) {
            ValidatorSession::routerSession();
        }

        $data['rol'] = $_SESSION['rol'];
        $data['nota'] = $this->model->verMasNota($_GET['id']);
        $this->renderer->render("viewNotaContenidista.mustache", $data);


    }

    public function publicacionesPublicadas()
    {

        if (!ValidatorSession::tienePermiso($_SESSION['rol'])) {
            ValidatorSession::routerSession();
        }

        $data['rol'] = $_SESSION['rol'];
        $data['publicaciones'] = $this->model->getPublicaciones();
        $this->renderer->render("publicacionesPublicadasContenidista.mustache", $data);


    }

    public function obtenerSeccionesContenidista()
    {
        $secciones = $this->model->getSeccionesExistenes($_POST['edicion']);
        foreach ($secciones as $i) {
            echo "<option value = '" . $i['id'] . "'>" . $i['descrip'] . "</option>";
        }
    }
public function obtenerNotas(){
        $notas=$this->model->getNotas($_POST['seccion']);
        if (count($notas)>0){
            foreach ($notas as $i) {
                echo "<h2 style='text-align: center'>".$i['Titulo']. "</h2>
                <p>".$i['estado']."</p>
                <figure style='height: 35%'>
                <img src='../public/img/notas/".$i['Imagen']."' style='margin-bottom: 15pz;width: 88%;height: 90%'>
</figure>
<h5 class='text-truncate'> ".$i['Subtitulo']."</h5> 
<a style='display: block' href='verMasInfoDarDeBaja?id=".$i['id']."'>ver mas</a>
<a class='btn btn-outline-primary' href='darDeBaja?id=".$i['id']."'>Dar de baja</a>";
            }
        }else{
            echo "<h3> no hay notas</h3>";

        }

}
 public function darDeBaja(){
      $this->model->darDeBajaPublicacion($_GET['id']);
     redirect::doIt('/contenidista/home');

    }
    public function verMasInfoDarDeBaja(){
        if (!ValidatorSession::tienePermiso($_SESSION['rol'])) {
            ValidatorSession::routerSession();
        }

        $data['rol'] = $_SESSION['rol'];
        $data['nota'] = $this->model->verMasNota($_GET['id']);
        $this->renderer->render("viewNotaContenidistaDarDeBaja.mustache", $data);

    }
}



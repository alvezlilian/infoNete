<?php

class PresentacionesController {
    private $presentacionesModel;
    private $renderer;
    private $logger;

    public function __construct($presentacionesModel, $view, $logger) {
        $this->presentacionesModel = $presentacionesModel;
        $this->renderer = $view;
        $this->logger = $logger;
    }

    public function list() {
        $data['presentaciones'] = $this->presentacionesModel->getPresentaciones();
        $data['rol'] = $_SESSION['rol'];
        $this->logger->info("PresentacionesController: listaron las presentaciones");
        $this->renderer->render('tourView.mustache', $data);
    }

    public function alta() {
        $data['rol'] = $_SESSION['rol'];
        $this->renderer->render('tourAltaForm.mustache', $data);
    }

    public function procesarAlta() {
        $fecha  = $_POST['fecha'] ?? '';
        $precio = $_POST['precio'] ?? '';
        $nombre = $_POST['nombre'] ?? '';
        $this->presentacionesModel->alta($nombre,$precio,$fecha);

        Redirect::doIt("presentaciones");
    }
}


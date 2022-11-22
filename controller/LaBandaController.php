<?php

class LaBandaController {

    private $view;

    public function __construct($view) {
        $this->view = $view;
    }

    public function list() {
        if(isset($_SESSION['rol']))
        ValidatorSession::routerSession();
        else
        $this->view->render('labandaView.mustache');
    }
}
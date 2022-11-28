<?php

class AbmAdministradorController
{
    private $renderer;
    private $model;



    public function __construct($render, $model)
    {
        $this->renderer = $render;
        $this->model = $model;

    }

    public function list() {
     echo ("administrador");
    }
    public function home(){

        $this->renderer->render("FormRegistroContEscri.mustache");

    }
}
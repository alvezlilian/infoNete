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

    public function index_lector(){
        $this->renderer->render("lector_index.mustache");
    }

}
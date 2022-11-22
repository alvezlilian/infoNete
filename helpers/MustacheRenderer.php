<?php

class MustacheRenderer {
    private $mustache;
    private $viewFolder;

    public function __construct($viewFolder, $partialFolder) {
        $this->viewFolder = $viewFolder;

        Mustache_Autoloader::register();
        $this->mustache = new Mustache_Engine(
            array(
                'partials_loader' => new Mustache_Loader_FilesystemLoader( $partialFolder )
            ));
    }

    public function render($viewName, $datos = []) {
        if(isset($datos['rol'])){
            switch ($datos['rol']){
                case "ADMINISTRADOR":
                    $datos["ADMINISTRADOR"]= true;
                    break;
                case "CONTENIDISTA":
                    $datos["CONTENIDISTA"]= true;
                    break;
                case "ESCRITOR":
                    $datos["ESCRITOR"]= true;
                    break;
                case "LECTOR":
                    $datos["LECTOR"]= true;
                    break;
            }
        }
        $contentAsString =  file_get_contents($this->viewFolder . $viewName);
        echo  $this->mustache->render($contentAsString, $datos);
    }
}
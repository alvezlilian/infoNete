<?php
include_once ("helpers/Redirect.php");
include_once('helpers/MySQlDatabase.php');
include_once('helpers/MustacheRenderer.php');
include_once('helpers/Logger.php');
include_once('helpers/Router.php');

include_once('model/CancionesModel.php');
include_once('model/PresentacionesModel.php');
include_once ("model/QuieroSerParteModel.php");
include_once ("model/RegistrarseModel.php");
include_once ("model/LoginModel.php");
include_once ("model/ContenidoModel.php");
include_once ("model/ValidarLoginModel.php");
include_once("model/LectorModel.php");

include_once('controller/PresentacionesController.php');
include_once('controller/CancionesController.php');
include_once('controller/LaBandaController.php');
include_once('controller/QuieroSerParteController.php');
include_once('controller/RegistrarseController.php');
include_once('controller/LoginController.php');
include_once('controller/ContenidoController.php');
include_once('controller/LectorController.php');




include_once ('dependencies/mustache/src/Mustache/Autoloader.php');

class Configuration {
    private $database;
    private $view;

    public function __construct() {
        $this->database = new MySQlDatabase();
        $this->view = new MustacheRenderer("view/", 'view/partial/');
    }

    public function getPresentacionesController() {
        return new PresentacionesController(
            $this->getPresentacionesModel(),
            $this->view,
            new Logger());
    }

    public function getCancionesController() {
        return new CancionesController($this->createCancionesModel(), $this->view);
    }

    public function getLaBandaController() {
        return new LaBandaController($this->view);
    }

    public function getQuieroserparteController(){
        return new QuieroSerParteController($this->view, $this->getQuieroSerParteModel());
    }
    public function getRegistrarseController(){
        return new RegistrarseController($this->view,$this->getRegistrarseModel());
    }
    public function getLoginController(){
        return new LoginController($this->view,$this->getLoginModel());
    }

    public function getContenidoController(){
        return new ContenidoController($this->view,$this->getContenidoModel(),new Logger());
    }

    public function getLectorController(){
        return new LectorController($this->view,$this->getLectorModel());
    }

    private function createCancionesModel(): CancionesModel {
        return new CancionesModel($this->database);
    }

    private function getPresentacionesModel(): PresentacionesModel {
        return new PresentacionesModel($this->database);
    }

    public function getRouter() {
        return new Router($this, "laBanda", "list");
    }

    private function getQuieroSerParteModel() {
        return new QuieroSerParteModel($this->database);
    }

    private function getRegistrarseModel()
    {
        return new RegistrarseModel($this->database);
    }

    private function getLoginModel()
    {
        return new LoginModel($this->database);
    }

    private function getContenidoModel(){
        return new ContenidoModel($this->database);

    }

    private function getLectorModel(){
        return new LectorModel($this->database);
    }

}
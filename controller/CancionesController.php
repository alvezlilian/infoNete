<?php
class CancionesController
{
    private $renderer;
    private $model;
    private $session;


    public function __construct($render, $model)
    {
        $this->renderer = $render;
        $this->model = $model;
    }

    public function list()
    {
    }

    public function verVista(){
        if(isset($_SESSION)) {
            $this->renderer->render("cancionesView.mustache");
        }else{
            Redirect::doIt("https://www.google.com.ar/?hl=es-419");
        }

    }

    public function procesarLogin()
    {
        $email = $_POST["email"];
        $clave = $_POST["clave"];
        $resultado = $this->model->validarLogin($email, $clave);

        foreach ($resultado as $i) {
            $rol = $i['descripcion'];
        }

        session_start();
        $_SESSION['email'] = $email . ", rol: " . $rol;

        Redirect::doIt("/");
    }

    public function cerrarSesion()
    {
        if (isset($_SESSION['email'])) {
            session_destroy();
        }
        if (!isset($_session['email'])) {
            die("esta vacio");
        }
    }

}
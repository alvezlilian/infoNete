<?php

    class ValidatorSession{

        public static function routerSession(){
            if (!isset($_SESSION['rol'])){
                Redirect::doIt("/");
            }
            switch ($_SESSION['rol']){
                case "ADMINISTRADOR":
                    Redirect::doIt("/administrador/home");
                    break;
                case "CONTENIDISTA":
                    Redirect::doIt("/contenidista/home");
                    break;
                case "ESCRITOR":
                    Redirect::doIt("/contenido/home");
                    break;
                case "LECTOR":
                    Redirect::doIt("/lector/home");
                    break;
            }
        }

        public static function cerrarSesion(){
            if (isset($_SESSION['rol'])) {
                session_destroy();
                Redirect::doIt('/');
            }
            if(!isset($_session['rol'])){
                die("esta vacio");
            }
        }

        public static function sessionInit($nombre, $descripcion){
            session_start();
            $_SESSION['rol'] = $descripcion;
            $_SESSION['name'] = $nombre;
        }

        public static function tienePermiso($rol){
            if (is_null($rol['rol'])){
                Redirect::doIt('/login/validarLogin');
            }
            switch ($rol['rol']){
                case "ADMINISTRADOR":
                    return true;
                    break;
                case "CONTENIDISTA":
                    return true;
                    break;
                case "ESCRITOR":
                    return true;
                    break;
                case "LECTOR":
                    return true;
                    break;
                default:
                    return false;
                    break;
            }
        }

        public static function setSession(){
            if (!isset($_SESSION)){
                return null;
            }
            switch ($_SESSION['rol']){
                case "ADMINISTRADOR":
                    return "ADMINISTRADOR";
                    break;
                case "CONTENIDISTA":
                    return "CONTENIDISTA";
                    break;
                case "ESCRITOR":
                    return "ESCRITOR";
                    break;
                case "LECTOR":
                    return "LECTOR";
                    break;
                default:
                    return null;
                    break;
            }
        }

        public static function getSession(){
            return $_SESSION['rol'];
        }
    }
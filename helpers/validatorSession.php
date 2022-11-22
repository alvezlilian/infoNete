<?php

    class ValidatorSession{

        public static function routerSession(){
            if (!isset($_SESSION)){
                Redirect::doIt("/");
            }
            switch ($_SESSION['rol']){
                case "ADMINISTRADOR":
                    Redirect::doIt("https://www.google.com.ar/?hl=es-419");
                    break;
                case "CONTENIDISTA":
                    Redirect::doIt("/contenidista/home");
                    break;
                case "ESCRITOR":
                    Redirect::doIt("https://www.youtube.com/");
                    break;
                case "LECTOR":
                    Redirect::doIt("/");
                    break;
                default:
                    die(var_dump($_SESSION));
                    break;
            }
        }

        public static function cerrarSesion(){
            if(!isset($_session['email'])){
                die("esta vacio");
            }
            Redirect::doIt('/');
        }

        public static function sessionInit($nombre, $descripcion){
            session_start();
            $_SESSION['rol'] = $descripcion;
            $_SESSION['name'] = $nombre;
        }

        public static function tienePermiso($rol){
            if (is_null($rol)){
                Redirect::doIt('/login/validarLogin');
            }
            switch ($rol){
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

    }
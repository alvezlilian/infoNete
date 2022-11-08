<?php

    class validatorSession{

        public static function routerSession(){
            if (!isset($_SESSION)){
                Redirect::doIt("/");
            }
            switch ($_SESSION['rol']){
                case "ADMINISTRADOR":
                    Redirect::doIt("/");
                    break;
                case "CONTENIDISTA":
                    Redirect::doIt("/contenidista/home");
                    break;
                case "ESCRITOR":
                    Redirect::doIt("/");
                    break;
                case "LECTOR":
                    Redirect::doIt("/");
                    break;
                default:
                    Redirect::doIt("/");
                    break;
            }
        }

        public static function cerrarSesion(){
            if (isset($_SESSION['email'])) {
                session_destroy();
            }
            if(!isset($_session['email'])){
                die("esta vacio");
            }
        }

        public static function sessionInit($userData){
            session_start();
            $_SESSION['rol'] = $userData['descripcion'];
            $_SESSION['name'] = $userData['nombre'];
        }
    }
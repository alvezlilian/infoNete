<?php

    class ValidatorSession{

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
            if(!isset($_session['email'])){
                die("esta vacio");
            }
            Redirect::doIt('/');
        }

        public static function sessionInit($userData){
            session_start();
            $_SESSION['rol'] = $userData['descripcion'];
            $_SESSION['name'] = $userData['nombre'];
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



    }
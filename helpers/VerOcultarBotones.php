<?php

class VerOcultarBotones{
    public static function verOcultar(){
        if (!isset($_SESSION)){
            return null;
        }
        switch ($_SESSION['rol']){
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
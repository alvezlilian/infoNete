<?php

class VerOcultarBotones{
    public static function verOcultar(){
        if (!isset($_SESSION)){
            return null;
        }
        switch ($_SESSION['rol']){
            case "ADMINISTRADOR":
                return "OKEY";
                break;
            case "CONTENIDISTA":
                return "OKEY";
                break;
            case "ESCRITOR":
                return "OKEY";
                break;
            case "LECTOR":
                return "OKEY";
                break;
        }
    }
}
<?php
class MySQlDatabase {
    private $conexion;

    public function __construct($host_param = null,$user_param= null,$pass_param= null,$db_param= null) {
        $config = parse_ini_file("configuration/config.ini");

        $host = $host_param ?:  $config['host'];
        $user = $user_param ?: $config['user'];
        $pass = $pass_param ?:  $config['pass'];
        $db = $db_param ?: $config['db'];

        $this->conexion = new mysqli(
            $host,
            $user,
            $pass,
            $db);
    }

    /*
    // Esto estaba probando para usar workbench en mi pc
    public function __construct($host_param = null, $port_param=null, $socket_param= null ,$user_param= null,$pass_param= null,$db_param= null) {
        $config = parse_ini_file("configuration/config.ini");

        $host = $host_param ?:  $config['host'];
        $port = (int)$port_param ?: (int)$config['port'];
        $socket = $socket_param ?: $config['socket'];
        $user = $user_param ?: $config['user'];
        $pass = $pass_param ?:  $config['pass'];
        $db = $db_param ?: $config['db'];

        $this->conexion = new mysqli(
            $host,
            $port,
            $socket,
            $user,
            $pass,
            $db)
        or die ('Could not connect to the database server' . mysqli_connect_error());
    }
    */

    public function __destruct() {
        $this->conexion->close();
    }

    public function query($sql) {
        $respuesta = $this->conexion->query($sql);
        return $respuesta->fetch_all(MYSQLI_ASSOC);
    }

    public function execute($sql) {
        $this->conexion->query($sql); 
    }
    
}
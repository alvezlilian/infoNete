<?php
include_once ("configuration/Configuration.php");
session_start();
$configuration = new Configuration();
$router = $configuration->getRouter();
$router->redirect($_GET['controller'],$_GET['method']);
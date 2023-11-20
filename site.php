<?php

set_include_path("./src");
require_once("Router.php");
require_once("model/AnimalStorageSession.php");

session_start();

$config = include("./config.php");

$animalStorageImplementation = $config['animalStorageImplementation'];
$animalStorage = new $animalStorageImplementation();

$router = new Router();
$router->main($animalStorage);
?>
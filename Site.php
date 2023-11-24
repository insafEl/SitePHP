<?php

set_include_path("./src");
require_once("Router.php");
require_once("model/AnimalStorageSession.php");

session_start();

$config = include("./Config.php");

$animalStorageImplementation = $config['animalStorageImplementation'];
$animalStorage = new $animalStorageImplementation();

$router = new Router();
$router->main($animalStorage);
//session_destroy();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Application Title</title>
    <link rel="stylesheet" href="Style.css"> 
</html>
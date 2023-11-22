<?php

require_once("control/Controller.php");
require_once("view/View.php");
require_once("model/AnimalStorageSession.php");
require_once("model/AnimalBuilder.php");

class Router 
{

    public function getAnimalURL($id) 
    {
        return "Site.php?id=" . $id;
    }
    public function getAnimalCreationURL() 
    {
        return "Site.php?action=nouveau";
    }
    public function getAnimalSaveURL() 
    {
        return "Site.php?action=sauverNouveau";
    }

    public function main($animalStorage) 
    {
        $router = new Router();
        $view = new View($router);
        $controller = new Controller($view, $animalStorage);
        $id = isset($_GET['id']) ? $_GET['id'] : null;
        $liste = isset($_GET['liste']);
        if ($liste) {
            $controller->showList();
        } else {
            $controller->showInformation($id);
        }
        $action = isset($_GET['action']) ? $_GET['action'] : '';
        switch ($action) {
            case 'nouveau':
                $animalBuilder = new AnimalBuilder([]);
                $view->prepareAnimalCreationPage($animalBuilder);
                break;
            case 'sauverNouveau':
                $controller->saveNewAnimal($_POST);
                break;
            default:
            }
        $view->render();
    }
}
?>

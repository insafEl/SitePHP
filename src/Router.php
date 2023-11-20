<?php

require_once("control/controller.php");
require_once("view/view.php");
require_once("model/AnimalStorageSession.php");

class Router 
{

    public function getAnimalURL($id) 
    {
        return "site.php?id=" . $id;
    }

    public function main($animalStorage) 
    {
        $router = new Router();
        $view = new View($router);
        //$animalStorage = new AnimalStorageStub(); 
        $controller = new Controller($view, $animalStorage);
        $id = isset($_GET['id']) ? $_GET['id'] : null;
        $liste = isset($_GET['liste']);
        if ($liste) {
            $controller->showList();
        } else {
            $controller->showInformation($id);
        }
        $view->prepareDebugPage($animalStorage);
        $view->render();
    }
}
?>

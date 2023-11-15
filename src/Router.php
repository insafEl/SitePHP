<?php

require_once("control/controller.php");
require_once("view/view.php");
class Router 
{
    public function main() 
    {
        $view = new View();
        $view->prepareTestPage();
        $view->render();    
        $view = new View();
        $view->prepareAnimalPage("Médor", "chien");
        $view->render();

        $view = new View();
        $controller = new Controller($view);

        // Exemple d'utilisation avec l'ID 'medor'
        $controller->showInformation('dener');
        $view->render();
    }
}
?>

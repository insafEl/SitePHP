<?php

require_once("control/controller.php");
require_once("view/view.php");
class Router 
{
    public function main() 
    {
        /*$view = new View();
        $view->prepareTestPage();
        $view->render();    
        $view = new View();
        $view->prepareAnimalPage("Médor", "chien");
        $view->render();*/
        
        $view = new View();
        $controller = new Controller($view);
        $id = isset($_GET['id']) ? $_GET['id'] : null;
        $liste = isset($_GET['liste']);
        if ($liste) {
            $controller->showList();
        } else {
            $controller->showInformation($id);
        }
        $view->render();
    }
}
?>

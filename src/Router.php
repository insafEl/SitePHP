<?php

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
    }
}
?>

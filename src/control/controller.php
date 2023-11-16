<?php
require_once("view/view.php");
require_once("model/animal.php");

class Controller 
{
    private $view;

    public function __construct($view) 
    {
        $this->view = $view;
        $this->initializeAnimalsTab();
    }

    private function initializeAnimalsTab() 
    {
        $this->animalsTab = array(
            'medor' => new Animal('Médor', 'chien', 5),
            'felix' => new Animal('Félix', 'chat', 3),
            'denver' => new Animal('Denver', 'dinosaure', 100),
        );
    }
    
    public function showInformation($id) {
        if ($id === null) 
        {
            $this->view->prepareHomePage();
        }
        elseif (array_key_exists($id, $this->animalsTab)) 
        {
            $animal = $this->animalsTab[$id];
            $this->view->prepareAnimalPage($animal);
        } else {
            $this->view->prepareUnknownAnimalPage();
        }
    }

    public function showList() 
    {
        $this->view->prepareListPage($this->animalsTab);
    }

}
?>

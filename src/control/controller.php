<?php
require_once("view/view.php");

class Controller 
{
    private $view;

    public function __construct($view) 
    {
        $this->view = $view;
    }

    private $animalsTab = array(
        'medor' => array('Médor', 'chien'),
        'felix' => array('Félix', 'chat'),
        'denver' => array('Denver', 'dinosaure'),
        // Ajoutez d'autres animaux si vous le souhaitez
    );
    
    public function showInformation($id) {
        if ($id === null) 
        {
            $this->view->prepareHomePage();
        }
        elseif (array_key_exists($id, $this->animalsTab)) 
        {
            $animal = $this->animalsTab[$id];
            $this->view->prepareAnimalPage($animal[0], $animal[1]);
        } else {
            $this->view->prepareUnknownAnimalPage();
        }
    }
}
?>

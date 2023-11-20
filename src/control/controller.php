<?php

require_once("view/view.php");
require_once("model/animal.php");
require_once("model/AnimalStorage.php");

class Controller 
{
    private $view;
    private $animalStorage; 

    public function __construct($view, AnimalStorage $animalStorage) 
    {
        $this->view = $view;
        $this->animalStorage = $animalStorage; 
    }
    public function showInformation($id) 
    {
        if ($id === null) 
        {
            $this->view->prepareHomePage();
        }
        elseif ($animal = $this->animalStorage->read($id)) 
        {
            $this->view->prepareAnimalPage($animal);
        } else {
            $this->view->prepareUnknownAnimalPage();
        }
    }
    public function showList() 
    {
        $animalList = $this->animalStorage->readAll();
        $this->view->prepareListPage($animalList);
    }
}
?>

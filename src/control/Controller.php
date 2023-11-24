<?php

require_once("view/View.php");
require_once("model/Animal.php");
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
    public function saveNewAnimal(array $data) 
    {
        $animalBuilder = new AnimalBuilder($data);

        if ($animalBuilder->isValid()) 
        {
            $animal = $animalBuilder->createAnimal();
            $id = $this->animalStorage->create($animal);
            $this->view->displayAnimalCreationSuccess($id);
        } else 
        {
            $this->view->prepareAnimalCreationPage($animalBuilder);
        }
    }
}
?>

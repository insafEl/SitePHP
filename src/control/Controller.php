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
        $error = null;

        if (empty($data['name']) || empty($data['species']) || !is_numeric($data['age']) || $data['age'] < 0) 
        {
            $error = "Nom, espèce ne doivent pas être vides et l'âge doit être un nombre positif.";
            $this->view->prepareAnimalCreationPage($data, $error);
            return;
        }
        $animal = new Animal(htmlspecialchars($data['name']), htmlspecialchars($data['species']), htmlspecialchars($data['age']));
        $this->animalStorage->create($animal);
        $this->view->prepareAnimalPage($animal);
    }
}
?>

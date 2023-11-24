<?php

require_once("control/Controller.php");
require_once("view/View.php");
require_once("model/AnimalStorageSession.php");
require_once("model/AnimalBuilder.php");

class Router 
{
    public function POSTredirect($url, $feedback) 
    {
        $_SESSION['feedback'] = $feedback; 
        header("Location: " . $url, true, 303);
        exit();
    }
    public function getAnimalURL($id) 
    {
        return "?id=" . $id;
    }
    public function getAnimalCreationURL() 
    {
        return "?action=nouveau";
    }
    public function getAnimalSaveURL() 
    {
        return "?action=sauverNouveau";
    }
    public function main($animalStorage) 
    {
        $router = new Router();

        $pathInfo = isset($_SERVER['PATH_INFO']) ? $_SERVER['PATH_INFO'] : '';
        $pathInfo = ltrim($pathInfo, '/');

        $feedback = isset($_SESSION['feedback']) ? $_SESSION['feedback'] : '';
        unset($_SESSION['feedback']);

        $view = new View($this, $feedback);
        $controller = new Controller($view, $animalStorage);
        try
        {
            if(key_exists('id',$_GET))
            {
                $id = htmlspecialchars($_GET['id']);
                $controller->showInformation($id);
            }else if(key_exists('liste',$_GET))
            {
                $controller->showList();
            }else if(key_exists('action',$_GET))
            {
                $action =$_GET['action'];
                switch ($action) 
                {
                    case 'nouveau':
                        $animalBuilder = new AnimalBuilder([]);
                        $view->prepareAnimalCreationPage($animalBuilder);
                        break;
                    case 'sauverNouveau':
                        $controller->saveNewAnimal($_POST);
                        break;
                    default:
                }
            }else if(empty($pathInfo))
            {
                $view->prepareHomePage();
            }else
            {
                $id=basename($pathInfo);
                $controller->showInformation($id);
            }
        }catch(Exception $e)
        {
            echo "unexpected error ".$e;
        }
        $view->render();
    }
}
?>

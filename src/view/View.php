<?php
class View 
{
    public $title;
    public $content;
    private $router;
    private $feedback;
    private $menu; 

    public function __construct($router,$feedback = "") 
    {
        $this->router = $router;
        $this->feedback = $feedback;
        $this->initializeMenu(); 
    }

    private function initializeMenu()
    {
        $this->menu = [
            'Site.php' => 'Accueil',
            'Site.php?liste' => 'Liste des Animaux',
        ];
    }

    public function render() 
    {
        echo "<!DOCTYPE html>\n";
        echo "<html>\n";
        echo "<head>\n";
        echo "    <title>" . $this->title . "</title>\n";
        echo "</head>\n";
        echo "<body>\n";
        echo $this->renderMenu(); 
        echo "    <h1>" . $this->title . "</h1>\n";
        echo $this->content;
        echo "<div class='feedback'>" . htmlspecialchars($this->feedback) . "</div>";
        echo "</body>\n";
        echo "</html>\n";
    }

    private function renderMenu()
    {
        $menuHtml = "<nav><ul>";
        foreach ($this->menu as $url => $text) {
            $menuHtml .= "<li><a href='{$url}'>{$text}</a></li>";
        }
        $menuHtml .= "</ul></nav>";

        return $menuHtml;
    }
    public function prepareAnimalPage(Animal $animal) 
    {
        $this->title = "Page sur " . $animal->getName();
        $this->content = "<p>" . $animal->getName() . " est un animal de l'espèce " . $animal->getSpecies() . ".</p>";
        $this->content .= "<p>Âge : " . $animal->getAge() . " ans</p>";
    }
    public function prepareUnknownAnimalPage() 
    {
        $this->title = "Erreur";
        $this->content = "<p>Animal inconnu</p>";
    }
    public function prepareHomePage() 
    {
        $this->title = "Accueil";
        $this->content = "<p>Bienvenue sur notre site des animaux !</p>";
    }
    public function prepareListPage($animalList) 
    {
        $this->title = "Liste des Animaux";
        $this->content = "<ul>";

        foreach ($animalList as $id => $animal) 
        {
            $animalURL = $this->router->getAnimalURL($id);
            $this->content .= "<li><a href='{$animalURL}'>{$animal->getName()}</a></li>";
        }

        $this->content .= "</ul>";
    }
    public function prepareDebugPage($variable) 
    {
        $this->title = 'Debug';
        $this->content = '<pre>' . htmlspecialchars(var_export($variable, true)) . '</pre>';
    }
    public function prepareAnimalCreationPage(AnimalBuilder $animalBuilder) 
    {
        $this->title = "Création d'un nouvel animal";
        $data = $animalBuilder->getData();
        $error = $animalBuilder->getError();
        
        $name = $data[AnimalBuilder::NAME_REF] ?? '';
        $species = $data[AnimalBuilder::SPECIES_REF] ?? '';
        $age = $data[AnimalBuilder::AGE_REF] ?? '';

        $errorMessage = $error ? "<p style='color: red;'>$error</p>" : '';

        $this->content = $errorMessage . "<form action='" . $this->router->getAnimalSaveURL() . "' method='POST'>
            <label>Nom: <input type='text' name='" . AnimalBuilder::NAME_REF . "' value='" . htmlspecialchars($name) . "'></label><br>
            <label>Espèce: <input type='text' name='" . AnimalBuilder::SPECIES_REF . "' value='" . htmlspecialchars($species) . "'></label><br>
            <label>Âge: <input type='number' name='" . AnimalBuilder::AGE_REF . "' value='" . htmlspecialchars($age) . "'></label><br>
            <input type='submit' value='Créer'>
        </form>";
    }
    public function displayAnimalCreationSuccess($id) 
    {
        $animalURL = $this->router->getAnimalURL($id);
        $this->router->POSTredirect($animalURL, "Animal créé avec succès");
    }
}
?>

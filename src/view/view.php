<?php
class View 
{
    public $title;
    public $content;
    private $router;
    private $menu; // Nouvel attribut pour le menu

    public function __construct($router) 
    {
        $this->router = $router;
        $this->initializeMenu(); // Initialiser le menu
    }

    private function initializeMenu()
    {
        $this->menu = [
            'site.php' => 'Accueil',
            'site.php?liste' => 'Liste des Animaux',
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
    public function prepareDebugPage($variable) {
        $this->title = 'Debug';
        $this->content = '<pre>' . htmlspecialchars(var_export($variable, true)) . '</pre>';
    }
}
?>

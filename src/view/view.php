<?php
class View 
{
    public $title;
    public $content;

    public function render() 
    {
        echo "<!DOCTYPE html>\n";
        echo "<html>\n";
        echo "<head>\n";
        echo "    <title>" . $this->title . "</title>\n";
        echo "</head>\n";
        echo "<body>\n";
        echo "    <h1>" . $this->title . "</h1>\n";
        echo $this->content;
        echo "</body>\n";
        echo "</html>\n";
    }
    public function prepareTestPage() 
    {
        $this->title = "Page de Test";
        $this->content = "<p>Ceci est une page de test.</p>";
    }

    public function prepareAnimalPage($name, $species) 
    {
        $this->title = "Page sur " . $name;
        $this->content = "<p>" . $name . " est un animal de l'espèce " . $species . ".</p>";
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
}
?>

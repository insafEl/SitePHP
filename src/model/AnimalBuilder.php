<?php
class AnimalBuilder 
{
    public const NAME_REF = 'NAME';
    public const SPECIES_REF = 'species';
    public const AGE_REF = 'AGE';
    private $data;
    private $error;

    public function __construct(array $data) 
    {
        $this->data = $data;
        $this->error = null;
    }

    public function getData() 
    {
        return $this->data;
    }

    public function getError() 
    {
        return $this->error;
    }

    public function createAnimal() 
    {
        return new Animal(htmlspecialchars($this->data[self::NAME_REF]), htmlspecialchars($this->data[self::SPECIES_REF]), htmlspecialchars($this->data[self::AGE_REF]));
    }

    public function isValid() 
    {
        if (empty($this->data[self::NAME_REF]) || empty($this->data[self::SPECIES_REF]) || !is_numeric($this->data[self::AGE_REF]) || $this->data[self::AGE_REF] < 0) {
            $this->error = "Nom, espèce ne doivent pas être vides et l'âge doit être un nombre positif.";
            return false;
        }
        return true;
    }
}
?>
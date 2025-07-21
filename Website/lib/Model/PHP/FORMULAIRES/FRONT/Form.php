<?php
// Crée un formulaire php en front afin de simplifier la création des formulaires

require_once 'FormElement.php';
require_once 'Fields.php';
require_once 'ListeBDD.php';
require_once 'Liste.php';

class Form {
    private string $idFormulaire;
    private bool $DefaultbtnStatus = true; // Indique si le bouton par défaut est actif 
    
    private array $elements = [];
    
    public function __construct(string $idFormulaire, bool $DefaultbtnStatus = true) {
        $this->idFormulaire = $idFormulaire;
        $this->DefaultbtnStatus = $DefaultbtnStatus;
    }

    public function addElement(FormElement $element): void {
        $this->elements[] = $element;
    }

    public function getData(): array {
        $data = [];

        foreach ($this->elements as $element) {
            $data[] = $element->getData($this->idFormulaire);
        }
        return [
            'id' => $this->idFormulaire,
            'elements' => $data,
            'DefaultbtnStatus' => $this->DefaultbtnStatus
        ];
    }
}
?>
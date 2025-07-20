<?php

/** Champs du formulaire qui ne sont pas des listes 
*/

require_once 'FormElement.php';


class Fields implements FormElement {

    private string $nom;
    private string $type;
    private string $placeholder;
    private string $attribut;
    private string $fields_type;
    private string $value;

    public function __construct(string $nom, string $type, string $placeholder, string $attribut, string $fields_type = '', string $value = '') {
        $this->nom = $nom;
        $this->type = $type;
        $this->placeholder = $placeholder;
        $this->attribut = $attribut;
        $this->fields_type = $fields_type;
        $this->value = $value;
    }

    public function getNom(): string {
        return $this->nom;
    }
    public function getType(): string {
        return $this->type;
    }
    public function getPlaceholder(): string {
        return $this->placeholder;
    }

    public function getRequis(): string {
        return $this->attribut;
    }
    public function getFieldsType(): string {
        return $this->fields_type;
    }
    public function getValue(): string {
        return $this->value;
    }

    public function setNom(string $nom): void {
        $this->nom = $nom;
    }

    public function setType(string $type): void {
        $this->type = $type;
    }

    public function setPlaceholder(string $placeholder): void {
        $this->placeholder = $placeholder;
    }

    public function setRequis(string $attribut): void {
        $this->attribut = $attribut;
    }
    public function setFieldsType(string $fields_type): void {
        $this->fields_type = $fields_type;
    }
    public function setValue(string $value): void {
        $this->value = $value;
    }

   public function CreateField(string $idFormulaire): array {
    return [
        'idFormulaire' => $idFormulaire,
        'nom' => $this->nom,
        'type' => $this->type,
        'placeholder' => $this->placeholder,
        'attribut' => $this->attribut,
        'fields_type' => $this->fields_type,
        'value' => $this->value
    ];
}

    // Pour interagir avec le formulaire
    public function getData(): array {
        return [
            'nom' => $this->nom,
            'type' => $this->type,
            'placeholder' => $this->placeholder,
            'attribut' => $this->attribut,
            'fields_type' => $this->fields_type,
            'value' => $this->value
        ];
    }
}
?>
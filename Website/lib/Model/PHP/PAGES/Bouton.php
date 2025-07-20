<?php

class Bouton {
    private string $id;
    private string $text;
    private string $class;
    private array $attributs;

    /** @var array<Bouton> */
    private array $element;

    public function __construct(string $id, string $text = '', string $class = '', array $element = [], array $attributs = []) {
        $this->id = $id;
        $this->text = $text;
        $this->class = $class;
        $this->element = $element;
        $this->attributs = $attributs;
    }

    public function gen_Bouton(): array {
        return 
        [
            'id'=>$this->id,
            'class'=>$this->class,
            'text' => $this->text,
            'element'=>$this->element,
            'attributs' => $this->attributs
        ];

    }
}

?>
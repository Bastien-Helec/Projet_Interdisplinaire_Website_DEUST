<?php

Class Args_CSS {

    private string $class_id;
    // Appel des propriétés et de la valeur syntaxe : propriété => valeur
    private array $prop_value = [];


    public function __construct(string $class_id, array $global_regles =[] ) {
        $this->class_id=$class_id;
        $this->prop_value = $global_regles;
    }


    public function set(string $prop, string $value) {
        $this->prop_value[$prop]= $value;
        return $this;

    }

    public function gen_css(): string {
        // Construction de chaque ligne par rapport a set
        $lines = array_map(
            fn($pro,$val) => "{$pro}:{$val};",
            array_keys($this->prop_value),
            $this->prop_value
        );

        $prop_value_str= implode("\n", $lines);
        return "{$this->class_id} {\n{$prop_value_str}\n}\n";

    }


}

?>
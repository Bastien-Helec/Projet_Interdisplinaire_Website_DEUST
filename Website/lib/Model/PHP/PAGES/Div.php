<?php

Class Div {
    private string $id;
    private string $class;
    private array $element;

    public function __construct(string $id, string $class, array $element) {
        $this->id=$id;
        $this->class=$class;
        $this->element=$element;
    }

    public function gen_div() : array {
        return 
        [
            'id'=>$this->id,
            'class'=>$this->class,
            'element'=>$this->element            
        ];

    }
}

?>
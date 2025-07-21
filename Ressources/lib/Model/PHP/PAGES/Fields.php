<?php

class Glob_Fields{
    private string $id;
    private string $class;
    private string $balise;
    private string|array $text;
    private string $type;

    private string $name;
    
    public function __construct(string $id ,string $class, string $balise, string|array $text ,string $type = '', string $name = '') {
        $this->id = $id;
        $this->class = $class;
        $this->balise = $balise;
        $this->text = $text;
        $this->type = $type;
        $this->name = $name;
    }

    public function gen_balise() : array {
        return 
        [
            'id'=>$this->id,
            'type'=>$this->type,
            'class'=>$this->class,
            'balise'=>$this->balise,
            'text'=>$this->text
            ,'name'=>$this->name            
        ];
    }
}

?>
<?php

Class Logo {
    private string $src;
    private string $id;
    private string $class;


    public function __construct(string $src, string $id, string $class) {
        $this->src=$src;
        $this->id=$id;
        $this->class=$class;
    }

    public function gen_logo(): array{
        return [
            'id'=>$this->id,
            'src'=>$this->src,
            'class'=>$this->class,
        ];
    }
}


?>
<?php

Class JS_Remove_Event {

    private string $div_id;
    private string $btn_id;


    public function __construct(string $div_id, string $btn_id) {
        $this->div_id = $div_id;
        $this->btn_id = $btn_id;
    }

    public function gen_remove_js(): string {
        return "
            document.addEventListener('click', (event) => {
            if (!{$this->div_id}.contains(event.target) && {$this->btn_id} !== event.target ) {
                {$this->div_id}.classList.remove('deplacer');
                setTimeout(() => {
                {$this->div_id}.classList.remove('actif');
                }, 100);
    }
            });";
    }
}

?>
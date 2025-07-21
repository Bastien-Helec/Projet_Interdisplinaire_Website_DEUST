<?php

class JS_CALL_FORM {
    private string $id_div;
    private string $id_btn;
    private string $banner;

    public function __construct( string $id_div, string $id_btn, string $banner) {
        $this->id_div = $id_div;
        $this->id_btn = $id_btn;
        $this->banner = $banner;
    }

    public function gen_print_FORM_js() : string {
        return "
            {$this->id_btn}.addEventListener('click', (event) => {
                event.preventDefault();
                {$this->id_div}.classList.add('actif');
                {$this->id_div}.style.display='block';
                setTimeout(() => {
                    {$this->id_div}.classList.add('deplacer');
                }, 100);
                {$this->banner}.classList.remove('actif');
                });"
            ;
    }
}
?>
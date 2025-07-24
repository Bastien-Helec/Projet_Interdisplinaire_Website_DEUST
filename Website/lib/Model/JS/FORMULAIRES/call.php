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

public function gen_print_FORM_js(): string {
    if (!empty($this->id_btn) && !empty($this->id_div) && !empty($this->banner)) {
        return "
        document.addEventListener('DOMContentLoaded', () => {
            const btn = document.getElementById('{$this->id_btn}');
            const div = document.getElementById('{$this->id_div}');
            const banner = document.getElementById('{$this->banner}');
        
            if (btn && div && banner) {
                btn.addEventListener('click', (event) => {
                    event.preventDefault();
                    div.classList.add('actif');
                    div.style.display = 'block';
                    setTimeout(() => {
                        div.classList.add('deplacer');
                    }, 100);
                    banner.classList.remove('actif');
                });
            }
        });
        ";
    }

    return '';
}

}
?>
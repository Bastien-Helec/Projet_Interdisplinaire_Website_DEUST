<?php
class JS_Remove_Event {
    private string $div_id;
    private string $btn_id;

    public function __construct(string $div_id, string $btn_id) {
        $this->div_id = $div_id;
        $this->btn_id = $btn_id;
    }

    public function gen_remove_js(): string {
        return "
        document.addEventListener('DOMContentLoaded', () => {
            const div = document.getElementById('{$this->div_id}');
            const btn = document.getElementById('{$this->btn_id}');
            if (div && btn) {
                document.addEventListener('click', (event) => {
                    if (!div.contains(event.target) && event.target !== btn) {
                        div.classList.remove('deplacer');
                        setTimeout(() => {
                            div.classList.remove('actif');
                        }, 100);
                    }
                });
            }
        });";
    }
}


?>
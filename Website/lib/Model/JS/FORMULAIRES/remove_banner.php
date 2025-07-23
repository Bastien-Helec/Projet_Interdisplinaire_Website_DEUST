<?php

class JS_Remove_Banner {
    private string $id_banner;

    public function __construct(string $id_banner) {
        $this->id_banner = $id_banner;
    }

    public function Remove_Banner_js(): string {
        return "
        document.addEventListener('DOMContentLoaded', () => {
            const banner = document.getElementById('{$this->id_banner}');
            if (banner) {
                document.addEventListener('click', (event) => {
                    banner.classList.remove('actif');
                });
            }
        });";
    }
}

?>
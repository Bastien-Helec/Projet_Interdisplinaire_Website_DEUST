<?php

class JS_Call_Banner {
    private string $id_banner;
    private string $message;

    public function __construct(string $id_banner, string $message) {
        $this->id_banner = $id_banner;
        $this->message = $message;
    }

    public function Call_Banner_js(): string {
        return "
            {$this->id_banner}.textContent= '{$this->message}';
            {$this->id_banner}.classList.add('actif');
            "
        ;
    }
}
?>
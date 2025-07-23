<?php
class JS_Sort_ListeBDD {
    private string $id_div;

    public function __construct(string $id_div) {
        $this->id_div = $id_div;
    }

    public function gen_list_js(): string {
        $id_list_select = $this->id_div . '_select';
        $id_list_options = $this->id_div . '_options';
        $id_bouton = $this->id_div . '_choix_btn';
        $id_choix_valeur = $this->id_div . '_choix_valeur';

        return "
        document.addEventListener('DOMContentLoaded', () => {
            const listSelect = document.getElementById('$id_list_select');
            const listOptions = document.getElementById('$id_list_options');
            const bouton = document.getElementById('$id_bouton');
            const choixValeur = document.getElementById('$id_choix_valeur');

            if (listSelect && listOptions && bouton && choixValeur) {
                bouton.addEventListener('click', (event) => {
                    event.preventDefault();
                    listSelect.classList.toggle('actif');
                });

                listOptions.addEventListener('click', (event) => {
                    event.preventDefault();
                    if (event.target.tagName === 'LI') {
                        choixValeur.value = event.target.getAttribute('data-value');
                        bouton.textContent = event.target.textContent;
                        listSelect.classList.remove('actif');
                    }
                });
            }
        });";
    }
}

?>
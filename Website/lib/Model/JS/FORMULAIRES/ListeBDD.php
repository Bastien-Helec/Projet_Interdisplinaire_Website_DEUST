<?php

class JS_Sort_ListeBDD{
    // On va lister pour chaque liste les champs a afficher et on affichera avec le bouton qui gerer l'affichage de la liste associé
    private string $id_div;

    public function __construct(string $id_div){
        $this->id_div = $id_div;
        ;
    }

    public function gen_list_js() {
        $id_list_select = $this->id_div . '_select';
        $id_list_options = $this->id_div . '_options';
        $id_bouton = $this->id_div . '_choix_btn';
        $id_choix_valeur = $this->id_div . '_choix_valeur';

        return "
        
        if ({$id_list_select} && {$id_list_options} && {$id_bouton} && {$id_choix_valeur}) {
            {$id_bouton}.addEventListener('click', (event) => {
                event.preventDefault();
                {$id_list_select}.classList.toggle('actif');
            });

            {$id_list_options}.addEventListener('click', (event) => {
                event.preventDefault();
                if (event.target.tagName === 'LI') {
                {$id_choix_valeur}.value = event.target.getAttribute('data-value');
                {$id_bouton}.textContent = event.target.textContent;
                {$id_list_select}.classList.remove('actif');
            };
        });
    }
"    ;
}
};

?>
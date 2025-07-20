<?php

Class JS_Onclick_Event{
    private String $btn_id_class; 
    private String $file;
    private String $formulaire_to_display_id;
    private String $banner;


    public function __construct(String $btn_id_class, String $file, String $formulaire_to_display_id, String $banner) {
        $this->btn_id_class = $btn_id_class;
        $this->file = $file;
        $this->formulaire_to_display_id = $formulaire_to_display_id;
        $this->banner = $banner;
    }


public function getID_from_sameclass_js(string $ID): string {
    return "
        document.addEventListener('DOMContentLoaded', function() {
            const buttons = document.querySelectorAll('{$this->btn_id_class}');
            const formContainer = document.getElementById('{$this->formulaire_to_display_id}');
            const banner = document.getElementById('{$this->banner}');
            let currentId = null;

            if (!formContainer) {
                console.warn('Element cible non trouvé : #{$this->formulaire_to_display_id}');
                return;
            }

            buttons.forEach(btn => {
                btn.addEventListener('click', function(event) {
                    event.stopPropagation();
                    
                    // On tente d'abord de récupérer le data-ID selon la clé spécifique
                    let id = this.dataset['{$ID}'] || this.dataset.id;

                    if (!id) {
                        console.warn('ID non trouvé (ni data-{$ID}, ni data-id)');
                        return;
                    }

                    fetch('{$this->file}', {
                        method: 'POST',
                        headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
                        body: 'id=' + encodeURIComponent(id)
                    })
                    .then(response => response.text())
                    .then(html => {
                        if (id !== currentId && currentId !== null) {
                            location.reload();
                            return;
                        } else {
                            if (formContainer.classList.contains('actif')) {
                                formContainer.style.display = 'none';
                                formContainer.classList.remove('actif', 'deplacer');
                                currentId = id;
                            } else {
                                formContainer.style.display = 'block';
                                formContainer.classList.add('actif');
                                setTimeout(() => {
                                    formContainer.classList.add('deplacer');
                                }, 100);
                                currentId = id;
                            }
                        }

                        if (banner) {
                            banner.classList.remove('actif');
                        }
                    })
                    .catch(error => console.error('Erreur lors de la requête :', error));
                });
            });
        });
    ";
}
}


?>

<?php

/** 
 * Formulaire d'ajout d'un membre 
 * 
 * Si vide, pas de création de formulaire
 * 
 * Si non vide, on crée le formulaire
 * 
 */ 
if (!empty($formData)) {
    // var_dump($formData['id']);
    // Initialisation du header du formulaire
    echo '<div class="Formulaire" id="'.$formData['id']. '_div">';
    
    $Titre_Array = explode('_', $formData['id']);

    $Titre = '';
    foreach ($Titre_Array as $cmp_titre){
        $Titre .= ucfirst($cmp_titre) . ' ';
    }
    $Titre = trim($Titre);

    echo '<h2 style="text-align:center;"> '.$Titre.'</h2>';
    echo "<form id='{$formData['id']}_form'>";
    echo '<input type="hidden" name="form_id" value="'.$formData['id'].'">';
    
    /* Nos données sont stocker dans un tableau $formData. 
    - On va donc récupérer les données pour nos besoin spécifiques
    
    - On cherche tout ce qui est contenu dans elements (corresponds au fields et ou liste) et on simplifie nos recherches en nommant notre tableau $elements
    
    Pour chaque element on va faire une boucle
    */ 
    foreach ($formData['elements'] as $element) {
        
        // Si $elements contient un champs 'nom' c'est alors un type fields
        if (isset($element['nom'])) {

            // On vérifie si le champs est attribut ou non)
            $attribut = '';
            if (isset($element['attribut']) && $element['attribut'] === 'requis') {
                $attribut = 'required';
            } 
            if (isset($element['attribut']) && $element['attribut'] === 'readonly') {
                $attribut = 'readonly';   
            }

            $value = '';
            if ($element['value'] !== '') {
                $value = 'value="'.$element['value'].'"';
            }


            $fields_type = ''; 
            if (isset($element['fields_type']) && $element['fields_type'] === '') {
                echo '<input type= "'.$element['type']. '" name= "'. $element['nom']. '" id= "'.$formData['id']. '_'. $element['nom']. '" placeholder= "'.$element['placeholder']. '"'.$value.' '.$attribut.'>'; 
            } 
            elseif (isset($element['fields_type']) && $element['fields_type'] === 'br') {
                echo '<br>';
            }
            elseif (isset($element['fields_type']) && $element['fields_type'] === 'hr') {
                echo '<hr>';
            }
            
            elseif ($element['type'] == 'number') {
                echo '<input type= "'.$element['type']. '" min="1" '.$value.' name= "'. $element['nom']. '" id= "'.$formData['id']. '_'. $element['nom']. '" '.$attribut.'>';
                        }
            else {
                echo '<'.$element['fields_type'].' type= "'.$element['type']. '" name= "'. $element['nom']. '" id= "'.$formData['id']. '_'. $element['nom']. '" placeholder= "'.$element['placeholder']. '" '.$value.' '.$attribut.'> '. $element['placeholder'] . '</'.$element['fields_type'].'>';
            }

            // On vérifie si le champs est un type 'number'

        }


        // Si $elements contient un champs 'nom_liste' c'est alors un type liste
        elseif (isset($element['nom_liste'])) {
            // var_dump($element);

            echo '<div class="select" id= '.$formData['id'].'_' . $element['nom_liste'] . '_select>';
            // On créer donc le champ associé
            echo '<button id="'.$formData['id'].'_'.$element['nom_liste'].'_choix_btn" type="button">' . htmlspecialchars($element['nom_btn']) . '</button>';
            
            // On créer la liste
            echo '<ul id= "'.$formData['id']. '_' . $element['nom_liste'] . '_options">';

            // On va chercher les libelles de la BDD correspondante au valeur des colonnes
            foreach ($element['libelle'] as $opts) {
                $libelle = str_replace('_', ' ', $opts[$element['colonne']]);
                echo "<li id = '{$opts[$element['colonne']]}' data-value='{$opts[$element['colonne']]}'>" . htmlspecialchars($libelle) . "</li>";
            }
            // On ferme la liste
            echo '</ul>';

            // On créer un champs caché pour l'envoi au gestionnaire de formulaire backend
            echo '<input type="hidden" id= "'.$formData['id']. '_' . $element['nom_liste']. '_choix_valeur" name= "'.$formData['id'].'_' . $element['nom_liste']. '_name_choix_valeur"/>
            ';

            echo '</div>';
        }
    }
    // On ferme le formulaire avec un bouton d'envoi

    if ($formData['DefaultbtnStatus'] === true){
    echo '<button type="submit" id="'.$formData['id'].'_submit">Envoyer</button>';
    }
    echo '</form>';
    echo '</div>';
}

// Pour contre si notre tableau $formData est vide, on affiche un message
else {
    echo '<p>Aucun élément à afficher.</p>';
}

?>
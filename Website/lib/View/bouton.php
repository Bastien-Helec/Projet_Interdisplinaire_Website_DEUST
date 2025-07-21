<?php

function render_bouton(array $boutons): string {
    $html = '';

    foreach ($boutons as $bouton) {
        if (!($bouton instanceof Bouton)) {
            $html .= "<!-- Élément non Bouton détecté -->";
            continue;
        }

        $data = $bouton->gen_Bouton();
        if ($data['attributs'] && is_array($data['attributs'])) {
            // Génération des attributs HTML
            $attributes = '';
            foreach ($data['attributs'] as $key => $value) {
                $attributes .= " {$key}=\"" . htmlspecialchars($value) . "\"";
            }
        } else {
            $attributes = '';
        }

        $html .= "<button id='{$data['id']}' class='{$data['class']}' {$attributes} >";

        // Affichage du texte simple
        if (!empty($data['text'])) {
            $html .= htmlspecialchars($data['text']);
        }

        // Affichage des enfants (Div, Glob_Fields...)
        foreach ($data['element'] as $child) {
            if ($child instanceof Div) {
                $html .= render_element_DIV($child->gen_div());
            } elseif ($child instanceof Glob_Fields) {
                $html .= render_Glob_Fields($child->gen_balise());
            } elseif (is_string($child)) {
                $html .= $child;
            } else {
                $html .= "<!-- Élément enfant inconnu -->";
            }
        }

        $html .= "</button>";
    }

    return $html;
}

?>

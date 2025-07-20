<?php

function render_element_DIV($div_data){
    $html = "<div id='{$div_data['id']}' class='{$div_data['class']}'>";
    $bouton_html = '';
    $bouton_class = '';

    foreach ($div_data['element'] as $element) {
        if ($element instanceof Logo) {
            $data = $element->gen_logo();
            $html .= "<img src='{$data['src']}' alt='' id='{$data['id']}' class='{$data['class']}' />";
        }
        elseif ($element instanceof Bouton) {
            $data = $element->gen_Bouton();
            $bouton_class = $data['class'];
            $bouton_html .= "<button id='{$data['id']}'>{$data['text']}</button>";
        }
        elseif ($element instanceof Glob_Fields) {
            $html .= render_Glob_Fields($element->gen_balise()); // ✅ appel propre
        }
        elseif ($element instanceof Div) {
            $html .= render_element_DIV($element->gen_div()); // ✅ récursion propre
        }
    }

    if (!empty($bouton_html)) {
        $html .= "<div class='{$bouton_class}'>{$bouton_html}</div>";
    }

    $html .= "</div>";
    return $html;
}

?>
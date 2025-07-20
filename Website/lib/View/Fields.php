<?php

function render_Glob_Fields(array $Glob_Fields): string {

$attrs = '';

if (!empty($Glob_Fields['id'])) {
    $attrs .= " id='{$Glob_Fields['id']}'";
}

if (!empty($Glob_Fields['class'])) {
    $attrs .= " class='{$Glob_Fields['class']}'";
}

if (!empty($Glob_Fields['name'])) {
    $attrs .= " name='{$Glob_Fields['name']}'";
}

if (!empty($Glob_Fields['type'])) {
    $attrs .= " type='{$Glob_Fields['type']}'";
}

$html = "<{$Glob_Fields['balise']}{$attrs}>";

    $text = $Glob_Fields['text'];

    if (is_array($text)) {
        foreach ($text as $sub) {
            if (is_object($sub)) {
                if ($sub instanceof Div) {
                    $html .= render_element_DIV($sub->gen_div());
                } elseif ($sub instanceof Glob_Fields) {
                    $html .= render_Glob_Fields($sub->gen_balise());
                }
            } else {
                $html .= $sub; // texte brut
            }
        }
    } elseif (is_object($text)) {
        if ($text instanceof Div) {
            $html .= render_element_DIV($text->gen_div());
        } elseif ($text instanceof Glob_Fields) {
            $html .= render_Glob_Fields($text->gen_balise());
        }
    } else {
        $html .= $text;
    }

    $html .= "</{$Glob_Fields['balise']}>";
    return $html;
}
?>

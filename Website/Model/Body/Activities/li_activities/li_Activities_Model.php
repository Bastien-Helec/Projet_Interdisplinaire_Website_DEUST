<?php

require_once "./lib/Model/PHP/PAGES/Div.php";
require_once "./lib/Model/PHP/PAGES/Fields.php";
require_once "./lib/Model/PHP/BDD/SQL/FONCTIONS METIERS/Select.php"; 

function create_li_activities($number, $contenu) {
    $li_activities = new Glob_Fields("li_activite_{$number}_title", "div_li_activite_CLS", 'h4', "Activité {$number}");
    $li_activities_body = new Glob_Fields("li_activite_{$number}_body", "div_li_activite_CLS", 'p', "{$contenu}");

    $div_li_activities_number = new Div("li_activite_{$number}_ID", "div_li_activite_CLS", [
        $li_activities,
        $li_activities_body,
    ]);

    return $div_li_activities_number;
}

// Liste de toutes activités
$activites = Select_SQL::toutesLesActivites();

$liste_divs = [];

foreach ($activites as $index => $activite) {
    $contenu = "{$activite["libelle"]} | Tarif : {$activite["tarif"]} € | Places totales : {$activite["nbPlace"]}";
    $liste_divs[] = create_li_activities($index + 1, $contenu);
}

$div_li_activities = new Div(
    'div_li_activities_ID',
    'div_li_activities_CLS',
    array_merge([
        new Glob_Fields("li_activities_title_ID", "li_activities_title_CLS", "h1", "Liste des Activités")
    ], $liste_divs)
);

$div_li_activities = $div_li_activities->gen_div();
?>

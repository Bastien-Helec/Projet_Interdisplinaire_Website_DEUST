<?php

require_once "./lib/Model/PHP/PAGES/Div.php";
require_once "./lib/Model/PHP/PAGES/Fields.php";
require_once "./lib/Model/PHP/BDD/SQL/FONCTIONS_METIERS/Select.php";

function create_li_activities_planning($number, $contenu) {
    $li_activities = new Glob_Fields("li_activite_planning_{$number}_title", "div_li_activite_CLS", 'h4', "Activité {$number}");
    $li_activities_body = new Glob_Fields("li_activite_planning_{$number}_body", "div_li_activite_CLS", 'p', "{$contenu}");

    $div_li_activities_number = new Div("li_activite_planning_{$number}_ID", "div_li_activite_CLS", [
        $li_activities,
        $li_activities_body,
    ]);

    return $div_li_activities_number;
}

// Liste les activites + leur planning
$select= new Select_SQL($pdo_cnx);
$activites = $select->activitesAvecPlanning();

$liste_divs = [];
foreach ($activites as $index => $activite) {
    $contenu = "{$activite["libelle"]} | Tarif : {$activite["tarif"]} € | Places : {$activite["nbPlace"]} | Date : {$activite["date"]} | " .
    ($activite["estMatin"] ? "Matin" : "Après-midi");

    $liste_divs[] = create_li_activities_planning($index + 1, $contenu);
}


$div_li_activities_planning = new Div(
    'div_li_activities_planning_ID',
    'div_li_activities_planning_CLS',
    array_merge([
        new Glob_Fields("li_activities_planning_title_ID", "li_activities_planning_title_CLS", "h1", "Planning des Activités"),
    ], $liste_divs)
);

$div_planning_activities = $div_li_activities_planning->gen_div();
?>

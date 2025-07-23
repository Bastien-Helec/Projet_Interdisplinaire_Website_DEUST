<?php

require_once "./lib/Model/PHP/PAGES/Div.php";
require_once "./lib/Model/PHP/PAGES/Fields.php";
require_once "./lib/Model/PHP/BDD/SQL/FONCTIONS_METIERS/Select.php";

function create_li_conferences_planning($number, $contenu) {
    $li_conference = new Glob_Fields("li_conference_planning_{$number}_title", "div_conference_CLS", 'h4', "Conférence {$number} ");
    $li_conference_body = new Glob_Fields("li_conference_planning_{$number}_body", "div_planning_conference_CLS", 'p', "{$contenu}");

    $div_li_conference = new Div("li_conference_planning_{$number}_ID", "div_planning_conference_CLS", [
        $li_conference,
        $li_conference_body,
    ]);

    return $div_li_conference;
}

// Liste les sessions + leur planning (et leur salle)
$select_sql = new Select_SQL($pdo_cnx);
$sessions = $select_sql->sessionsAvecPlanning();

$liste_divs = [];

foreach ($sessions as $index => $session) {
    $contenu = "{$session["theme"]}</br>  Tarif : {$session["tarif"]} € </br>  Places : {$session["nbPlace"]}" ."</br> Date : {$session["date"]} " .
    ($session["estMatin"] ? " </br>Matin" : "Après-midi") . " </br>  Salle : {$session["Salle"]}";

    $liste_divs[] = create_li_conferences_planning($index + 1, $contenu);
}

$div_li_conferences_planning = new Div(
    'div_planning_conferences_ID',
    'div_planning_conferences_CLS',
    array_merge([
        new Glob_Fields("li_conferences_planning_title_ID", "li_conferences_planning_title_CLS", "h1", "Planning des Conférences"),
    ], $liste_divs)
);

$div_planning_conferences = $div_li_conferences_planning->gen_div();
?>

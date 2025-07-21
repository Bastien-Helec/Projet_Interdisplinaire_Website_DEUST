<?php

require_once "./lib/Model/PHP/PAGES/Div.php";
require_once "./lib/Model/PHP/PAGES/Fields.php";
require_once "./lib/Model/PHP/BDD/SQL/FONCTIONS METIERS/Select.php";

function create_li_conferences_planning($number, $contenu) {
    $li_conference = new Glob_Fields("li_conference_planning_{$number}_title", "div_li_conference_CLS", 'h4', "Conférence {$number}");
    $li_conference_body = new Glob_Fields("li_conference_planning_{$number}_body", "div_li_conference_CLS", 'p', "{$contenu}");

    $div_li_conference = new Div("li_conference_planning_{$number}_ID", "div_li_conference_CLS", [
        $li_conference,
        $li_conference_body,
    ]);

    return $div_li_conference;
}

// Liste les sessions + leur planning (et leur salle)
$sessions = Select_SQL::sessionsAvecPlanning();

$liste_divs = [];

foreach ($sessions as $index => $session) {
    $contenu = "{$session["theme"]} | Tarif : {$session["tarif"]} € | Places : {$session["nbPlace"]} | " .
               "Date : {$session["date"]} | " .
               ($session["estMatin"] ? "Matin" : "Après-midi") . " | Salle : {$session["nomSalle"]}";

    $liste_divs[] = create_li_conferences_planning($index + 1, $contenu);
}

$div_li_conferences_planning = new Div(
    'div_li_conferences_planning_ID',
    'div_li_conferences_planning_CLS',
    array_merge([
        new Glob_Fields("li_conferences_planning_title_ID", "li_conferences_planning_title_CLS", "h1", "Planning des Conférences")
    ], $liste_divs)
);

$div_li_conferences_planning = $div_li_conferences_planning->gen_div();
?>
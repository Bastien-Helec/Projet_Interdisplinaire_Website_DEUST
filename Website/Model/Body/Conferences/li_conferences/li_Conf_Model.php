<?php

require_once "./lib/Model/PHP/PAGES/Div.php";
require_once "./lib/Model/PHP/PAGES/Fields.php";
require_once "./lib/Model/PHP/BDD/SQL/FONCTIONS METIERS/Select.php";

function create_li_conferences($number, $contenu) {
    $li_conference = new Glob_Fields("li_conference_{$number}_title", "div_li_conference_CLS", 'h4', "Conférence {$number}");
    $li_conference_body = new Glob_Fields("li_conference_{$number}_body", "div_li_conference_CLS", 'p', "{$contenu}");

    $div_li_conference = new Div("li_conference_{$number}_ID", "div_li_conference_CLS", [
        $li_conference,
        $li_conference_body,
    ]);

    return $div_li_conference;
}

// Liste toutes les sessions
$sessions = Select_SQL::toutesLesSessions();

$liste_divs = [];

foreach ($sessions as $index => $session) {
    $contenu = "{$session["theme"]} | Tarif : {$session["tarif"]} € | Places : {$session["nbPlace"]}";
    $liste_divs[] = create_li_conferences($index + 1, $contenu);
}

$div_li_conferences = new Div(
    'div_li_conferences_ID',
    'div_li_conferences_CLS',
    array_merge([
        new Glob_Fields("li_conferences_title_ID", "li_conferences_title_CLS", "h1", "Liste des Conférences")
    ], $liste_divs)
);

$div_li_conferences = $div_li_conferences->gen_div();
?>

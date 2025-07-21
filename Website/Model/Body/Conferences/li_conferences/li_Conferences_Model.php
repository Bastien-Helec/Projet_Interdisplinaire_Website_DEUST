<?php

require_once "./lib/Model/PHP/PAGES/Div.php";
require_once "./lib/Model/PHP/PAGES/Fields.php";

function create_li_conferences($number,string $contenu){
    $li_conferences = new Glob_Fields("li_conference_{$number}_title", "div_li_conference_CLS", 'h4', "Conférence {$number}");
    $li_conferences_body = new Glob_Fields("li_conference_{$number}_body", "div_li_conference_CLS", 'p',  "{$contenu}");

    $div_li_conferences_number = new Div("li_conference_{$number}_ID", "div_li_conference_CLS",[
        $li_conferences,
        $li_conferences_body,
    ]);

    return $div_li_conferences_number; 
}


$div_li_conferences = new Div('div_li_conferences_ID', 'div_li_conferences_CLS',[
    new Glob_Fields("li_conferences_title_ID", "li_conferences_title_CLS", 'h1', "Liste des Conférences"),
    create_li_conferences(1,"liste de la conférence"),
    create_li_conferences(2,"liste de la conférence"),
    create_li_conferences(3,"liste de la conférence"),
    create_li_conferences(4,"liste de la conférence"),
]);

$div_li_conferences= $div_li_conferences->gen_div();

?>  
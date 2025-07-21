<?php

require_once "./lib/Model/PHP/PAGES/Div.php";
require_once "./lib/Model/PHP/PAGES/Fields.php";

function create_planning_conferences($number,string $contenu){
    $planning_conferences = new Glob_Fields("conference_{$number}_title", "div_planning_conference_CLS", 'h4', "planning Conférences {$number}");
    $planning_conferences_body = new Glob_Fields("conference_{$number}_body", "div_planning_conference_CLS", 'p',  "{$contenu}");

    $div_planning_conferences_number = new Div("conference_{$number}_ID", "div_planning_conference_CLS",[
        $planning_conferences,
        $planning_conferences_body,
    ]);

    return $div_planning_conferences_number; 
}


$div_planning_conferences = new Div('div_planning_conferences_ID', 'div_planning_conferences_CLS',[
    create_planning_conferences(1,"Lundi"),
    create_planning_conferences(2,"Mardi"),
    create_planning_conferences(3,"Mercredi"),
    create_planning_conferences(4,"Jeudi"),
    create_planning_conferences(4,"Vendredi"),
]);

$div_planning_conferences= $div_planning_conferences->gen_div();

?>  
<?php

require_once "./lib/Model/PHP/PAGES/Div.php";
require_once "./lib/Model/PHP/PAGES/Fields.php";

function create_planning($number,string $contenu){
    $planning = new Glob_Fields("_{$number}_title", "div_planning_CLS", 'h4', "Planning  {$number}");
    $planning_body = new Glob_Fields("planning_{$number}_body", "div_planning_CLS", 'p',  "{$contenu}");

    $div_planning_number = new Div("planning_{$number}_ID", "div_planning_CLS",[
        $planning,
        $planning_body,
    ]);

    return $div_planning_number; 
}


$div_planning = new Div('div_plannings_ID', 'div_planning_CLS',[
    create_planning(1,"Lundi"),
    create_planning(2,"Mardi"),
    create_planning(3,"Mercredi"),
    create_planning(4,"Jeudi"),
    create_planning(5,"Vendredi"),
]);

$div_planning= $div_planning->gen_div();

?>  
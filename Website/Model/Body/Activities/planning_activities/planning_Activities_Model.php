<?php

require_once "./lib/Model/PHP/PAGES/Div.php";
require_once "./lib/Model/PHP/PAGES/Fields.php";

function create_planning_activities($number,string $contenu){
    $planning_activities = new Glob_Fields("activitie_{$number}_title", "div_planning_activitie_CLS", 'h4', "planning activité {$number}");
    $planning_activities_body = new Glob_Fields("activitie_{$number}_body", "div_planning_activitie_CLS", 'p',  "{$contenu}");

    $div_planning_activities_number = new Div("activitie_{$number}_ID", "div_planning_activitie_CLS",[
        $planning_activities,
        $planning_activities_body,
    ]);

    return $div_planning_activities_number; 
}


$div_planning_activities = new Div('div_planning_activities_ID', 'div_planning_activities_CLS',[
    create_planning_activities(1,"Lundi"),
    create_planning_activities(2,"Mardi"),
    create_planning_activities(3,"Mercredi"),
    create_planning_activities(4,"Jeudi"),
    create_planning_activities(4,"Vendredi"),
]);

$div_planning_activities= $div_planning_activities->gen_div();

?>  
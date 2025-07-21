<?php

require_once "./lib/Model/PHP/PAGES/Div.php";
require_once "./lib/Model/PHP/PAGES/Fields.php";

function create_li_activities($number,string $contenu){
    $li_activities = new Glob_Fields("li_activitie_{$number}_title", "div_li_activitie_CLS", 'h4', "li_activité {$number}");
    $li_activities_body = new Glob_Fields("li_activitie_{$number}_body", "div_li_activitie_CLS", 'p',  "{$contenu}");

    $div_li_activities_number = new Div("li_activitie_{$number}_ID", "div_li_activitie_CLS",[
        $li_activities,
        $li_activities_body,
    ]);

    return $div_li_activities_number; 
}


$div_li_activities = new Div('div_li_activities_ID', 'div_li_activities_CLS',[
    new Glob_Fields("li_activities_title_ID", "li_activities_title_CLS", 'h1', "Liste des Activités"),
    create_li_activities(1,"liste de l'activité"),
    create_li_activities(2,"liste de l'activité"),
    create_li_activities(3,"liste de l'activité"),
    create_li_activities(4,"liste de l'activité"),
]);

$div_li_activities= $div_li_activities->gen_div();

?>  
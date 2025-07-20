<?php

require_once "./lib/Model/PHP/PAGES/Div.php";
require_once "./lib/Model/PHP/PAGES/Fields.php";

function create_actus($number,string $contenu){
    $actus = new Glob_Fields("actus_{$number}_title", "div_actus_{$number}_CLS", 'h4', "Actus {$number}");
    $actus_body = new Glob_Fields("actus_{$number}_body", "div_actus_{$number}_CLS", 'p',  "{$contenu}");

    $div_actus_number = new Div("div_actus_{$number}_ID", "div_actus_{$number}_CLS",[
        $actus,
        $actus_body,
    ]);

    return $div_actus_number; 
}

$div_actus = new Div('div_actus_ID', 'div_actus_CLS',[
    create_actus(1,"Contenu de la actus"),
    create_actus(2,"Contenu de la actus"),
    create_actus(3,"Contenu de la actus"),
    create_actus(4,"Contenu de la actus"),
]);

$div_actus= $div_actus->gen_div();

?>
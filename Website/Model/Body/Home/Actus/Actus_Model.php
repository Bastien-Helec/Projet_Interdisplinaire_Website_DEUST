<?php

require_once "./lib/Model/PHP/PAGES/Div.php";
require_once "./lib/Model/PHP/PAGES/Fields.php";

function create_actus($number,string $contenu){
    $actus = new Glob_Fields("actu_{$number}_title", "div_actu_CLS", 'h4', "Actus {$number}");
    $actus_body = new Glob_Fields("actu_{$number}_body", "div_actu_CLS", 'p',  "{$contenu}");

    $div_actus_number = new Div("actu_{$number}_ID", "div_actu_CLS",[
        $actus,
        $actus_body,
    ]);

    return $div_actus_number; 
}




$div_actus = new Div('div_actus_ID', 'div_actus_CLS',[
    create_actus(1,"Lorem ipsum dolor sit amet consectetur adipisicing elit. Esse velit laudantium mollitia labore? Blanditiis rem aperiam eius laborum quia alias, veritatis, voluptas accusamus, molestiae maxime ipsa labore pariatur libero quos."),
    create_actus(2,"Lorem ipsum dolor sit amet consectetur adipisicing elit. Esse velit laudantium mollitia labore? Blanditiis rem aperiam eius laborum quia alias, veritatis, voluptas accusamus, molestiae maxime ipsa labore pariatur libero quos."),
    create_actus(3,"Lorem ipsum dolor sit amet consectetur adipisicing elit. Esse velit laudantium mollitia labore? Blanditiis rem aperiam eius laborum quia alias, veritatis, voluptas accusamus, molestiae maxime ipsa labore pariatur libero quos."),
    create_actus(4,"Lorem ipsum dolor sit amet consectetur adipisicing elit. Esse velit laudantium mollitia labore? Blanditiis rem aperiam eius laborum quia alias, veritatis, voluptas accusamus, molestiae maxime ipsa labore pariatur libero quos."),
]);

$div_actus= $div_actus->gen_div();

?>  
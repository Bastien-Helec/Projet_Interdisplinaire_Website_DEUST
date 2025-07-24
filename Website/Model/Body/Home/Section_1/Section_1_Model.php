<?php
require_once "./lib/Model/PHP/PAGES/Div.php";
require_once "./lib/Model/PHP/PAGES/Fields.php";
require_once "./lib/Model/PHP/PAGES/Logo.php";

$div_bg_blur = new Div('bg_blur', 'bg_blur_CLS', [
    new Glob_Fields('', '', '', ''),
]);


$div_section_title_1 = new Div('div_Section_1_title_ID', 'div_Section_1_title_CLS',[
    new Glob_Fields('section_title', 'div_Section_1_title_CLS', 'h2', 'Bienvenue aux conférences sport et santé'),
    // new Logo('./Model/Body/Home/Section_1/Images/palais_congres.png','home_body_logo',''),
]);

$div_section_1 = new Div('div_Section_1', 'div_Section_1_CLS',[
    $div_bg_blur,
    $div_section_title_1
]);

$div_section_1= $div_section_1->gen_div();

?>
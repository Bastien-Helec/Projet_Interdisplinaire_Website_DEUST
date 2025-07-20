<?php

require_once "./lib/Model/PHP/PAGES/Div.php";
require_once "./lib/Model/PHP/PAGES/Fields.php";

$div_section_1 = new Div('div_Section_1_ID', 'div_Section_1_CLS',[
    new Glob_Fields('section_title', 'div_Section_1_CLS', 'h2', 'Bienvenu au confèrences sport et santé'),
]);

$div_section_1= $div_section_1->gen_div();

?>
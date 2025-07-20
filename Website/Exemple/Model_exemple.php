<?php


require_once "./lib/Model/PHP/PAGES/Bouton.php";
require_once "./lib/Model/PHP/PAGES/Fields.php";
require_once "./lib/Model/PHP/PAGES/Div.php";

$bouton = new Bouton('btn1', 'Cliquez-moi', 'btn-class', [], []);
$field = new Glob_Fields('champ1', 'champ-class', 'input', '', 'text', 'champ1');

$div = new Div('div1', 'container', [$bouton, $field]);
$dataDiv = $div->gen_div(); 


?>
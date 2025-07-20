<?php

require_once "./lib/Model/PHP/PAGES/Div.php";
require_once "./lib/Model/PHP/PAGES/Fields.php";

$li_home = new Glob_Fields('home_li', 'li', 'li', '<a href="index.php">Acceuil </a>');

$li_activities = new Glob_Fields('li_activities', 'li', 'li', '<a href="#"> Activités </a>');

$li_Plng = new Glob_Fields('li_plng', 'li', 'li', '<a href="#"> Planning </a>');

$li_conf = new Glob_Fields('li_conf', 'li', 'li', '<a href="#"> Conférences </a>');

$li_hist = new Glob_Fields('li_hist', 'li', 'li', '<a href="#"> Histoire </a>');


$navbar = new Glob_Fields('navbar_ID', 'navbar_CLS', 'nav', [
    $li_home,
    $li_activities,
    $li_Plng,
    $li_conf,
    $li_hist
]);

$div_navbar = new Div('div_nav_ID', 'div_nav_CLS', [
    $navbar,
]);

$div_navbar= $div_navbar->gen_div();

?>
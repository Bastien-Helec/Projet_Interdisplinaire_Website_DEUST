<?php

require_once "./lib/Model/PHP/PAGES/Div.php";
require_once "./lib/Model/PHP/PAGES/Fields.php";

$li_home = new Glob_Fields('home_li', 'li', 'li', '<a href="index.php">Accueil </a>');
$li_activities = new Glob_Fields('li_activities', 'li', 'li', '<a href="?page=activities"> Activités </a>');
$li_conf = new Glob_Fields('li_conf', 'li', 'li', '<a href="?page=conferences"> Conférences </a>');
$li_Plng = new Glob_Fields('li_plng', 'li', 'li', '<a href="?page=planning"> Planning </a>');



$navbar = new Glob_Fields('navbar_ID', 'navbar_CLS', 'nav', [
    $li_home,
    $li_activities,
    $li_conf,
    $li_Plng,
]);

$div_navbar = new Div('div_nav_ID', 'div_nav_CLS', [
    $navbar,
]);

$div_navbar= $div_navbar->gen_div();

?>
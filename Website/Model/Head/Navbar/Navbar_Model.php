<?php

require_once "./lib/Model/PHP/PAGES/Div.php";
require_once "./lib/Model/PHP/PAGES/Fields.php";

$li_home = new Glob_Fields('home_li', 'li', 'li', '<a href="index.php">Accueil </a>');

if($_SESSION){
if ($_SESSION['login_status'] === 'Success') {
    $boutons_add_conf = new Bouton("btn_conferences_inscription_ID", "S'inscrire à une conférence", '',);
    $boutons_del_conf = new Bouton("btn_conferences_desincription_ID", "Se désinscrire d'une conférence", '',);
    $boutons_add_act = new Bouton("btn_activite_inscription_ID", "S'inscrire à une activité", '',);
    $boutons_del_act = new Bouton("btn_activite_desincription_ID", "Se désinscrire d'une activité", '',);
}}
else {
    $boutons_add_conf = null;
    $boutons_del_conf = null;
    $boutons_add_act = null;
    $boutons_del_act = null;
}

$li_activities = new Glob_Fields('li_activities', 'li', 'li', '<a href="?page=activities"> Activités </a>');
$li_conf = new Glob_Fields('li_conf', 'li', 'li', '<a href="?page=conferences"> Conférences </a>');
$li_Plng = new Glob_Fields('li_plng', 'li', 'li', '<a href="?page=planning"> Planning </a>');

$ul_activities = new Div('ul_activities_ID', 'ul_activities_CLS', [
    new Glob_Fields('li_activities', 'li', 'li', '<a href="?page=activities"> Activités </a>'),
    $boutons_add_act,
    $boutons_del_act,
]);

$ul_conf = new Div('ul_conf_ID', 'ul_conf_CLS', [
    new Glob_Fields('li_conf', 'li', 'li', '<a href="?page=conferences"> Conférences </a>'),
    $boutons_add_conf,
    $boutons_del_conf,
]);

$navbar = new Glob_Fields('navbar_ID', 'navbar_CLS', 'nav', [
    $li_home,
    $ul_activities,
    $ul_conf,
    // $li_Plng,
]);

$div_navbar = new Div('div_nav_ID', 'div_nav_CLS', [
    $navbar,
]);

$div_navbar= $div_navbar->gen_div();

?>
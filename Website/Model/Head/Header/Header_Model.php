<?php

require_once "./lib/Model/PHP/PAGES/Div.php";
require_once "./lib/Model/PHP/PAGES/Fields.php";
require_once "./lib/Model/PHP/PAGES/Bouton.php";

$usr_auth = new Div('usr_auth', 'usr_auth', [
    new Bouton('btn_usr_signup', 'Inscription',''),
    new Bouton('btn_usr_login', 'Connexion',''),
]);

$title = new Glob_Fields('Cn_title_ID','Cn_title_CLS', 'h1', 'Congrès National');

$div_header = new Div('header_ID', 'header_CLS', [
    $title,
    $usr_auth,
]);

$div_header = $div_header->gen_div();
?>
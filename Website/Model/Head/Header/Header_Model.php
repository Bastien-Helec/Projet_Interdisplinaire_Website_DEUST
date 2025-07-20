<?php

require_once "./lib/Model/PHP/PAGES/Div.php";
require_once "./lib/Model/PHP/PAGES/Fields.php";
require_once "./lib/Model/PHP/PAGES/Bouton.php";

$usr_auth = new Div('usr_auth', 'usr_auth', [
    new Bouton('btn_usr_signup', 'Sign Up', 'btn_Primary'),
    new Bouton('btn_usr_login', 'Login', 'btn_Secondary'),
]);

$title = new Glob_Fields('Cn_title','Cn_title', 'h1', 'Congrès National');

$div_header = new Div('header_ID', 'header_CLS', [
    $title,
    $usr_auth,
]);

$div_header = $div_header->gen_div();
?>
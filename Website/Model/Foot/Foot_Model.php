<?php

require_once "./lib/Model/PHP/PAGES/Div.php";
require_once "./lib/Model/PHP/PAGES/Fields.php";

$article_1 = new Glob_Fields('ctc_ID', 'ctc_CLS', 'p','Contact');

$div_article_1 = new Div('ctcDiv_ID', 'ctcDiv_CLS' , [
    $article_1,
]);


$article_2_2 = new Glob_Fields('infoAdmin_ID', 'infoFoot_CLS', 'p', '<a href="?page=admin"> Admin</a>');

$div_article_2 = new Div('infoFoot_ID', 'infoFoot_CLS', [
    $article_2_2,
]);

$div_article_3 = new Div('legal_ID', 'legal_CLS', [
    new Glob_Fields('mlegal',  'legal_CLS' , 'p', '<a href="?mention_legales"> Mentions légales </a>'),
    new Glob_Fields('polconf',  'legal_CLS' , 'p', '<a href="?politiques_confidentialites"> Politiques de confidentialités </a>'),
    new Glob_Fields('Copyright',  'legal_CLS' , 'p',  '©Copyright 2025'),    
]);

$div_foot = new Div('foot_ID', 'foot_CLS', [
    $div_article_1,
    $div_article_2,
    $div_article_3
]);

$div_foot = $div_foot->gen_div();

?>
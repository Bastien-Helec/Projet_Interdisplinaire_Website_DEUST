<?php

require_once "./../../../lib/Model/CSS/PAGES/Args_CSS.php";

$div = (new Args_CSS('#div_plannings_ID'))
->set('background-color', '#FAFAFA')
->set('display', 'flex')
->set('padding','5px')
->set('gap', '40px')
->set('font-size','1.5em')
;

$actus_CLS = (new Args_CSS('.div_planning_CLS'))
->set('width', '100%')
->set('text-align', 'center')
->set('background-color', '#D9D9D9')
;


$planning_conferences_CSS = [
    $div,
    $actus_CLS,
];

foreach($planning_conferences_CSS as $css){
    echo $css->gen_css();
}

?>
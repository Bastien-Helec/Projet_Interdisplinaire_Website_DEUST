<?php

require_once "./../../../../lib/Model/CSS/PAGES/Args_CSS.php";

$div = (new Args_CSS('#div_li_activities_ID'))
->set('background-color', '#FAFAFA')
->set('display', 'flex')
->set('flex-wrap', 'wrap')
->set('flex-direction', 'column')
->set('padding','5px')
->set('gap', '40px')
->set('font-size','1.5em')
;

$li_activities_CLS = (new Args_CSS('.div_li_activities_CLS'))
->set('width', '100%')
->set('height', 'auto')
->set('text-align', 'center')
->set('background-color', '#D9D9D9');

$li_activities_CSS = [
    $div,
    $li_activities_CLS,
];

foreach($li_activities_CSS as $css){
    echo $css->gen_css();
}

?>
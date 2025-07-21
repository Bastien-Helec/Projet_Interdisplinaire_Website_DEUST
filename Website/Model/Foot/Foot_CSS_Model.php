<?php

require_once "./../../lib/Model/CSS/PAGES/Args_CSS.php";

$a_default = (new Args_CSS('a'))
->set('text-decoration', 'none')
->set('color', 'inherit');

$a_hover = (new Args_CSS('a:hover'))
->set('border-top', 'solid 2px')
->set('transition', 'background 0.3s');

$div_foot = (new Args_CSS('#foot_ID'))
->set('display','flex')
->set('justify-content','space-around')
->set('background-color', '#F3722C')
->set('color', '#FFFFFF')
->set('font-size', '1.3rem');

$foot_CSS = [
    $a_default,
    $a_hover,
    $div_foot
];

foreach($foot_CSS as $css){
    echo $css->gen_css();
}

?>
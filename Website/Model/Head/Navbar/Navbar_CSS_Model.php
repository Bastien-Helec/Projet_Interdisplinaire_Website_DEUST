<?php

require_once "./../../../lib/Model/CSS/PAGES/Args_CSS.php";

$li_default = (new Args_CSS('li'))
->set('list-style', 'none')
->set('margin', '0px')
->set('padding', '0px')
;
$a_default = (new Args_CSS('a'))
->set('text-decoration', 'none')
->set('color', 'inherit')
->set('transition', 'background 0.3s');


$a_hover = (new Args_CSS('a:hover'))
->set('border-top', 'solid 2px')
->set('transition', 'background 0.3s');


$navbar= (new Args_CSS('#navbar_ID'))
->set('display', 'flex')
->set('align-content', 'center')
->set('justify-content', 'space-around')
->set('font-size','1.75rem')
;

$div_navbar = (new Args_CSS('#div_nav_ID'))
->set('background-color','#a5cfe5')
->set('color', '#FFFFFF');

$navbar_CSS = [
    $li_default,
    $a_default,
    $a_hover,
    $navbar,
    $div_navbar
];

foreach($navbar_CSS as $css){
    echo $css->gen_css();
}

?>
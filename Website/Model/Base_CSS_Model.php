<?php

require_once "./../lib/Model/CSS/PAGES/Args_CSS.php";

$body = (new Args_CSS('body'))
->set('margin', '0px')
->set('padding','0px')
->set('overflow-x', 'hidden')
->set('font-family', "'Nunito',sans-serif");


$base_CSS = [
    $body
];

foreach($base_CSS as $css){
    echo $css->gen_css();
}


?>
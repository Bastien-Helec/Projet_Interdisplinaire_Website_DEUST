<?php

require_once "./../../../lib/Model/CSS/PAGES/Args_CSS.php";

$div_admin_body =(new Args_CSS('#admin_body_ID'))
->set('display', 'flex')
->set('justify-content', 'space-around');

$body_css = [
    $div_admin_body,
];

foreach($body_css as $css){
    echo $css->gen_css();
}

?>
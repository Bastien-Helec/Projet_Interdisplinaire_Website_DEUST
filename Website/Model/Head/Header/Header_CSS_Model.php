<?php

require_once "./../../../lib/Model/CSS/PAGES/Args_CSS.php";

$default_btn = (new Args_CSS('button'))
->set('border', 'none')
->set('background-color','none')
->set('color','inherit')
->set('cursor','pointer');

$btn_usr_signup = (new Args_CSS('#btn_usr_signup'))
->set('border-radius', '6px')
->set('background-color', '#F3722C')
->set('color', '#FFFFFF')
->set('transition', 'background 0.3s')
->set('font-family', "'Nunito',sans-serif")
->set('font-size','1.5rem');

$btn_usr_login = (new Args_CSS('#btn_usr_login , #btn_usr_logout'))
->set('border-radius', '6px')
->set('background-color', 'transparent')
->set('color', '#FFFFFF')
->set('transition', 'background 0.3s')
->set('font-family', "'Nunito',sans-serif")
->set('font-size','1.5rem');

$btn_Primary_hover = (new Args_CSS('#btn_usr_signup:hover'))
->set('background-color', 'transparent')
->set('color', '#F3722C')
->set('transition', 'background 0.3s');

$btn_Secondary_hover = (new Args_CSS('#btn_usr_login:hover , #btn_usr_logout:hover'))
->set('background-color', '#FFFFFF')
->set('color', '#a5cfe5')
->set('transition', 'background 0.3s');


$header_title = (new Args_CSS('#Cn_title_ID'))
->set('color', 'white')
->set('text-align', 'center')
->set('font-size', '2.5rem');

$div_header = (new Args_CSS('#header_ID'))
->set('text-align','right')
->set('background-color', '#a5cfe5');

$div_usr_auth=(new Args_CSS('#usr_auth'))
->set('position', 'relative')
->set('top', '-50px');

// $banner = (new Args_CSS('#banner'))
// ->set('display', 'none');

$Header_CSS = [
    $default_btn,
    $btn_usr_signup,
    $btn_usr_login,
    $btn_Primary_hover,
    $btn_Secondary_hover,
    $header_title,
    $div_header,
    $div_usr_auth,
    $banner
];

foreach($Header_CSS as $css){
    echo $css->gen_css();
}

?>
<?php

require_once "./../lib/Model/CSS/PAGES/Args_CSS.php";

$body = (new Args_CSS('body'))
->set('margin', '0px')
->set('padding','0px')
->set('overflow-x', 'hidden')
->set('font-family', "'Nunito',sans-serif");

$banner = (new Args_CSS('#banner'))
    ->set('font-size', '1.2rem')
    ->set('position', 'fixed')
    ->set('bottom', '20px')
    ->set('right','0')
    ->set('max-width', '350px')
    ->set('background-color', '#5A7FA6')
    ->set('color', '#f8f9fa')
    ->set('text-align', 'center')
    ->set('padding', '10px 20px')
    ->set('box-shadow', '0 5px 15px rgba(0, 0, 0, 0.2)')
    ->set('transition', 'transform 0.5s ease')
    ->set('transform', 'translateX(110%)');

$banner_actif = (new Args_CSS('#banner.actif'))
    ->set('display', 'block')
    ->set('z-index', '1000')
    ->set('transform', 'translateX(0)');

$base_CSS = [
    $body,
    $banner_actif,
    $banner,
];

foreach($base_CSS as $css){
    echo $css->gen_css();
}


?>
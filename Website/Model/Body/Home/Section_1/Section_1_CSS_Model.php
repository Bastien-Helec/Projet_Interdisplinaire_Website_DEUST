<?php
// ./../../../../Model/Body/Home/Section_1/Images/palais_congres.png

require_once "./../../../../lib/Model/CSS/PAGES/Args_CSS.php";

$div = (new Args_CSS('.div_Section_1_CLS'))
    ->set('position', 'relative')
    ->set('width', '100%')
    ->set('height', '85%')
    ->set('overflow-x', 'hidden');

$bg = (new Args_CSS('.bg_blur_CLS'))
    ->set('position', 'absolute')
    ->set('top', '0')
    ->set('left', '0')
    ->set('width', '100%')
    ->set('height', '100%')
    ->set('background-image', "url('./../../../../Model/Body/Home/Section_1/Images/palais_congres.png')")
    ->set('background-size', 'cover')
    ->set('background-position', 'center')
    ->set('filter', 'blur(5px)')
    ->set('z-index', '1');

$content = (new Args_CSS('.div_Section_1_title_CLS'))
    ->set('position', 'relative')
    ->set('z-index', '2')
    ->set('height', '100%')
    ->set('display', 'flex')
    ->set('justify-content', 'center')
    ->set('align-items', 'center')
    ->set('text-align', 'center');

$title = (new Args_CSS('#section_title'))
    ->set('color', 'white')
    ->set('font-size', '3.5rem')
    ->set('border-radius', '10px');

$section_1_CSS = [
    $div,
    $bg, 
    $content,
    $title
];

foreach($section_1_CSS as $css){
    echo $css->gen_css();
}

?>
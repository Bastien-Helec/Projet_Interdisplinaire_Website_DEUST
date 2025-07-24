<?php

require_once "./../../../../lib/Model/CSS/PAGES/Args_CSS.php";

$formulaire = (new Args_CSS('.Formulaire'))
    ->set('text-align', 'center')
    ->set('align-items', 'center')
    ->set('display','none')
    ->set('position','absolute')
    ->set('top', '30%')
    ->set('left', '50%')
    ->set('background-color', '#f8f9fa')
    ->set('padding', '20px')
    ->set('box-shadow','0 5px 15px rgba(0, 0, 0, 0.2)')
    ->set('border-radius', '8px')
    ->set('width', '300px')
    ->set('opacity', '0')
    ->set('visibility', 'hidden')
    ->set('z-index', '50')
    ->set('transform', 'translate(-50%, -50%)')
    ->set('transition', 'all 1s ease');

$form_actif = (new Args_CSS('.Formulaire.actif'))
    ->set('display','block')
    ->set('opacity', '1')
    ->set('top', '50%')
    ->set('position', 'fixed')
    ->set('visibility', 'visible');

$form_h2 = (new Args_CSS('.Formulaire h2'))
    ->set('margin-bottom', '0 0 15px');

$form_input = (new Args_CSS('.Formulaire input'))
    ->set('width', '95%')
    ->set('padding', '10px')
    ->set('margin-bottom', '10px')
    ->set('border', '1px solid #ddd')
    ->set('border-radius', '8px');


$bouton = (new Args_CSS('button'))
    ->set('all', 'unset')
    ->set('font-size', '16px')
    ->set('padding', '10px 20px')
    ->set('color', '#a5cfe5')
    ->set('border-radius', '5px')
    ->set('cursor', 'pointer')
    ->set('transition', 'all 0.3s ease');

$bouton_hover = (new Args_CSS('button:hover'))
    ->set('background-color', '#a5cfe5')
    ->set('color', '#FFFFFF');
    
    
$select = (new Args_CSS('.select'))
    ->set('position', 'relative')
    ->set('bottom', '10%')
    ->set('width', '100%')
    ->set('max-width', '300px');

$select_ul = (new Args_CSS('.select ul'))
    ->set('position', 'absolute')
    ->set('padding', '0px')
    ->set('left', '0%')
    ->set('top', '50%')
    ->set('width','100%')
    ->set('list-style-type', 'none')
    ->set('background-color', '#FFFFFF')
    ->set('border-radius', '4px')
    ->set('display', 'none')
    ->set('z-index', '1000')
    ->set('max-height', '150px')
    ->set('overflow-y', 'auto')
    ->set('box-shadow', '0 2px 10px rgba(0, 0, 0, 0.2)');

$select_ul_li = (new Args_CSS('.select ul li'))
    ->set('padding', '10px')
    ->set('cursor', 'pointer')
    ->set('color', '#a5cfe5')
    ->set('transition', 'background-color 0.3s ease');

$select_ul_li_hover = (new Args_CSS('.select ul li:hover'))
    ->set('background-color', '#a5cfe5')
    ->set('color', '#FFFFFF');

$select_actif_ul = (new Args_CSS('.select.actif ul'))
    ->set('display', 'block');




$formulaire_connexion_CSS =[
    $formulaire,
    $form_actif,
    $form_h2,
    $form_input,
    $bouton,
    $bouton_hover,
    $select,
    $select_ul,
    $select_ul_li,
    $select_ul_li_hover,
    $select_actif_ul,
];

foreach($formulaire_connexion_CSS as $css){
    echo $css->gen_css();
}

?>
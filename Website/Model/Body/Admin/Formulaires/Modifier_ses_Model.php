<?php
require_once './lib/Model/PHP/FORMULAIRES/FRONT/Form.php';

$form = new Form('Modifier_ses');
$form->addElement(new Fields("idSession", "number", "ID de la Session", 'requis'));
$form->addElement(new Fields('theme', 'text', 'Le thème de la session', ''));
$form->addElement(new Fields('tarif', 'number', 'Le tarif de la session en €', ''));
$form->addElement(new Fields('nbPlace', 'number', 'Le nombre de places', ''));

$formData = $form->getData();
$Modifier_sesData= $formData;

?>
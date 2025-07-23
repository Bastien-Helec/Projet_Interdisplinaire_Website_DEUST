<?php
require_once './lib/Model/PHP/FORMULAIRES/FRONT/Form.php';

$form = new Form('Modifier_ses');
$form->addElement(new Fields("idSession", "number", "ID de la Session", 'requis'));
$form->addElement(new Fields('theme', 'text', 'Le thème de la session', ''));
$form->addElement(new Fields('tarif', 'text', 'Le tarif de la session en €', ''));
$form->addElement(new Fields('nbPlace', 'text', 'Le nombre de place', ''));
$form->addElement(new Fields('salle_id', 'text', "L'ID de la salle", ''));
$form->addElement(new Fields('planning_id', 'text', "L'ID du planning", ''));


$formData = $form->getData();
$Modifier_sesData= $formData;

?>
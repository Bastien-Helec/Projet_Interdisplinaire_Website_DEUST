<?php
require_once './lib/Model/PHP/FORMULAIRES/FRONT/Form.php';

$form = new Form('Modifier_act');
$form->addElement(new Fields("idActivite", "number", "ID de la Session", 'requis'));
$form->addElement(new Fields('libelle', 'text', 'Libelle de l\'activité', ''));
$form->addElement(new Fields('tarif', 'text', 'Le tarif de la session en €', ''));
$form->addElement(new Fields('nbPlace', 'text', 'Le nombre de place', ''));


$formData = $form->getData();
$Modifier_actData= $formData;

?>
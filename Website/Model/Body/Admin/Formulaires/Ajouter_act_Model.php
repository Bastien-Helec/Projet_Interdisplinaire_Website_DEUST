<?php
require_once './lib/Model/PHP/FORMULAIRES/FRONT/Form.php';

$form = new Form('Ajouter_act');

$form->addElement(new Fields('libelle', 'text', 'Libellé de l\'activité', ''));
$form->addElement(new Fields('tarif', 'text', 'Le tarif de la session en €', ''));
$form->addElement(new Fields('nbPlace', 'text', 'Le nombre de places', ''));


$formData = $form->getData();
$Ajouter_actData= $formData;

?>
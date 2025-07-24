<?php
require_once './lib/Model/PHP/FORMULAIRES/FRONT/Form.php';

$form = new Form('Ajouter_ses');
$form->addElement(new Fields('theme', 'text', 'Le thème de la session', ''));
$form->addElement(new Fields('tarif', 'number', 'Le tarif de la session en €', ''));
$form->addElement(new Fields('nbPlace', 'number', 'Le nombre de places', ''));
$form->addElement(new ListeBDD('Choisissez votre salle', 'Salle', 'nom', 'SALLE', $pdo_cnx));
$form->addElement(new ListeBDD('Choisissez un planning', 'Planning', 'idPlanning', 'PLANNING', $pdo_cnx));

$formData = $form->getData();
$Ajouter_sesData= $formData;

?>
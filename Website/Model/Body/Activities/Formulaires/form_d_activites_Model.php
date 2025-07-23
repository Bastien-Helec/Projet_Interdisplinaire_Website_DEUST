<?php
require_once './lib/Model/PHP/FORMULAIRES/FRONT/Form.php';
require_once('./lib/Model/PHP/FORMULAIRES/FRONT/ListeBDD.php');

$form = new Form("desinscription_activite");

$form->addElement(new ListeBDD('Choisissez une activité a quitté', 'libelle', 'libelle', 'ACTIVITE', $pdo_cnx));

$formData = $form->getData();

$desinscription_actData = $formData;

?>

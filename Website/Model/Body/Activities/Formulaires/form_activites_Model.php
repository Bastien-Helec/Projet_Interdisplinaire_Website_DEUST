<?php
require_once './lib/Model/PHP/FORMULAIRES/FRONT/Form.php';
require_once('./lib/Model/PHP/FORMULAIRES/FRONT/ListeBDD.php');

$form = new Form('inscription_activite');

// Liste des activités
$form->addElement(new ListeBDD('Choisissez une activité', 'libelle', 'libelle', 'ACTIVITE', $pdo_cnx));

$formData = $form->getData();

$inscription_actData = $formData;

?>
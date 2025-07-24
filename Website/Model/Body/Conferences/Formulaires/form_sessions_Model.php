<?php
require_once './lib/Model/PHP/FORMULAIRES/FRONT/Form.php';
require_once('./lib/Model/PHP/FORMULAIRES/FRONT/ListeBDD.php');

$form = new Form('inscription_session');

// Liste des sessions
$form->addElement(new ListeBDD('Choisissez une session', 'theme', 'theme', 'SESSION', $pdo_cnx));

$formData = $form->getData();

$inscription_sesData = $formData;

?>
<?php
require_once './lib/Model/PHP/FORMULAIRES/FRONT/Form.php';
require_once('./lib/Model/PHP/FORMULAIRES/FRONT/ListeBDD.php');

$form = new Form("desinscription_session");

$form->addElement(new ListeBDD("Choisissez une session à quitter", 'theme', 'theme', 'SESSION', $pdo_cnx));

$formData = $form->getData();

$desinscription_sesData = $formData;

?>


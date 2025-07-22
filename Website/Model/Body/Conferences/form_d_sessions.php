<?php
require_once('./lib/Model/PHP/FORMULAIRES/Form.php');
require_once('./lib/Model/PHP/FORMULAIRES/Fields.php');
require_once('./lib/Model/PHP/FORMULAIRES/ListeBDD.php');
require_once('./Model/ConnexionBDD.php');

$form = new Form("form_desinscription_session");

$listeSessions = new ListeBDD("Choisissez une session à quitter", 'idSession', 'theme', 'SESSION', $pdo);
$form->addElement($listeSessions->createListe("form_desinscription_session"));

$formData = $form->getData();

require('./lib/View/PHP/FORMULAIRES/Form.view.php');
?>

<form method="POST" action="traitement_desinscription_session.php"></form>

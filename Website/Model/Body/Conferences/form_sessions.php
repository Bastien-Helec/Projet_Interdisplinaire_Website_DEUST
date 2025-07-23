<?php
require_once('./lib/Model/PHP/FORMULAIRES/Form.php');
require_once('./lib/Model/PHP/FORMULAIRES/Fields.php');
require_once('./lib/Model/PHP/FORMULAIRES/ListeBDD.php');
require_once('./Model/ConnexionBDD.php');

$form = new Form('form_inscription_activite');

$form->addElement(new Fields('nom', 'text', 'Nom', 'required'));
$form->addElement(new Fields('prenom', 'text', 'Prénom', 'required'));
$form->addElement(new Fields('email', 'email', 'Email', 'required'));

// Liste des sessions
$listeActivites = new ListeBDD('Choisissez une session', 'idSession', 'theme', 'SESSION', $pdo);
$form->addElement($listeActivites->createListe('form_inscription_session'));

$formData = $form->getData();

?>

<form method="POST" action="traitement_inscription_session.php">
    <?php require('./lib/View/PHP/FORMULAIRES/Form.view.php'); ?>
</form>>
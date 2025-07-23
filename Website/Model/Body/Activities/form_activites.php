<?php
require_once('./lib/Model/PHP/FORMULAIRES/Form.php');
require_once('./lib/Model/PHP/FORMULAIRES/Fields.php');
require_once('./lib/Model/PHP/FORMULAIRES/ListeBDD.php');
require_once('./Model/ConnexionBDD.php');

$form = new Form('form_inscription_activite');

$form->addElement(new Fields('nom', 'text', 'Nom', 'required'));
$form->addElement(new Fields('prenom', 'text', 'Prénom', 'required'));
$form->addElement(new Fields('email', 'email', 'Email', 'required'));

// Liste des activités
$listeActivites = new ListeBDD('Choisissez une activité', 'idActivite', 'libelle', 'ACTIVITE', $pdo);
$form->addElement($listeActivites->createListe('form_inscription_activite'));

$formData = $form->getData();

?>

<form method="POST" action="traitement_inscription_activite.php">
    <?php require('./lib/View/PHP/FORMULAIRES/Form.view.php'); ?>
</form>>
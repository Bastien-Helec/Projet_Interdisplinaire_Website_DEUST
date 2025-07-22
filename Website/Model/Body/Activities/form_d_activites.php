<?php
require_once('./lib/Model/PHP/FORMULAIRES/Form.php');
require_once('./lib/Model/PHP/FORMULAIRES/Fields.php');
require_once('./lib/Model/PHP/FORMULAIRES/ListeBDD.php');
require_once('./Model/ConnexionBDD.php');

$form = new Form("form_desinscription_activite");

$listeActivites = new ListeBDD("Choisissez une activité à quitter", 'idActivite', 'libelle', 'ACTIVITE', $pdo);
$form->addElement($listeActivites->createListe("form_desinscription_activite"));

$formData = $form->getData();

require('./lib/View/PHP/FORMULAIRES/Form.view.php');
?>

<form method="POST" action="traitement_desinscription_activite.php"></form>

<?php
require_once './lib/Model/PHP/FORMULAIRES/FRONT/Form.php';

$form = new Form('Ajouter_usr');
$form->addElement(new Fields("Nom", "text", "nom", 'requis'));
$form->addElement(new Fields("Prenom", "text", "Prénom", 'requis'));
$form->addElement(new Fields("Adresse", "text", "Adresse", 'requis'));
$form->addElement(new Fields("Cp", "text", "code postal", 'requis'));
$form->addElement(new Fields("Ville", "text", "ville", 'requis'));
$form->addElement(new Fields("Email", "Email", "Email", 'requis'));
$form->addElement(new Fields("Login", "text", "Login", 'requis'));
$form->addElement(new Fields("Mdp", "password", "Mot de Passe", 'requis'));
$form->addElement(new ListeBDD('Mon Club','club', 'nom',
'CLUB',$pdo_cnx));

$formData = $form->getData();
$Ajouter_usrData= $formData;

?>
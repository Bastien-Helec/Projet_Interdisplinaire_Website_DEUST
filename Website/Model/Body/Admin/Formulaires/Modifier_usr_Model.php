<?php

require_once './lib/Model/PHP/FORMULAIRES/FRONT/Form.php';

$form = new Form('Modifier_usr');
$form->addElement(new Fields("idUtilisateur", "number", "ID de l'utilisateur",''));
$form->addElement(new Fields("nom", "text", "nom",''));
$form->addElement(new Fields("prenom", "text", "Prénom",''));
$form->addElement(new Fields("adresse", "text", "Adresse",''));
$form->addElement(new Fields("cp", "text", "code postal",''));
$form->addElement(new Fields("ville", "text", "ville",''));
$form->addElement(new Fields("mail", "email", "Email",''));
$form->addElement(new Fields("login", "text", "Login",''));
$form->addElement(new Fields("mdp", "password", "Nouveau mot de passe",''));


$formData = $form->getData();
$Modifier_usrData = $formData;

?>
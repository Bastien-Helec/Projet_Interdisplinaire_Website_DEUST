<?php

require_once './lib/Model/PHP/FORMULAIRES/FRONT/Form.php';

$form = new Form('Connexion');
$form->addElement(new Fields("Login", "text", "Login", 'requis'));
$form->addElement(new Fields("Mdp", "password", "Mot de Passe", 'requis'));

$formData = $form->getData();

$ConnexionData = $formData;



?>
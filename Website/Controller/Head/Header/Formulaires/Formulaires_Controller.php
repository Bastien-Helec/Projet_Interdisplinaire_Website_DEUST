<?php

require_once "Connexion_Controller.php";
require_once "Inscription_Controller.php";

$formdata= [
    'Inscription' => $InscriptionData,
    'Connexion' => $ConnexionData,
];


foreach ($formdata as $formName => $formData) {
    require "./lib/View/Formulaires/Form.view.php";
}

?>
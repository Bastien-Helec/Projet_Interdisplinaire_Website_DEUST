<?php

require_once "form_sessions_Controller.php";
require_once "form_d_sessions_Controller.php";

$formdata= [
    'Inscrire_ses' => $inscription_sesData,
    'Desinscrire_ses' => $desinscription_sesData,
];

foreach ($formdata as $formName => $formData) {
    require "./lib/View/Formulaires/Form.view.php";
}

?>
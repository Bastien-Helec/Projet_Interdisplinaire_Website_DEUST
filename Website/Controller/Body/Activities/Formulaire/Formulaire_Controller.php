<?php

require_once "form_activites_Controller.php";
require_once "form_d_activites_Controller.php";

$formdata= [
    'Inscrire_act' => $inscription_actData,
    'Desinscrire_act' => $desinscription_actData,
];

foreach ($formdata as $formName => $formData) {
    require "./lib/View/Formulaires/Form.view.php";
}

?>
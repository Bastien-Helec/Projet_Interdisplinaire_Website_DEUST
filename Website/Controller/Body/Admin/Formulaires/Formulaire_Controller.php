<?php

require_once "Ajouter_act_Controller.php";
require_once "Modifier_act_Controller.php";
require_once "Ajouter_ses_Controller.php";
require_once "Modifier_ses_Controller.php";
require_once "Ajouter_usr_Controller.php";
require_once "Modifier_usr_Controller.php";

$formdata= [
    'Ajouter_act' => $Ajouter_actData,
    'Modifier_act' => $Modifier_actData,
    'Ajouter_ses' => $Ajouter_sesData,
    'Modifier_ses' => $Modifier_sesData,
    'Ajouter_usr' => $Ajouter_usrData,
    'Modifier_usr' => $Modifier_usrData,
];

foreach ($formdata as $formName => $formData) {
    require "./lib/View/Formulaires/Form.view.php";
}

?>
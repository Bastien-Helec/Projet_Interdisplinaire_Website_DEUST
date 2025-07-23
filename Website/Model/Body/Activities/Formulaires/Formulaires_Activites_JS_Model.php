<?php

require_once "./../../lib/Model/JS/FORMULAIRES/call.php";
require_once "./../../lib/Model/JS/remove_event.php";
require_once "./../../lib/Model/JS/FORMULAIRES/remove_banner.php";
require_once "./../../lib/Model/JS/FORMULAIRES/ListeBDD.php";
require_once "./../../lib/Model/JS/FORMULAIRES/Send.php";


// Section form_inscription_activite
$form_inscription_activite_Call_JS = new JS_CALL_FORM('inscription_activite_div','btn_activite_inscription_ID','banner');
echo $form_inscription_activite_Call_JS ->gen_print_FORM_js();

$form_inscription_activite_remove_js = new JS_Remove_Event('inscription_activite_div', 'btn_activite_inscription_ID');
echo $form_inscription_activite_remove_js->gen_remove_js();

$Liste_inscription_BDD_Activites = new JS_Sort_ListeBDD('inscription_activite_libelle');
echo $Liste_inscription_BDD_Activites->gen_list_js();


// Section Connexion
// Section form_desinscription_activite
$form_desinscription_activite_Call_JS = new JS_CALL_FORM('desinscription_activite_div','btn_activite_desincription_ID','banner');
echo $form_desinscription_activite_Call_JS ->gen_print_FORM_js();

$form_desinscription_activite_remove_js = new JS_Remove_Event('desinscription_activite_div', 'btn_activite_desincription_ID');
echo $form_desinscription_activite_remove_js->gen_remove_js();

$Liste_desinscription_BDD_Activites= new JS_Sort_ListeBDD('desinscription_activite_libelle');
echo $Liste_desinscription_BDD_Activites->gen_list_js();


// Envoi back end
$inscription_Send = new Send('inscription_activite_form', './Controller/Back_Controller.php');
echo $inscription_Send->Send();

$form_desinscription_activite_Send = new Send('desinscription_activite_form', './Controller/Back_Controller.php');
echo $form_desinscription_activite_Send->Send();

?>
<?php

require_once "./../../lib/Model/JS/FORMULAIRES/call.php";
require_once "./../../lib/Model/JS/remove_event.php";
require_once "./../../lib/Model/JS/FORMULAIRES/remove_banner.php";
require_once "./../../lib/Model/JS/FORMULAIRES/ListeBDD.php";
require_once "./../../lib/Model/JS/FORMULAIRES/Send.php";

// Section form_inscription_session
$form_inscription_session_Call_JS = new JS_CALL_FORM('inscription_session_div','btn_conferences_inscription_ID','banner');
echo $form_inscription_session_Call_JS ->gen_print_FORM_js();

$form_inscription_session_remove_js = new JS_Remove_Event('inscription_session_div', 'btn_conferences_inscription_ID');
echo $form_inscription_session_remove_js->gen_remove_js();

$Liste_inscription_BDD_session = new JS_Sort_ListeBDD('inscription_session_theme');
echo $Liste_inscription_BDD_session->gen_list_js();


// Section Connexion
// Section form_desinscription_session
$form_desinscription_session_Call_JS = new JS_CALL_FORM('desinscription_session_div','btn_conferences_desincription_ID','banner');
echo $form_desinscription_session_Call_JS ->gen_print_FORM_js();

$form_desinscription_session_remove_js = new JS_Remove_Event('desinscription_session_div', 'btn_conferences_desincription_ID');
echo $form_desinscription_session_remove_js->gen_remove_js();

$Liste_desinscription_BDD_session = new JS_Sort_ListeBDD('desinscription_session_theme');
echo $Liste_desinscription_BDD_session->gen_list_js();


// Envoi back end
$inscription_Send = new Send('inscription_session_form', './Controller/Back_Controller.php');
echo $inscription_Send ->Send();

$form_desinscription_session_Send = new Send('desinscription_session_form', './Controller/Back_Controller.php');
echo $form_desinscription_session_Send->Send();

?>
<?php

require_once "./../../../../lib/Model/JS/FORMULAIRES/call.php";
require_once "./../../../../lib/Model/JS/remove_event.php";
require_once "./../../../../lib/Model/JS/FORMULAIRES/remove_banner.php";
require_once "./../../../../lib/Model/JS/FORMULAIRES/ListeBDD.php";
require_once "./../../../../lib/Model/JS/FORMULAIRES/Send.php";

// Section Inscription
$Inscription_Call_JS = new JS_CALL_FORM('Inscription_div','btn_usr_signup','banner');
echo $Inscription_Call_JS ->gen_print_FORM_js();

$Inscription_remove_js = new JS_Remove_Event('Inscription_div', 'btn_usr_signup');
echo $Inscription_remove_js->gen_remove_js();

$Liste_BDD_Club = new JS_Sort_ListeBDD('Inscription_club');
echo $Liste_BDD_Club->gen_list_js();


// Section Connexion
$Connexion_Call_JS = new JS_CALL_FORM('Connexion_div', 'btn_usr_login','banner');
echo $Connexion_Call_JS->gen_print_FORM_js();;

$Connexion_remove_js = new JS_Remove_Event('Connexion_div', 'btn_usr_login');
echo $Connexion_remove_js->gen_remove_js();

$banner_remove = new JS_Remove_Banner('banner');
echo $banner_remove->Remove_Banner_js();


// Envoi back end
$Connexion_Send = new Send('Connexion_form', './Controller/Back_Controller.php');
echo $Connexion_Send->Send();

$Inscription_Send = new Send('Inscription_form', './Controller/Back_Controller.php');
echo $Inscription_Send->Send();

?>
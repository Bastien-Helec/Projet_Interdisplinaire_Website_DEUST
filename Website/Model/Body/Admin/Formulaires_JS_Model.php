<?php

require_once "./../../../lib/Model/JS/FORMULAIRES/call.php";
require_once "./../../../lib/Model/JS/remove_event.php";
require_once "./../../../lib/Model/JS/FORMULAIRES/remove_banner.php";
require_once "./../../../lib/Model/JS/FORMULAIRES/ListeBDD.php";
require_once "./../../../lib/Model/JS/FORMULAIRES/Send.php";

// Section ajout
$Ajouter_usr_Call_JS = new JS_CALL_FORM('Ajouter_usr_div', 'ajout_user_admin_ID','banner');
echo $Ajouter_usr_Call_JS->gen_print_FORM_js();

$Ajouter_usr_remove_JS = new JS_Remove_Event('Ajouter_usr_div', 'ajout_user_admin_ID');
echo $Ajouter_usr_remove_JS->gen_remove_js();

$Liste_BDD_Club = new JS_Sort_ListeBDD('Ajouter_usr_club');
echo $Liste_BDD_Club->gen_list_js();


$Ajouter_act_Call_JS = new JS_CALL_FORM('Ajouter_act_div', 'ajout_act_admin_ID','banner');
echo $Ajouter_act_Call_JS->gen_print_FORM_js();

$Ajouter_act_remove_JS = new JS_Remove_Event('Ajouter_act_div', 'ajout_act_admin_ID');
echo $Ajouter_act_remove_JS->gen_remove_js();

$Ajouter_ses_Call_JS = new JS_CALL_FORM('Ajouter_ses_div', 'ajout_ses_admin_ID','banner');
echo $Ajouter_ses_Call_JS->gen_print_FORM_js();

$Liste_BDD_Planning = new JS_Sort_ListeBDD('Ajouter_ses_Planning');
echo $Liste_BDD_Planning->gen_list_js();

$Liste_BDD_Salle = new JS_Sort_ListeBDD('Ajouter_ses_Salle');
echo $Liste_BDD_Salle->gen_list_js();

$Ajouter_ses_remove_JS = new JS_Remove_Event('Ajouter_ses_div', 'ajout_ses_admin_ID');
echo $Ajouter_ses_remove_JS->gen_remove_js();



// Section Modification
$Modifier_usr_Call_JS = new JS_CALL_FORM('Modifier_usr_div','Modifier_user_admin','banner');
echo $Modifier_usr_Call_JS ->gen_print_FORM_js();

$Modifier_usr_remove_js = new JS_Remove_Event('Modifier_usr_div', 'Modifier_user_admin');
echo $Modifier_usr_remove_js->gen_remove_js();



$Modifier_act_Call_JS = new JS_CALL_FORM('Modifier_act_div','Modifier_act_admin','banner');
echo $Modifier_act_Call_JS ->gen_print_FORM_js();

$Modifier_act_remove_js = new JS_Remove_Event('Modifier_act_div', 'Modifier_act_admin');
echo $Modifier_act_remove_js->gen_remove_js();

$Modifier_ses_Call_JS = new JS_CALL_FORM('Modifier_ses_div','Modifier_ses_admin','banner');
echo $Modifier_ses_Call_JS ->gen_print_FORM_js();

$Modifier_ses_remove_js = new JS_Remove_Event('Modifier_ses_div', 'Modifier_ses_admin');


$banner_remove = new JS_Remove_Banner('banner');
echo $banner_remove->Remove_Banner_js();


// Envoi back end

// Envoi Formulaires - AJOUT
$Ajouter_usr_Send = new Send('Ajouter_usr_form', './Controller/Back_Controller.php');
echo $Ajouter_usr_Send->Send();

$Ajouter_act_Send = new Send('Ajouter_act_form', './Controller/Back_Controller.php');
echo $Ajouter_act_Send->Send();

$Ajouter_ses_Send = new Send('Ajouter_ses_form', './Controller/Back_Controller.php');
echo $Ajouter_ses_Send->Send();


// Envoi Formulaires - MODIFICATION
$Modifier_usr_Send = new Send('Modifier_usr_form', './Controller/Back_Controller.php');
echo $Modifier_usr_Send->Send();

$Modifier_act_Send = new Send('Modifier_act_form', './Controller/Back_Controller.php');
echo $Modifier_act_Send->Send();

$Modifier_ses_Send = new Send('Modifier_ses_form', './Controller/Back_Controller.php');
echo $Modifier_ses_Send->Send();


?>
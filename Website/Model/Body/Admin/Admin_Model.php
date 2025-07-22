<?php

require_once "usrs/li_Admin_usr_Model.php";
require_once "act/li_Admin_act_Model.php";
require_once "ses/li_Admin_ses_Model.php";

$div_admin_body = new Div( 'admin_body_ID', 'admin_body', [
    $div_users,
    $div_acts,
    $div_ses,
] );

$div_admin_body = $div_admin_body->gen_div();


// Validation inscription

// Attributions des salles





?>
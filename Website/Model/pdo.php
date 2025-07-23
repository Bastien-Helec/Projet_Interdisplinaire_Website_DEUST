<?php

require_once './lib/Model/PHP/BDD/pdo.php';

$HOST = 'DB_Congres';
$DBNAME = "congres";
$USER = "mysql";
$PASSWORD = "mysql";
$PORT= "3306";

ob_start();
$pdo = new DBPDO($HOST, $DBNAME, $USER, $PASSWORD, $PORT);
$pdo_cnx = $pdo->connect();
$logMessage = ob_get_clean();

if (!empty(trim($logMessage))) {
    error_log("<<<<<<<< [PDO] " . $logMessage ." >>>>>>>>>>");
}

?>
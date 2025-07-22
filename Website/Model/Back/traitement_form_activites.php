<?php
require_once('../lib/Model/PHP/BDD/SQL/FONCTIONS METIERS/Select.php');
require_once('../lib/Model/PHP/BDD/SQL/FONCTIONS METIERS/Insert.php');

session_start();
$idUtilisateur = $_SESSION['idUtilisateur'] ?? null;

if (!$idUtilisateur) {
    die("Utilisateur non connecté.");
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['idActivite'])) {
    $idActivite = $_POST['idActivite'];

    $idInscription = Select_SQL::idInscription($idUtilisateur);
    if (!$idInscription) {
        Insert_SQL::insertInscription($idUtilisateur);
        $idInscription = Select_SQL::idInscription($idUtilisateur);
    }

    $inscriptions = Select_SQL::activitesUtilisateur($idUtilisateur);
    $dejaInscrit = false;
    foreach ($inscriptions as $inscr) {
        if ($inscr['idActivite'] == $idActivite) {
            $dejaInscrit = true;
            break;
        }
    }

    if ($dejaInscrit) {
        echo "Vous êtes déjà inscrit à cette activité.";
    } else {
        Insert_SQL::insertParticipation($idInscription, $idActivite);
        echo "Inscription réussie !";
    }
} else {
    echo "Aucune activité sélectionnée.";
}
?>
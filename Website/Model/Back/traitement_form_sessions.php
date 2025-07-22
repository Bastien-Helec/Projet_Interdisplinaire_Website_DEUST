<?php
require_once('../lib/Model/PHP/BDD/SQL/FONCTIONS METIERS/Select.php');
require_once('../lib/Model/PHP/BDD/SQL/FONCTIONS METIERS/Insert.php');

session_start();
$idUtilisateur = $_SESSION['idUtilisateur'] ?? null;

if (!$idUtilisateur) {
    die("Utilisateur non connecté.");
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['idSession'])) {
    $idSession = $_POST['idSession'];

    $idInscription = Select_SQL::idInscription($idUtilisateur);
    if (!$idInscription) {
        Insert_SQL::insertInscription($idUtilisateur);
        $idInscription = Select_SQL::idInscription($idUtilisateur);
    }

    $sessionsInscrites = Select_SQL::sessionsUtilisateur($idUtilisateur);
    $dejaInscrit = false;

    foreach ($sessionsInscrites as $sess) {
        if ($sess['idSession'] == $idSession) {
            $dejaInscrit = true;
            break;
        }
    }

    if ($dejaInscrit) {
        echo "Vous êtes déjà inscrit à cette session.";
    } else {
        Insert_SQL::insertInscriptionSession($idInscription, $idSession);
        echo "Inscription à la session réussie !";
    }
} else {
    echo "Aucune session sélectionnée.";
}
?>
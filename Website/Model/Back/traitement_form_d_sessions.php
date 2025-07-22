<?php
require_once('../lib/Model/PHP/BDD/SQL/FONCTIONS METIERS/Select.php');
require_once('../lib/Model/PHP/BDD/SQL/FONCTIONS METIERS/Delete.php');

session_start();
$idUtilisateur = $_SESSION['idUtilisateur'] ?? null;

if (!$idUtilisateur) {
    die("Utilisateur non connecté.");
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['idSession'])) {
    $idSession = $_POST['idSession'];

    $idInscription = Select_SQL::idInscription($idUtilisateur);

    if (!$idInscription) {
        echo "Aucune inscription trouvée.";
        exit;
    }

    Delete_SQL::deleteInscriptionSession($idInscription, $idSession);

    echo "Vous avez été désinscrit de la session.";
} else {
    echo "Aucune session sélectionnée.";
}
?>
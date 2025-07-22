<?php
session_start();

require_once './../lib/Model/PHP/FORMULAIRES/BACK/Form.php';
require_once './../lib/Model/PHP/FORMULAIRES/BACK/Update.php';
require_once './../lib/Model/PHP/FORMULAIRES/BACK/Auth.php';
require_once './../lib/Model/PHP/FORMULAIRES/BACK/Glob_Handling.php';
require_once './../lib/Model/PHP/FORMULAIRES/BACK/Delete.php';
require_once 'pdo.php';
require_once './../lib/Model/PHP/BDD/SQL/Select.php';
require_once './../lib/Model/PHP/BDD/SQL/Insert.php';
require_once './../lib/Model/PHP/BDD/SQL/Update.php';
require_once './../lib/Model/PHP/BDD/SQL/Delete.php';


if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['form_id'])){
    switch($_POST['form_id']){
        
        case 'Connexion':
            $cnx = new Auth('banner', '' , $pdo_cnx);
            $verif= $cnx->FORM_Connect('nom,prenom,login,mdp,estAdmin', 'prenom', 'nom', 'login', 'Login', 'Mdp','mdp','UTILISATEUR');
            var_dump($_SESSION);
            if($verif === 'Success') {
                $_SESSION['verif'] = "Success"; 
                    // Vérif si tentative d'accès admin
                    if (isset($_POST['Connexion_Mode_valeur']) && $_POST['Connexion_Mode_valeur'] === 'admin_verif') {
                        if (!empty($_SESSION['isadmin']) && $_SESSION['isadmin'] === true) {
                        $_SESSION['verif_admin'] = "Success";
                    } else {
                        $_SESSION['verif_admin'] = "Denied";
                    }
                }
            }
            break;
            
        case 'Inscription':
            $insc= new Glob_Handling('banner','', $pdo_cnx);
            $insc->FORM_Interact('UTILISATEUR', 'nom,prenom,adresse,cp,ville,mail,login,mdp,club_id', ['Nom', 'Prenom', 'Adresse', 'Cp', 'Ville', 'Email','Login', 'Mdp'], ['Mdp' => 'password_hash'], "SELECT", ", idClub FROM CLUB WHERE nom='{$_POST['Inscription_club_name_choix_valeur']}'");
            break;

    }
}

?>
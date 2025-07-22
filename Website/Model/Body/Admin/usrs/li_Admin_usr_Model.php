<?php
require_once "./lib/Model/PHP/PAGES/Div.php";
require_once "./lib/Model/PHP/PAGES/Fields.php";
require_once "./lib/Model/PHP/BDD/SQL/Select.php";
require_once "./lib/Model/PHP/BDD/SQL/Delete.php";

// Récupération des données utilisateurs
$users = new Select_SQL('idUtilisateur, nom, prenom, adresse, cp, ville, mail, club_id', 'UTILISATEUR');
$users_data = $users->execute_Cmplx_fetchAll_SQL('', $pdo_cnx);

// Construction du conteneur principal
$div_users = new Div('users_admin_ID', 'users_CLS', [
    new Bouton('ajout_user_admin_ID', 'Ajouter', 'btn'),
    new Bouton('Modifier_user_admin', 'Modifier', 'btn'),
    new Glob_Fields('users_header_ID', 'users_header_CLS', 'h1', 'Gestion des utilisateurs'),
    
    new Div(
        'users_body_ID',
        'users_body_CLS',
        array_map(function($user) {
            $id = $user['idUtilisateur'];
            return new Div(
                'user_'.$id.'_ID',
                'user_'.$id.'_CLS',
                [
                    new Glob_Fields('user_id_'.$id, 'user_info_CLS', 'h4', 'Utilisateur ID: '.$id),
                    new Glob_Fields('user_nom_'.$id, 'user_info_CLS', 'p', 'Nom: '.$user['nom'].' '.$user['prenom']),
                    new Glob_Fields('user_adresse_'.$id, 'user_info_CLS', 'p', 'Adresse: '.$user['adresse'].' '.$user['cp'].' '.$user['ville']),
                    new Glob_Fields('user_mail_'.$id, 'user_info_CLS', 'p', 'Email: '.$user['mail']),
                    new Glob_Fields('user_club_'.$id, 'user_info_CLS', 'p', 'Club ID: '.$user['club_id']),
                    new Glob_Fields(
                        'suppression_'.$id, 
                        'btn', 
                        'p', // ou 'div' si tu préfères un conteneur
                        '<a href="?page=admin&suppression_user=' . $id . '" onclick="return confirm(\'Confirmer la suppression ?\')">Supprimer</a>'
                    )
                ]
            );
        }, $users_data)
    )
]);

// Si une suppression est demandée
if (isset($_GET['suppression_user'])) {
    $user_id = $_GET['suppression_user'];

    // Sécurisation minimum (tu peux aussi cast en int : (int) $user_id)
    if (is_numeric($user_id)) {
        $delete = new Delete_SQL('UTILISATEUR');
        $result = $delete->execute_Simple_SQL('idUtilisateur = "' . $user_id . '"', $pdo_cnx);
        echo "<script>console.log('Suppression OK: " . htmlspecialchars(json_encode($result)) . "');</script>";
        
        // Optionnel : redirection après suppression
        echo '<script>window.location.href = "?page=admin";</script>';
        exit;
    } else {
        echo "<script>console.error('ID utilisateur invalide');</script>";
    }
}

// $div_users = $div_users->gen_div();
?>
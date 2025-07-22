<?php
require_once "./lib/Model/PHP/PAGES/Div.php";
require_once "./lib/Model/PHP/PAGES/Fields.php";
require_once "./lib/Model/PHP/BDD/SQL/Select.php";

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
                    new Glob_Fields('suppression_'.$id, 'btn', 'button', '<a href="?suppression_user='.$id.'">Supprimer</a>')
                ]
            );
        }, $users_data)
    )
]);

// $div_users = $div_users->gen_div();
?>
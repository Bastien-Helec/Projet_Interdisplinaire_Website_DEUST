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

            // Récupérer l'idUtilisateur inséré
            $idUtilisateur = $pdo_cnx->lastInsertId();
            $sql = "INSERT INTO INSCRIPTION (utilisateur_id, estValidee) VALUES (:utilisateur_id, 0)";
            $stmt = $pdo_cnx->prepare($sql);
            $stmt->execute(['utilisateur_id' => $idUtilisateur]);
            
            break;

        // Ajouter Utilisateur
        case 'Ajouter_usr':
            $ajout_usr = new Glob_Handling('banner', '', $pdo_cnx);
            $ajout_usr->FORM_Interact('UTILISATEUR', 'nom,prenom,adresse,cp,ville,mail,login,mdp,club_id', ['Nom', 'Prenom', 'Adresse', 'Cp', 'Ville', 'Email','Login', 'Mdp'], ['Mdp' => 'password_hash'], "SELECT", ", idClub FROM CLUB WHERE nom='{$_POST['Ajouter_usr_club_name_choix_valeur']}'");
            break;

        // Ajouter Activité
        case 'Ajouter_act':
            $ajout_act = new Glob_Handling('banner', '', $pdo_cnx);
            $ajout_act->FORM_Interact(
                'ACTIVITE',
                'libelle,tarif,nbPlace',
                ['libelle', 'tarif', 'nbPlace']
            );
            break;

        // Ajouter Session
        case 'Ajouter_ses':
            // var_dump($_POST);
            $ajout_ses = new Glob_Handling('banner', '', $pdo_cnx);

$ajout_ses->FORM_Interact(
    'SESSION',
    'theme, tarif, nbPlace, salle_id, planning_id',
    [],
    [],
    'SELECT', "
        '{$_POST['theme']}',
        {$_POST['tarif']},
        {$_POST['nbPlace']},
        (SELECT idSalle FROM SALLE WHERE nom = '{$_POST['Ajouter_ses_Salle_name_choix_valeur']}' LIMIT 1),
        (SELECT idPlanning FROM PLANNING WHERE idPlanning = {$_POST['Ajouter_ses_Planning_name_choix_valeur']} LIMIT 1)
    "
);


            break;

        // Modifier Utilisateur
        case 'Modifier_usr':
            if (!empty($_POST['mdp'])) {
                $_POST['mdp'] = password_hash($_POST['mdp'], PASSWORD_DEFAULT);
            }

                        $modif_usr = new Update('banner', '', $pdo_cnx);
            $modif_usr->set_update( ['nom','prenom','adresse', 'cp','ville','mail','login','mdp'],'UTILISATEUR',  'idUtilisateur = '.$_POST['idUtilisateur'].'');
        break;


        
        // Modifier Activité
        case 'Modifier_act':
            $modif_act = new Update('banner', '', $pdo_cnx);
            $modif_act->set_update(
                ['libelle', 'tarif', 'nbPlace'],      // noms des colonnes seulement
                'ACTIVITE',
                'idActivite = ' . (int)$_POST['idActivite'] // condition WHERE sécurisée
            );
            break;
            
            
            
            // Modifier Session
        case 'Modifier_ses':
    $modif_ses = new Update('banner', '', $pdo_cnx); // <- correction ici

    // Ajouter également les modifications pour salle_id et planning_id
    // Utiliser des sous-requêtes pour récupérer les IDs correspondants

    $modif_ses->set_update(
        ['theme', 'tarif', 'nbPlace'], // noms des colonnes
        'SESSION',
        'idSession = ' . (int)$_POST['idSession'], // condition WHERE sécurisée
        '', // pas de conditions supplémentaires
    );
    break;

        
        case 'inscription_activite':
            /* Ajouter une activité a un utilisateur : 
            - L'utilisateur va être identifié via son login (stocker dans $_SESSION['Identifiant'])
            - On va ensuite recuperer l'idUtilisateur dans la table UTILISATEUR
            - On va ensuite récuperer l'idInscription via l'idUtilisateur dans la table INSCRIPTION
            - On ajoute l'idInscription dans le table PARTICIPER avec l'idActivite donc where ACTIVITE.idActivite = $_POST['inscription_activite_libelle_name_choix_valeur']

            exemple : 
            , idClub FROM CLUB WHERE nom='{$_POST['Ajouter_usr_club_name_choix_valeur']}'
            
            */
            $participation = new Glob_Handling('banner', '', $pdo_cnx);
            $participation->FORM_Interact(
    'PARTICIPER',
    'idInscription, idActivite',
    [],  // pas besoin de noms d'affichage ici
    [],
    'SELECT',
    "(
        SELECT idInscription
        FROM INSCRIPTION
        INNER JOIN UTILISATEUR ON INSCRIPTION.utilisateur_id = UTILISATEUR.idUtilisateur
        WHERE UTILISATEUR.login = '{$_SESSION['Identifiant']}'LIMIT 1
    ),
    (
        SELECT idActivite
        FROM ACTIVITE
        WHERE libelle = '{$_POST['inscription_activite_libelle_name_choix_valeur']}'
        LIMIT 1
    )"
);
break;


        /* Suppression de l'inscription à une activité
            - L'utilisateur va être identifié via son login (stocker dans $_SESSION['Identifiant'])
            - On va ensuite recuperer l'idUtilisateur dans la table UTILISATEUR
            - On va ensuite récuperer l'idInscription via l'idUtilisateur dans la table INSCRIPTION
            - On va ensuite supprimer l'inscription dans la table PARTICIPER avec l'idInscription et l'idActivite donc where PARTICIPER.idInscription = idInscription AND PARTICIPER.idActivite = $_POST['inscription_activite_libelle_name_choix_valeur']

            DELETE FROM PARTICIPER 
            WHERE idInscription = (SELECT idInscription FROM INSCRIPTION WHERE utilisateur_id = (SELECT idUtilisateur FROM UTILISATEUR WHERE login = :login))
            AND idActivite = (SELECT idActivite FROM ACTIVITE WHERE libelle = :libelle) exemple :
            
            DELETE FROM PARTICIPER 
            WHERE idInscription = (SELECT idInscription FROM INSCRIPTION WHERE utilisateur_id = (SELECT idUtilisateur FROM UTILISATEUR WHERE login = 'b.helec'))
            AND idActivite = (SELECT idActivite FROM ACTIVITE WHERE libelle = 'Est_si_les_fourmis_avait_notre_force')

        */
        case 'desinscription_activite':
$desparticipation = new Delete('banner', '', $pdo_cnx);
$desparticipation->set_delete(
    'PARTICIPER',
    'idInscription = (SELECT idInscription FROM INSCRIPTION WHERE utilisateur_id = (SELECT idUtilisateur FROM UTILISATEUR WHERE login = :login)) AND idActivite = (SELECT idActivite FROM ACTIVITE WHERE libelle = :libelle)',
    null, // pas de confirmation dans $_POST
    '',
    [],
    [
        'login' => $_SESSION['Identifiant'],
        'libelle' => $_POST['desinscription_activite_libelle_name_choix_valeur']
    ]
);
break;

        // Inscription à une conférence
        case 'inscription_session':
            $participation = new Glob_Handling('banner', '', $pdo_cnx);
            $participation->FORM_Interact(
                'INSCRIRE',
                'idInscription, idSession',
                [],  // pas besoin de noms d'affichage ici
                [],
                'SELECT',
                "(
                SELECT idInscription
                FROM INSCRIPTION
                INNER JOIN UTILISATEUR ON INSCRIPTION.utilisateur_id = UTILISATEUR.idUtilisateur
                WHERE UTILISATEUR.login = '{$_SESSION['Identifiant']}'LIMIT 1
                ),      
                (
                    SELECT idSession
                    FROM SESSION
                    WHERE theme = '{$_POST['inscription_session_theme_name_choix_valeur']}'
                    LIMIT 1
                )"
            );
            break;

        case 'desinscription_session':
            $desparticipation = new Delete('banner', '', $pdo_cnx);
            $desparticipation->set_delete(
                'INSCRIRE',
                'idInscription = (SELECT idInscription FROM INSCRIPTION WHERE utilisateur_id = (SELECT idUtilisateur FROM UTILISATEUR WHERE login = :login)) AND idSession = (SELECT idSession FROM SESSION WHERE theme = :theme)',
                null, // pas de confirmation dans $_POST
                '',
                [],
                [
                    'login' => $_SESSION['Identifiant'],
                    'theme' => $_POST['desinscription_session_theme_name_choix_valeur']
                ]
            );
            break;




    }
}
?>
<?php
require_once "./lib/Model/PHP/PAGES/Div.php";
require_once "./lib/Model/PHP/PAGES/Fields.php";
require_once "./lib/Model/PHP/BDD/SQL/Select.php";

// Récupération des données utilisateurs
$ses = new Select_SQL('idSession,theme,tarif,nbPlace,salle_id,planning_id', 'SESSION');
$ses_data = $ses->execute_Cmplx_fetchAll_SQL('', $pdo_cnx);

// Construction du conteneur principal
$div_ses = new Div('ses_admin_ID', 'ses_CLS', [
    new Bouton('ajout_ses_admin_ID', 'Ajouter', 'btn'),
    new Bouton('Modifier_ses_admin', 'Modifier', 'btn'),
    new Glob_Fields('ses_header_ID', 'ses_header_CLS', 'h1', 'Gestion des Sessions'),
    
    new Div(
        'ses_body_ID',
        'ses_body_CLS',
        array_map(function($ses) {
            $id = $ses['idSession'];
            return new Div(
                'ses_'.$id.'_ID',
                'ses_'.$id.'_CLS',
                [
                    new Glob_Fields('ses_id_'.$id, 'ses_info_CLS', 'h4', 'Session ID: '.$id),
                    new Glob_Fields('ses_libelle_'.$id, 'ses_info_CLS', 'p', 'theme: '.$ses['theme']),
                    new Glob_Fields('ses_tarif_'.$id, 'ses_info_CLS', 'p', 'tarif: '.$ses['tarif']),
                    new Glob_Fields('ses_nbPlace_'.$id, 'ses_info_CLS', 'p', 'nombres de Places: '.$ses['nbPlace']),
                    new Glob_Fields('ses_salle_id_'.$id, 'ses_info_CLS', 'p', 'Salle ID : '.$ses['salle_id']),
                    new Glob_Fields('ses_planning_id_'.$id, 'ses_info_CLS', 'p', 'Planning ID : '.$ses['planning_id']),
                    new Glob_Fields(
                        'suppression_'.$id, 
                        'btn', 
                        'p', // ou 'div' si tu préfères un conteneur
                        '<a href="?page=admin&suppression_ses=' . $id . '" onclick="return confirm(\'Confirmer la suppression ?\')">Supprimer</a>'
                    )
                ]
            );
        }, $ses_data)
    )
]);

// Si une suppression est demandée
if (isset($_GET['suppression_ses'])) {
    $ses_id = $_GET['suppression_ses'];

    // Sécurisation minimum (tu peux aussi cast en int : (int) $ses_id)
    if (is_numeric($ses_id)) {
        $delete = new Delete_SQL('SESSION');
        $result = $delete->execute_Simple_SQL('idSession = "' . $ses_id . '"', $pdo_cnx);
        echo "<script>console.log('Suppression OK: " . htmlspecialchars(json_encode($result)) . "');</script>";
        
        // Optionnel : redirection après suppression
        echo '<script>window.location.href = "?page=admin";</script>';
        exit;
    } else {
        echo "<script>console.error('ID Session invalide');</script>";
    }
}

// $div_ses = $div_ses->gen_div();
?>
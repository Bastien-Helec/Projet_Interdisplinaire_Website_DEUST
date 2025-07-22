<?php
require_once "./lib/Model/PHP/PAGES/Div.php";
require_once "./lib/Model/PHP/PAGES/Fields.php";
require_once "./lib/Model/PHP/BDD/SQL/Select.php";

// Récupération des données utilisateurs
$acts = new Select_SQL('idActivite,libelle,tarif,nbPlace', 'ACTIVITE');
$acts_data = $acts->execute_Cmplx_fetchAll_SQL('', $pdo_cnx);

// Construction du conteneur principal
$div_acts = new Div('acts_admin_ID', 'acts_CLS', [
    new Bouton('ajout_act_admin_ID', 'Ajouter', 'btn'),
    new Bouton('Modifier_act_admin', 'Modifier', 'btn'),
    new Glob_Fields('acts_header_ID', 'acts_header_CLS', 'h1', 'Gestion des Activités'),
    
    new Div(
        'acts_body_ID',
        'acts_body_CLS',
        array_map(function($act) {
            $id = $act['idActivite'];
            return new Div(
                'act_'.$id.'_ID',
                'act_'.$id.'_CLS',
                [
                    new Glob_Fields('act_id_'.$id, 'act_info_CLS', 'h4', 'Utilisateur ID: '.$id),
                    new Glob_Fields('act_libelle_'.$id, 'act_info_CLS', 'p', 'libelle: '.$act['libelle']),
                    new Glob_Fields('act_tarif_'.$id, 'act_info_CLS', 'p', 'tarif: '.$act['tarif']),
                    new Glob_Fields('act_nbPlace_'.$id, 'act_info_CLS', 'p', 'nombres de Places: '.$act['nbPlace']),
                    new Glob_Fields(
                        'suppression_'.$id, 
                        'btn', 
                        'p', // ou 'div' si tu préfères un conteneur
                        '<a href="?page=admin&suppression_acts=' . $id . '" onclick="return confirm(\'Confirmer la suppression ?\')">Supprimer</a>'
                    )
                ]
            );
        }, $acts_data)
    )
]);

// Si une suppression est demandée
if (isset($_GET['suppression_acts'])) {
    $acts_id = $_GET['suppression_acts'];

    // Sécurisation minimum (tu peux aussi cast en int : (int) $acts_id)
    if (is_numeric($acts_id)) {
        $delete = new Delete_SQL('ACTIVITE');
        $result = $delete->execute_Simple_SQL('idActivite = "' . $acts_id . '"', $pdo_cnx);
        echo "<script>console.log('Suppression OK: " . htmlspecialchars(json_encode($result)) . "');</script>";
        
        // Optionnel : redirection après suppression
        echo '<script>window.location.href = "?page=admin";</script>';
        exit;
    } else {
        echo "<script>console.error('ID Activité invalide');</script>";
    }
}

// $div_acts = $div_acts->gen_div();
?>
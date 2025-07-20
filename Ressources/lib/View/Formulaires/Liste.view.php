<?php 

// Affichage de la liste sans PDO
if (!empty($liste)) {
    echo "<div class='select' id='" . $liste['idFormulaire'] . "_" . $liste['nom_liste'] . "_select'>";
    echo "<button id='" . $liste['idFormulaire'] . "_" . $liste['nom_liste'] . "_choix_btn'>" . $liste['nom_btn'] . "</button>";
    echo "<select id='" . $liste['idFormulaire'] . "_" . $liste['nom_liste'] . "_options'>";
    
    foreach ($liste['libelle'] as $index => $ecole) {
        echo "<option id='" . $liste['idFormulaire'] . "_" . $liste['nom_liste'] . "_$index'>" . $ecole . "</option>";
    }

    echo "</select>";
    echo "</div>";
}
?>

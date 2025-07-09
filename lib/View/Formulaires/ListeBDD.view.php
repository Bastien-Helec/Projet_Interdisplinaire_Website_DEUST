<?php 

// Affichage de la liste avec PDO
if (!empty($listeBDD)) {
    echo "<div class='select' id='".$idFormulaire."_".$nom_liste."_select'>
    <button id='".$idFormulaire."_".$nom_liste."_choix_btn'>".$nom_btn."</button>
    <ul id='".$idFormulaire."_".$nom_liste."_options'>";

    foreach ($listeBDD as $row) {
        $value = htmlspecialchars($row[$colonne]);
        $libelle = str_replace('_', ' ', $value);
        echo "<li id='$value' data-value='$value'>$libelle</li>";
    }
    echo "</ul>
    <input type='hidden' id='".$idFormulaire."_".$nom_liste."choix_valeur' id='".$idFormulaire."_name_choix_valeur'/>
    </div>";

}
?>

<?php


if (!empty($Libelle)) {
    echo "<ul>";
    foreach ($Libelle as $row) {
        $value = htmlspecialchars($row[$colonne]);
        $libelle = str_replace('_', ' ', $value);
        echo "<li id='$value' data-value='$value'>$libelle</li>";
    }
    echo "</ul>";
}

?>
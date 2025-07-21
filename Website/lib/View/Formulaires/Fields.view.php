<?php
// Affichage du Field
if (!empty($fields)) {
    foreach ($fields as $Field) {
        $requis = ($Field['requis'] === 'requis') ? 'required' : '';
        if ($Field['fields_type'] !== 'input') {
            echo '<input type="' . htmlspecialchars($Field['type']) . '" name="' . $idFormulaire . '_' . htmlspecialchars($Field['nom']) . '" placeholder="' . htmlspecialchars($Field['placeholder']) . '" ' . $requis . '>';
        } else 
        {
            echo '<'.$Field['fields_type'] .'  type="' . htmlspecialchars($Field['type']) . '" name="' . $idFormulaire . '_' . htmlspecialchars($Field['nom']) . '" placeholder="' . htmlspecialchars($Field['placeholder']) . '" ' . $requis . '>';
        }
    }
}
?>

<?php

Class Glob_Handling extends BaseForm {

   private function Insert_data(string $db_table, string $db_columns, $F_names, $F_action, $cdt_plus, $cdts_db) {
    
    $raw_values = [];

    // Étape 1 : gestion éventuelle des transformations (ex: hash mot de passe)
    if (!empty($F_action)) {
        foreach ($F_action as $champ => $action) {
            if (isset($_POST[$champ])) {
                switch ($action) {
                    case 'password_hash':
                        $_POST[$champ] = password_hash($_POST[$champ], PASSWORD_DEFAULT);
                        break;
                }
            }
        }
    }

    // Étape 2 : extraction et normalisation des valeurs
    foreach ($F_names as $f) {
        if (isset($_POST[$f]) && $_POST[$f] !== '') {
            $val = str_replace(' ', '_', $_POST[$f]);
            $raw_values[] = $val;
        }
    }

    // Étape 3 : insertion
if (!empty($raw_values) || $cdt_plus !== null) {
    $insert_sql = new Insert_SQL($db_columns, $db_table);

    if ($cdt_plus === null) {
        // Insertion simple classique
        $insert_sql->execute_Simple_SQL($raw_values, $this->pdo);

            echo json_encode([
                'Status' => 'Success',
                'message' => implode(', ', $raw_values) . ", Ajouté avec succès dans $db_table",
                'banner' => [
                    'id' => $this->id_banner,
                    'message' => implode(', ', array_map(fn($v) => str_replace('_', ' ', $v), $raw_values)) . ", Ajouté avec succès dans $db_table"
                ],
            ]);
        } else {
            // Création des valeurs SQL entre guillemets
            $quoted_values = array_map(fn($v) => "'" . trim($v) . "'", $raw_values);
            $sql_values = implode(', ', $quoted_values);

            $insert_sql->execute_Cmplx_SQL($sql_values, $cdt_plus, $cdts_db, $this->pdo);
            // var_dump($insert_sql);

            echo json_encode([
                'Status' => 'Success',
                'message' => "Ajouté avec succès dans $db_table",
                'banner' => [
                    'id' => $this->id_banner,
                    'message' => "Ajouté avec succès dans $db_table"
                ],
            ]);
        }
        // $insert_sql->execute_Cmplx_SQL($sql_values, $cdt_plus, $cdts_db, $this->pdo);

    }
}


    public function FORM_Interact($db_table, $db_columns, array $f_name, $F_action=[],$cdt_plus=null,$cdts_db=null) {
        try{
        if($this->isPost){
            $this->Insert_data($db_table, $db_columns, $f_name, $F_action,$cdt_plus,$cdts_db);
            // $result = $this->Insert_data($db_table, $db_columns, $f_name, $F_action, $cdt_plus, $cdts_db);
            // var_dump($result);
            
        }
        else {
            echo json_encode([
                'Status' => 'Error',
                'message' => 'Erreur de traitement',
            ]);
            exit;
        }
        } catch (PDOException $e) {
        $errorMsg = $e->getMessage();

        if (strpos($errorMsg, 'duplicate') !== false || strpos($errorMsg, 'Duplicate') !== false) {
            // Cas d'erreur doublon
            echo json_encode([
                'Status' => 'Error',
                'message' => "Déjà inséré : l'enregistrement existe déjà.",
                'banner' => [
                    'id' => $this->id_banner,
                    'message' => "Erreur : cet enregistrement est déjà présent."
                ],
                'info' => $errorMsg,
            ]);
        } else {
            // Autres erreurs
            echo json_encode([
                'Status' => 'Error',
                'message' => "Erreur lors de l'insertion.",
                'banner' => [
                    'id' => $this->id_banner,
                    'message' => "Erreur lors de l'insertion, voir console."
                ],
                'info' => $errorMsg,
            ]);
        }
            exit;
        }
    }

}
?>
<?php

class Update extends BaseForm {

private function update($db_columns, $db_table, $cdt, $cdt_plus = "", $cdts = "") {
    if (!empty($_POST)) {
        $update_sql = new SQL_Update($db_table, $db_columns, $_POST);

        // Cas 1 : tableau de colonnes → update simple
        if (is_array($db_columns)) {
            $result = $update_sql->execute_Simple_SQL($cdt, $this->pdo);
        }
        // Cas 2 : colonne(s) déjà formatée(s) (ex: "col = val") → update complexe
        else {
            $result = $update_sql->execute_Cmplx_SQL($cdt_plus, $cdts, $this->pdo);
        }

        unset($_POST);

            if ($result) {
                $this->message = "Modification effectuée avec succès";
                echo json_encode([
                    'Status' => 'Success',
                    'message' => "Modifié avec succès dans $db_table",
                    'banner' => [
                        'id' => $this->id_banner,
                        'message' => "Modifié avec succès dans $db_table"
                    ],
                ]);
                exit; // ⬅️ indispensable
            } else {
                $this->message = "Erreur lors de la modification";
                echo json_encode([
                    'Status' => 'Error',
                    'message' => "Erreur lors de la modification dans $db_table",
                    'banner' => [
                        'id' => $this->id_banner,
                        'message' => "Erreur lors de la modification"
                    ],
                ]);
                exit; // ⬅️ indispensable
            }
        } else {
            $this->message = "Aucune donnée à mettre à jour";
            echo json_encode([
                'Status' => 'Error',
                'message' => "Aucune donnée à mettre à jour",
                'banner' => [
                    'id' => $this->id_banner,
                    'message' => "Aucune donnée à mettre à jour"
                ],
            ]);
            exit; // ⬅️ indispensable
        }
    }

    public function set_update($db_columns, $db_table, $cdt, $cdt_plus = "", $cdts = "") {
        if ($this->isPost) {
            return $this->update($db_columns, $db_table, $cdt, $cdt_plus, $cdts);
        } else {
            $this->message = "Aucune donnée à mettre à jour";
            echo json_encode([
                'Status' => 'Error',
                'message' => "Aucune donnée à mettre à jour",
                'banner' => [
                    'id' => $this->id_banner,
                    'message' => "Aucune donnée à mettre à jour"
                ],
            ]);
            exit; // ⬅️ indispensable
        }
    }
}
?>
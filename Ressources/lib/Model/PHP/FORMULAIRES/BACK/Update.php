<?php

class Update extends BaseForm {

    private function update($after_set, $db_table,$join = "", $cdt_simple ="", $sup_cdts = "") {
        if (!empty($_POST)) {
            $update_sql = new SQL_Update($db_table, $after_set, $_POST);

            if (empty($cdt)) {
                $result = $update_sql->execute_Cmplx_SQL($join, $sup_cdts, $this->pdo);
            } elseif (empty($sup_cdts)) {
                $result = $update_sql->execute_Simple_SQL($cdt_simple, $this->pdo);
            } else {
                if ($join === "") {
                    $result = $update_sql->execute_Cmplx_SQL($join, $sup_cdts, $this->pdo);
                }
                else {
                    $result = $update_sql->execute_Cmplx_SQL($join, $sup_cdts, $this->pdo);
                }
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

    public function set_update($after_set, $db_table,$join = "", $cdt_simple ="" , $sup_cdts = "") {
        if ($this->isPost) {
            return $this->update($after_set, $db_table, $join , $cdt_simple, $sup_cdts);
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

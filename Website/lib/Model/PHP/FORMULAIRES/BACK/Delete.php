<?php

class Delete extends BaseForm {

    private function delete($db_table, $cdt, $params = [], $cdt_plus = "", $cdts = "") {
        $delete_sql = new Delete_SQL($db_table);
        $result = $delete_sql->execute_Simple_SQL($cdt, $this->pdo, $params);
        if ($result) {
            echo json_encode([
                'Status' => 'Success',
                'message' => "Supprimé avec succès de {$db_table}",
                'banner' => [
                    'id' => $this->id_banner,
                    'message' => "Supprimé avec succès de {$db_table}"
                ],
            ]);
            return true;
        } else {
            echo json_encode([
                'Status' => 'Error',
                'message' => "Erreur lors de la suppression, Cet enregistrement n'existe pas pour vous",
                'banner' => [
                    'id' => $this->id_banner,
                    'message' => "Erreur lors de la suppression, Cet enregistrement n'existe pas pour vous"
                ]
            ]);
            return false;
        }
    }

    public function set_delete($db_table, $cdt, $name_suppresion = null, $cdt_plus = "", $cdts = "", $params = []) {
        try {
            if ($this->isPost) {
                if ($name_suppresion === null || (isset($_POST[$name_suppresion]) && $_POST[$name_suppresion] === "oui")) {
                    return $this->delete($db_table, $cdt, $params, $cdt_plus, $cdts);
                } else {
                    echo json_encode([
                        'Status' => 'Error',
                        'message' => 'Suppression non confirmée',
                        'banner' => [
                            'id' => $this->id_banner,
                            'message' => 'Suppression non confirmée'
                        ]
                    ]);
                    return false;
                }
            } else {
                echo json_encode([
                    'Status' => 'Error',
                    'message' => "Aucune donnée à supprimer",
                    'banner' => [
                        'id' => $this->id_banner,
                        'message' => "Aucune donnée à supprimer"
                    ]
                ]);
                return false;
            }
        } catch (Exception $e) {
            echo json_encode([
                'Status' => 'Error',
                'message' => 'Erreur de traitement',
                'banner' => [
                    'id' => $this->id_banner,
                    'message' => "Erreur de traitement, voir console : {$e->getMessage()}",
                ],
                'info' => $e->getMessage(),
            ]);
            exit;
        }
    }

}

?>
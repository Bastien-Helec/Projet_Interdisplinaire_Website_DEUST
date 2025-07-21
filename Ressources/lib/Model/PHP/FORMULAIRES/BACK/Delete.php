<?php

class Delete extends BaseForm {

    private function delete($db_table, $cdt, $cdt_plus = "", $cdts = "") {
        // On verifie si les champs sont remplis
            $delete_sql = new Delete_SQL($db_table);
            $result = $delete_sql->execute_Simple_SQL($cdt, $this->pdo);
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
        'message' => "Erreur lors de la suppression",
        'banner' => [
            'id' => $this->id_banner,
            'message' => "Erreur lors de la suppression"
        ]
    ]);
    return false;
}
    }


  public function set_delete($db_table, $cdt, $name_suppresion, $cdt_plus = "", $cdts = "") {
    if ($this->isPost) {
        if (isset($_POST[$name_suppresion]) && $_POST[$name_suppresion] === "oui") {
            return $this->delete($db_table, $cdt, $cdt_plus, $cdts);
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
}

}

?>
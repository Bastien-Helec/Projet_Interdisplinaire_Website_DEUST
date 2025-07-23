<?php

Class Delete_SQL {
    private $table;


public function __construct(string $table) {
    $this->table = $table;
}

private function delete_SmplSQL(string $cdt) {
    return "DELETE FROM {$this->table} WHERE {$cdt}";
}

private function delete_CmplxSQL(string $cdt_plus, string $cdts) {
    return "DELETE FROM {$this->table} {$cdt_plus} {$cdts}";
}

public function execute_Simple_SQL(string $cdt, PDO $pdo, array $params = []) {
        $sql = $this->delete_SmplSQL($cdt);
        // var_dump($sql);
        $stmt = $pdo->prepare($sql);
        $stmt->execute($params);

        // rowCount() donne le nombre de lignes affectées
        return $stmt->rowCount() > 0;
}

}

?>
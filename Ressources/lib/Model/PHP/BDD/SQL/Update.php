<?php

class Update_SQL {
    private string $table;
    private array $columns = []; // utile pour les updates simples
    private array|string $values;
    private string $after_set = '';

    public function __construct(string $table, array|string $after_set, array|string $values) {
        $this->table = $table;

        // Si $after_set est un tableau, on est dans un update simple
        if (is_array($after_set)) {
            $this->columns = $after_set;
        } else {
            $this->after_set = $after_set;
        }

        $this->values = $values;
    }

    // Requête UPDATE simple
    private function update_SmplSQL(string $cdt, PDO $pdo): string {
        $pairs = [];

        foreach ($this->columns as $column) {
            if (isset($this->values[$column])) {
                $value = $this->values[$column];
                if ($value === null || $value === '') {
                    continue;
                }

                $quoted = $pdo->quote($value);
                $pairs[] = "{$column} = {$quoted}";
            }
        }

        $columns_str = implode(', ', $pairs);
        return "UPDATE {$this->table} SET {$columns_str} WHERE {$cdt}";
    }

    // Requête UPDATE complexe
    private function update_CmplxSQL(string $join, string $sup_cdts): string {
        return "UPDATE {$this->table} {$join} SET {$this->after_set} {$sup_cdts}";
    }

    // Exécution simple
    public function execute_Simple_SQL(string $cdt, PDO $pdo) {
        $sql = $this->update_SmplSQL($cdt, $pdo);
        // var_dump($sql);
        $stmt = $pdo->prepare($sql);
        return $stmt->execute();
    }

    // Exécution complexe
    public function execute_Cmplx_SQL(string $join, string $sup_cdts, PDO $pdo){
        $sql = $this->update_CmplxSQL($join, $sup_cdts);
        // var_dump($sql);
        $stmt = $pdo->prepare($sql);
        return $stmt->execute();
    }
}

?>

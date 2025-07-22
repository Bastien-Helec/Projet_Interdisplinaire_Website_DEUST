<?php

class SQL_Update {
    private string $table;
    private array $columns;
    private array|string $values;

    public function __construct(string $table, array $columns, array|string $values) {
        $this->table = $table;
        $this->columns = $columns;
        $this->values = $values;
    }

private function update_SmplSQL(string $cdt, PDO $pdo) {
    $pairs = [];

    foreach ($this->columns as $column) {
        if (isset($this->values[$column])) {
            // Si la clé na pas de valeur on ne l'ajoute pas
            if ($this->values[$column] === null || $this->values[$column] === '') {
                continue;
            }
            
            $value = $pdo->quote($this->values[$column]); // protection SQL
            $pairs[] = "{$column} = {$value}";
        }
    }

    $columns_str = implode(', ', $pairs);
    return "UPDATE {$this->table} SET {$columns_str} WHERE {$cdt}";
}


private function update_CmplxSQL(string $cdt_plus, string $cdts): string {
    // Si $this->columns est un tableau, on le transforme en string
    $columns_str = is_array($this->columns) ? implode(', ', $this->columns) : $this->columns;

    return "UPDATE {$this->table} SET {$columns_str} {$cdt_plus} {$cdts}";
}


public function execute_Simple_SQL(string $cdt, PDO $pdo) {
    $sql = $this->update_SmplSQL($cdt, $pdo);
    // var_dump($sql); // pour debug
    $stmt = $pdo->prepare($sql);
    return $stmt->execute(); // pas besoin de bind ici
}


    public function execute_Cmplx_SQL(string $cdt_plus, string $cdts, PDO $pdo) {
        $sql = $this->update_CmplxSQL($cdt_plus, $cdts);
        // var_dump($sql);
        $stmt = $pdo->prepare($sql);
        return $stmt->execute();
    }
}

?>
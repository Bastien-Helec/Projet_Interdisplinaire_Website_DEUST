<?php

Class Insert_SQL {
    private string $columns;
    private string $table;

    public function __construct(string $columns, string $table) {
        $this->columns = $columns;
        $this->table = $table;
    }

    private function add_SmplSQL(string|array $val) {
        if (is_array($val)){
        $val_end = implode(', ', array_fill(0, count($val), '?'));
        return "INSERT INTO {$this->table} ({$this->columns}) VALUES ($val_end)";
        }
        else {
            return "INSERT INTO {$this->table} ({$this->columns}) VALUES ($val)";
        }
    }

    private function add_CmplxSQL(string $val,string $cdt_plus,string $cdts){
        return "INSERT INTO {$this->table}({$this->columns}) {$cdt_plus} {$val} {$cdts}";
    }

    public function execute_Simple_SQL($val,PDO $pdo) {
        $sql = $this->add_SmplSQL($val);
        // var_dump($sql);
        $stmt= $pdo->prepare($sql);
        $stmt->execute(is_array($val) ? $val : [$val]);
    }

    public function execute_Cmplx_SQL($val,$cdt_plus,$cdts,PDO $pdo) {
        $sql = $this->add_CmplxSQL($val,$cdt_plus,$cdts);
        // var_dump($sql);
        $stmt= $pdo->prepare($sql);
        $stmt->execute();
    }
}

?>
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
        // var_dump("INSERT INTO {$this->table}({$this->columns}) {$cdt_plus} {$val} {$cdts}");
        return "INSERT INTO {$this->table}({$this->columns}) {$cdt_plus} {$val} {$cdts}";
    }
    
    public function execute_Simple_SQL($val,PDO $pdo) {
        // echo "<pre>val = $val\ncdt_plus = $cdt_plus\ncdts = $cdts</pre>";
        $sql = $this->add_SmplSQL($val);
        // var_dump($sql);
        // echo "<pre>SQL (complexe):\n$sql\n</pre>";
        $stmt= $pdo->prepare($sql);
        $stmt->execute(is_array($val) ? $val : [$val]);
        // var_dump("INSERT INTO {$this->table}({$this->columns}) {$val}");
    }
    
   public function execute_Cmplx_SQL($val, $cdt_plus, $cdts, PDO $pdo) {
    $sql = $this->add_CmplxSQL($val, $cdt_plus, $cdts);
    // echo "<pre>SQL (complexe):\n$sql\n</pre>";

    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    // var_dump("INSERT INTO {$this->table}({$this->columns}) {$cdt_plus} {$val} {$cdts}");
}

}

?>
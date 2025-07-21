<?php

Class Select_SQL {

    private string $field;
    private string $table;

    public function __construct(string $field, string $table) {
        $this->field = $field;
        $this->table = $table;
    }

    private function get_SmplSQL(string $where): string {
        return "SELECT {$this->field} FROM {$this->table} WHERE {$where}";
    }

    private function get_CmplxSQL(string $cdts): string {
        return "SELECT {$this->field} FROM {$this->table} {$cdts}";
    }

    public function execute_Simple_SQL($where,PDO $pdo): array {
        $sql = $this->get_SmplSQL($where);
        // var_dump($sql);
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function execute_Cmplx_fetch_SQL($cdts, PDO $pdo): array {
        $sql = $this->get_CmplxSQL($cdts);
        $stmt = $pdo->prepare($sql);
        // var_dump($stmt);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function execute_Cmplx_fetchAll_SQL($cdts, PDO $pdo): array {
        $sql = $this->get_CmplxSQL($cdts);
        $stmt = $pdo->prepare($sql);
        // var_dump($stmt);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}

?>
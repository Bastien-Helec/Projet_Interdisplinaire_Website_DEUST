<?php

/**
 * 
 * Permet de recuperer les informations d'une colonne par rapport a une table dans la BDD
 * 
 */
class Libelle {
    private string $table;
    private string $colonne;
    // On appelle le pdo 
    private PDO $pdo;

    // Constructeur de la classe
    public function __construct(string $table, string $colonne, PDO $pdo) {
        $this->pdo = $pdo;
        $this->table = $table;
        $this->colonne = $colonne;
    }

    // Fonction qui va nous permettre de recuperer les libelles

    public function getLibelle(): array {
        $sql_get_libelle = "SELECT {$this->colonne} FROM {$this->table}";
        $stmt = $this->pdo->prepare($sql_get_libelle);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function setLibelle(string $libelle): void {
        $sql_set_libelle = "INSERT INTO {$this->table} ($this->colonne) VALUES (:libelle)";
        $stmt = $this->pdo->prepare($sql_set_libelle);
        $stmt->bindParam(':libelle', $libelle);
        $stmt->execute();
    }

    public function deleteLibelle(string $libelle): void {
        $sql_delete_libelle = "DELETE FROM {$this->table} WHERE {$this->colonne} = :libelle";
        $stmt = $this->pdo->prepare($sql_delete_libelle);
        $stmt->bindParam(':libelle', $libelle);
        $stmt->execute();
    }

}
?>
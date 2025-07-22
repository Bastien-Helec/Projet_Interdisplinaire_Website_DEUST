<?php

/**
 * Liste qui intéragis avec la BDD
 */
require_once 'FormElement.php';

class ListeBDD implements FormElement {
    private string $nom_btn;
    private string $nom_liste;

    private string $nom_colonne;
    private string $nom_table;

    // Appelle de la lib BDD (libelle.php)
    private Libelle $libelle;
    private PDO $pdo;

    // Constructeur de la classe
    public function __construct(string $nom_btn, string $nom_liste, string $nom_colonne, string $nom_table, PDO $pdo){
        $this->nom_btn = $nom_btn;
        $this->nom_liste = $nom_liste;
        $this->nom_colonne = $nom_colonne;
        $this->nom_table = $nom_table;

        // On appelle le pdo 
        $this->pdo = $pdo;

        // On instancie le libelle
        $this->libelle = new Libelle($this->nom_table, $this->nom_colonne, $this->pdo);
    }

    // Fonction création de liste (infinie)
    public function createListe(string $idFormulaire): array {
        // On récupère les libelles
        $libelle = $this->libelle->getLibelle();

        // On crée le tableau de retour
        $infos = [
            'idFormulaire' => $idFormulaire,
            'nom_liste' => $this->nom_liste,
            'nom_btn' => $this->nom_btn,
            'libelle' => $libelle
        ];

        return $infos;
    }

    // Pour interaction avec le formulaire
    public function getData(): array {
        // On récupère les libelles
        $libelle = $this->libelle->getLibelle();

        // On crée le tableau de retour
        return [
            'nom_liste' => $this->nom_liste,
            'nom_btn' => $this->nom_btn,
            'colonne' => $this->nom_colonne, 
            'libelle' => $libelle
        ];

    }

}
?>
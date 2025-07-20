<?php

/**
 * 
 * Liste qui n'intéragis pas avec la BDD
 * 
 */

class Liste {

    private string $nom_btn;
    private string $nom_liste;
    private array $param_liste;

    // Constructeur de la classe
    public function __construct(string $nom_btn, string $nom_liste, array $param_liste) {
        $this->nom_btn = $nom_btn;
        $this->nom_liste = $nom_liste;
        $this->param_liste = $param_liste;
    }
    // Fonction création de liste (infinie)
    public function createListe(string $idFormulaire): array {
        // On crée le tableau de retour
        $infos = [
            'idFormulaire' => $idFormulaire,
            'nom_liste' => $this->nom_liste,
            'nom_btn' => $this->nom_btn,
            'libelle' => $this->param_liste
        ];

        return $infos;
    }
}


?>
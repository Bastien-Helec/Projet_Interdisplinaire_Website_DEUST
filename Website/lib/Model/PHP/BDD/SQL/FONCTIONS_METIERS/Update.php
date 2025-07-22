<?php
class Update_SQL {
    private PDO $pdo;

    public function __construct(PDO $pdo) {
        $this->pdo = $pdo;
    }

    public function modifierUtilisateur($id, $nom, $prenom, $adresse, $cp, $ville, $mail, $login, $mdp, $idClub) {
        $sql = "UPDATE UTILISATEUR
                SET nom = :nom, prenom = :prenom, adresse = :adresse, cp = :cp, ville = :ville,
                    mail = :mail, login = :login, mdp = :mdp, club_id = :club_id
                WHERE idUtilisateur = :id";

        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([
            "id" => $id,
            "nom" => $nom,
            "prenom" => $prenom,
            "adresse" => $adresse,
            "cp" => $cp,
            "ville" => $ville,
            "mail" => $mail,
            "login" => $login,
            "mdp" => $mdp,
            "club_id" => $idClub
        ]);
    }

    public function validerInscription($idInscription) {
        $sql = "UPDATE INSCRIPTION SET estValidee = 1 WHERE idInscription = :id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute(["id" => $idInscription]);
    }

    public function modifierActivite($id, $libelle, $tarif, $nbPlace) {
        $sql = "UPDATE ACTIVITE 
                SET libelle = :libelle, tarif = :tarif, nbPlace = :nbPlace 
                WHERE idActivite = :id";

        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([
            "id" => $id,
            "libelle" => $libelle,
            "tarif" => $tarif,
            "nbPlace" => $nbPlace
        ]);
    }

    public function modifierSession($id, $theme, $tarif, $nbPlace, $idPlanning, $idSalle) {
        $sql = "UPDATE SESSION 
                SET theme = :theme, tarif = :tarif, nbPlace = :nbPlace, 
                    planning_id = :idPlanning, salle_id = :idSalle
                WHERE idSession = :id";

        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([
            "id" => $id,
            "theme" => $theme,
            "tarif" => $tarif,
            "nbPlace" => $nbPlace,
            "idPlanning" => $idPlanning,
            "idSalle" => $idSalle
        ]);
    }
}
?>

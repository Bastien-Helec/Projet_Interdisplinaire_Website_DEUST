<?php
class Insert_SQL {
    private PDO $pdo;

    public function __construct(PDO $pdo) {
        $this->pdo = $pdo;
    }

    // Ajouter un utilisateur
    public function insertUtilisateur($nom, $prenom, $adresse, $cp, $ville, $mail, $login, $mdp, $idClub) {
        $sql = "INSERT INTO UTILISATEUR (nom, prenom, adresse, cp, ville, mail, login, mdp, club_id)
                VALUES (:nom, :prenom, :adresse, :cp, :ville, :mail, :login, :mdp, :club_id)";
        
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([
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

    // Ajouter une inscription
    public function insertInscription($idUtilisateur) {
        $sql = "INSERT INTO INSCRIPTION (estValidee, utilisateur_id) 
                VALUES (0, :id)";
        
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute(["id" => $idUtilisateur]);
    }

    // Ajouter une participation
    public function insertParticipation($idInscription, $idActivite) {
        $sql = "INSERT INTO PARTICIPER (idInscription, idActivite) 
                VALUES (:idInscription, :idActivite)";
        
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([
            "idInscription" => $idInscription,
            "idActivite" => $idActivite
        ]);
    }

    // Ajouter une inscription à une session
    public function insertInscriptionSession($idInscription, $idSession) {
        $sql = "INSERT INTO INSCRIRE (idInscription, idSession) 
                VALUES (:idInscription, :idSession)";
        
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([
            "idInscription" => $idInscription,
            "idSession" => $idSession
        ]);
    }

    // Ajouter une session
    public function insertSession($theme, $tarif, $nbPlace, $idPlanning, $idSalle) {
        $sql = "INSERT INTO SESSION (theme, tarif, nbPlace, planning_id, salle_id)
                VALUES (:theme, :tarif, :nbPlace, :idPlanning, :idSalle)";
    
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([
            "theme" => $theme,
            "tarif" => $tarif,
            "nbPlace" => $nbPlace,
            "idPlanning" => $idPlanning,
            "idSalle" => $idSalle
        ]);
    }

    // Ajouter une activité
    public function insertActivite($libelle, $tarif, $nbPlace) {
        $sql = "INSERT INTO ACTIVITE (libelle, tarif, nbPlace)
                VALUES (:libelle, :tarif, :nbPlace)";
        
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([
            "libelle" => $libelle,
            "tarif" => $tarif,
            "nbPlace" => $nbPlace
        ]);
    }
}
?>

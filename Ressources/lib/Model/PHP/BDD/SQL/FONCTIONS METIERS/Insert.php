<?php
class Insert_SQL {

    // Ajouter un utilisateur
    public static function insertUtilisateur($nom, $prenom, $adresse, $cp, $ville, $mail, $login, $mdp, $idClub) {
        $sql = "INSERT INTO UTILISATEUR (nom, prenom, adresse, cp, ville, mail, login
                mdp, club_id)
                VALUES (:nom, :prenom, :adresse, :cp, :ville, :mail, :login, :mdp, :club_id)";
        
        $stmt = DBPDO::getInstance()->prepare($sql);
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
    public static function insertInscription($idUtilisateur) {
        $sql = "INSERT INTO INSCRIPTION (estValidee, utilisateur_id) 
                VALUES (0, :id)";
        
        $stmt = DBPDO::getInstance()->prepare($sql);
        $stmt->execute(["id" => $idUtilisateur]);
    }

    // Ajouter une participation
    public static function insertParticipation($idInscription, $idActivite) {
        $sql = "INSERT INTO PARTICIPER (idInscription, idActivite) 
                VALUES (:idInscription, :idActivite)";
        
        $stmt = DBPDO::getInstance()->prepare($sql);
        $stmt->execute(["idInscription" => $idInscription, "idActivite" => $idActivite]);
    }

    // Ajouter une inscription
    public static function insertInscriptionSession($idInscription, $idSession) {
        $sql = "INSERT INTO INSCRIRE (idInscription, idSession) 
                VALUES (:idInscription, :idSession)";
        
        $stmt = DBPDO::getInstance()->prepare($sql);
        $stmt->execute(["idInscription" => $idInscription, "idSession" => $idSession]);
    }

    // Ajouter une session
    public static function insertSession($theme, $tarif, $nbPlace, $idPlanning, $idSalle) {
        $sql = "INSERT INTO SESSION (theme, tarif, nbPlace, planning_id, salle_id)
                VALUES (:theme, :tarif, :nbPlace, :idPlanning, :idSalle)";
    
        $stmt = DBPDO::getInstance()->prepare($sql);
        $stmt->execute([
            "theme" => $theme,
            "tarif" => $tarif,
            "nbPlace" => $nbPlace,
            "idPlanning" => $idPlanning,
            "idSalle" => $idSalle
        ]);
    }

    // Ajouter une activité
    public static function insertActivite($libelle, $tarif, $nbPlace) {
    $sql = "INSERT INTO ACTIVITE (libelle, tarif, nbPlace)
            VALUES (:libelle, :tarif, :nbPlace)";
    
    $stmt = DBPDO::getInstance()->prepare($sql);
    $stmt->execute([
            "libelle" => $libelle,
            "tarif" => $tarif,
            "nbPlace" => $nbPlace
        ]);
    }
}
?>
<?php
class Update_SQL {
    // Modifier un utilisateur
    public static function modifierUtilisateur($id, $nom, $prenom, $adresse, $cp, $ville, $mail, $login, $mdp, $idClub) {
        $sql = "UPDATE UTILISATEUR
                SET nom = :nom, prenom = :prenom, adresse = :adresse, cp = :cp, ville = :ville,
                mail = :mail, login = :login, club_id = :idClub
                WHERE idUtilisateur = :id";
        
        $stmt = DBPDO::getInstance()->prepare($sql);
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

    // Modifier une inscription
    public static function validerInscription($idInscription) {
        $sql = "UPDATE INSCRIPTION 
                SET estValidee = 1 WHERE idInscription = :id";
        
        $stmt = DBPDO::getInstance()->prepare($sql);
        $stmt->execute(["id" => $idInscription]);
    }

    // Modifier une activité
    public static function modifierActivite($id, $libelle, $tarif, $nbPlace) {
        $sql = "UPDATE ACTIVITE 
                SET libelle = :libelle, tarif = :tarif, nbPlace = :nbPlace 
                WHERE idActivite = :id";
        
        $stmt = DBPDO::getInstance()->prepare($sql);
        $stmt->execute([
            "id" => $id,
            "libelle" => $libelle,
            "tarif" => $tarif,
            "nbPlace" => $nbPlace
        ]);
    }

    // Modifier une session
    public static function modifierSession($id, $theme, $tarif, $nbPlace, $idPlanning, $idSalle) {
        $sql = "UPDATE SESSION 
                SET theme = :theme, tarif = :tarif, nbPlace = :nbPlace, planning_id = :idPlanning, salle_id = :idSalle
                WHERE idSession = :id";

        $stmt = DBPDO::getInstance()->prepare($sql);
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

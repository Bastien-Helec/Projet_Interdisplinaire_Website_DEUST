<?php
class Delete_SQL {

    // Supprimer une session
    public static function deleteSession($idSession) {
        // idSession clé étrangère dans INSCRIRE
        $sql1 = "DELETE FROM INSCRIRE 
                WHERE idSession = :id";
        
        $stmt1 = DBPDO::getInstance()->prepare($sql1);
        $stmt1->execute(["id" => $idSession]);

        $sql2 = "DELETE FROM SESSION 
                WHERE idSession = :id";
        
        $stmt2 = DBPDO::getInstance()->prepare($sql2);
        $stmt2->execute(["id" => $idSession]);
    }

    // Supprimer une activité
    public static function deleteActivite($idActivite) {
        // idActivite clé étrangère dans PLANIFIER
        $sql1 = "DELETE FROM PLANIFIER
                WHERE activite_id = :id";

        $stmt1 = DBPDO::getInstance()->prepare($sql1);
        $stmt1->execute(["id" => $idActivite]);

        // idActivite clé étrangère dans PARTICIPER
        $sql2 = "DELETE FROM PARTICIPER
                WHERE idActivite = :id";

        $stmt2 = DBPDO::getInstance()->prepare($sql2);
        $stmt2->execute(["id" => $idActivite];)

        $sql3 = "DELETE FROM ACTIVITE 
                WHERE idActivite = :id";
        
        $stmt3 = DBPDO::getInstance()->prepare($sql);
        $stmt3->execute(["id" => $idActivite]);
    }

    // Supprimer une inscription
    public static function deleteInscription($idInscription) {
        // idInscription clé étrangère dans INSCRIRE
        $sql1 = "DELETE FROM INSCRIRE 
                WHERE idInscription = :id";
        
        $stmt1 = DBPDO::getInstance()->prepare($sql1);
        $stmt1->execute(["id" => $idInscription]);

        // idInscription clé étrangère dans PARTICIPER
        $sql2 = "DELETE FROM PARTICIPER
                WHERE idInscription = :id";

        $stmt2 = DBPDO::getInstance()->prepare($sql2);
        $stmt2->execute(["id" => $idInscription];)

        $sql3 = "DELETE FROM INSCRIPTION 
                WHERE idInscription = :id";
        
        $stmt3 = DBPDO::getInstance()->prepare($sql);
        $stmt3->execute(["id" => $idInscription]);
    }

    // Supprimer un utilisateur
    public static function deleteUtilisateur($idUtilisateur) {
        // idUtilisateur clé étrangère dans INSCRIPTION
        $sql1 = "DELETE FROM INSCRIPTION
                WHERE utilisateur_id = :id";

        $stmt1 = DBPDO::getInstance()->prepare($sql1);
        $stmt1->execute($sql1);

        $sql2 = "DELETE FROM UTILISATEUR
                WHERE idUtilisateur = :id";

        $stmt2 = DBPDO::getInstance()->prepare($sql2);
        $stmt2->execute($sql2);
    }
}
?>
<?php
class Select_SQL {

    // Afficher tous les utilisateurs
    public static function tousLesUtilisateurs() {
        $sql = "SELECT UTILISATEUR.idUtilisateur, UTILISATEUR.nom, UTILISATEUR.prenom,
                UTILISATEUR.adresse, UTILISATEUR.cp, UTILISATEUR.ville, UTILISATEUR.mail,
                UTILISATEUR.club_id
                FROM UTILISATEUR";

        $stmt = DBPDO::getInstance()->query($sql);
        return $stmt->fetchAll();
    }

    // Afficher tous les clubs
    public static function tousLesClubs() {
        $sql = "SELECT CLUB.idCLub, CLUB.nom, CLUB.adresse, CLUB.cp, CLUB.ville
                FROM CLUB";

        $stmt = DBPDO::getInstance()->query($sql);
        return $stmt->fetchAll();
    }
    
    // Afficher toutes les sessions + leur planning + salle
    public static function sessionsAvecPlanning() {
        $sql = "SELECT SESSION.idSession, SESSION.theme, SESSION.tarif, SESSION.nbPlace, PLANNING.date,
                PLANNING.estMatin, SALLE.nom as Salle
                FROM SESSION
                JOIN PLANNING ON SESSION.planning_id = PLANNING.idPlanning
                JOIN SALLE ON SESSION.salle_id = SALLE.idSalle";
        
        $stmt = DBPDO::getInstance()->query($sql);
        return $stmt->fetchAll();
    }

    // Afficher toutes les sessions 
    public static function toutesLesSessions() {
        $sql = "SELECT SESSION.idSession, SESSION.theme, SESSION.tarif, SESSION.nbPlace
                FROM SESSION";
        
        $stmt = DBPDO::getInstance()->query($sql);
        return $stmt->fetchAll();
    }

    // Afficher toutes les activités + leur planning
    public static function activitesAvecPlanning() {
        $sql = "SELECT ACTIVITE.idActivite, ACTIVITE.libelle, ACTIVITE.tarif, ACTIVITE.nbPlace, PLANNING.date,
                PLANNING.estMatin
                FROM ACTIVITE
                JOIN PLANIFIER on ACTIVITE.idActivite = PLANIFIER.idActivite
                JOIN PLANNING on PLANIFIER.idPlanning = PLANNING.idPlanning";

        $stmt = DBPDO::getInstance()->query($sql);
        return $stmt->fetchAll();
    }

    // Afficher toutes les activités
    public static function toutesLesActivites() {
        $sql = "SELECT ACTIVITE.idActivite, ACTIVITE.libelle, ACTIVITE.tarif, ACTIVITE.nbPlace
                FROM ACTIVITE";

        $stmt = DBPDO::getInstance()->query($sql);
        return $stmt->fetchAll();
    }

    // Vérifie si l'utilisateur a déjà une inscription
    public static function inscriptionExiste($idUtilisateur) {
        $sql = "SELECT UTILISATEUR.idUtilisateur, UTILISATEUR.nom, UTILISATEUR.prenom, INSCRIPTION.estValidee, 
                FROM UTILISATEUR
                JOIN INSCRIPTION on UTILISATEUR.idUtilisateur = INSCRIPTION.utilisateur_id
                WHERE UTILISATEUR.idUtilisateur = :id";

        $stmt = DBPDO::getInstance()->prepare($sql);
        $stmt->execute(["id" => $idUtilisateur]);
        return $stmt->fetchAll();
    }

    // Liste des sessions où il reste des places
    public static function sessionsDisponibles() {
        $sql = "SELECT SESSION.idSession, SESSION.theme, SESSION.tarif, SESSION.nbPlace, PLANNING.date, PLANNING.estMatin
                FROM SESSION
                JOIN PLANNING on SESSION.planning_id = PLANNING.idPlanning
                LEFT JOIN INSCRIRE on SESSION.idSession = INSCRIRE.idSession
                GROUP BY SESSION.idSession
                HAVING COUNT(INSCRIRE.idInscription) < SESSION.nbPlace";

        $stmt = DBPDO::getInstance()->query($sql);
        return $stmt->fetchAll();
    }

    // Liste des activités où il reste des places
    public static function activitesDisponibles() {
        $sql = "SELECT ACTIVITE.idActivite, ACTIVITE.libelle, ACTIVITE.tarif, ACTIVITE.nbPlace, PLANNING.date,
                PLANNING.estMatin
                FROM ACTIVITE
                LEFT JOIN PARTICIPER on ACTIVITE.idActivite = PARTICIPER.idActivite
                JOIN PLANIFIER on ACTIVITE.idActivite = PLANIFIER.activite_id
                JOIN PLANNING on PLANIFIER.planning_id = PLANNING.idPlanning
                GROUP BY ACTIVITE.idActivite
                HAVING COUNT(PARTICIPER.idInscription) < ACTIVITE.nbPlace";

        $stmt = DBPDO::getInstance()->query($sql);
        return $stmt->fetchAll();
    }

    // Nombre d’inscrits / places restantes par session
    public static function statsSessions() {
        $sql = "SELECT SESSION.idSession, SESSION.theme, SESSION.tarif,
                SESSION.nbPlace - COUNT(INSCRIRE.idInscription) as nbPlacesRestantes, 
                PLANNING.date, PLANNING.estMatin, SALLE.nom
                FROM SESSION
                JOIN PLANNING on SESSION.planning_id = PLANNING.idPlanning
                JOIN SALLE on SESSION.salle_id = SALLE.idSalle
                LEFT JOIN INSCRIRE on SESSION.idSession = INSCRIRE.idSession
                GROUP BY SESSION.idSession";

        $stmt = DBPDO::getInstance()->query($sql);
        return $stmt->fetchAll();
    }

    // Nombre d’inscrits / places restantes par activité
    public static function statsActivites() {
        $sql = "SELECT ACTIVITE.idActivite, ACTIVITE.libelle, ACTIVITE.tarif,
                ACTIVITE.nbPlace - COUNT(PARTICIPER.idInscription) as nbInscrit, PLANNING.date, PLANNING.estMatin
                FROM ACTIVITE
                LEFT JOIN PARTICIPER on ACTIVITE.idActivite = PARTICIPER.idActivite
                JOIN PLANIFIER on ACTIVITE.idActivite = PLANIFIER.activite_id
                JOIN PLANNING on PLANIFIER.planning_id = PLANNING.idPlanning
                GROUP BY ACTIVITE.idActivite";

        $stmt = DBPDO::getInstance()->query($sql);
        return $stmt->fetchAll();
    }

    // Liste des utilisateurs inscrits à une session donnée
    public static function participantsSession($idSession) {
        $sql = "SELECT UTILISATEUR.idUtilisateur, UTILISATEUR.nom, UTILISATEUR.prenom, UTILISATEUR.mail
                FROM INSCRIRE
                JOIN INSCRIPTION ON INSCRIRE.idInscription = INSCRIPTION.idInscription
                JOIN UTILISATEUR ON INSCRIPTION.utilisateur_id = UTILISATEUR.idUtilisateur
                WHERE INSCRIRE.idSession = :id";

        $stmt = DBPDO::getInstance()->prepare($sql);
        $stmt->execute(["id" => $idSession]);
        return $stmt->fetchAll();
    }

    // Liste des utilisateurs inscrits à une activité donnée
    public static function participantsActivite($idActivite) {
        $sql = "SELECT UTILISATEUR.idUtilisateur, UTILISATEUR.nom, UTILISATEUR.prenom, UTILISATEUR.mail
                FROM PARTICIPER
                JOIN INSCRIPTION on PARTICIPER.idInscription = INSCRIPTION.idInscription
                JOIN UTILISATEUR on INSCRIPTION.utilisateur_id = UTILISATEUR.idUtilisateur
                WHERE PARTICIPER.idActivite = :id";

        $stmt = DBPDO::getInstance()->prepare($sql);
        $stmt->execute(["id" => $idActivite]);
        return $stmt->fetchAll();
    }
}
?>
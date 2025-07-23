<?php
class Select_SQL {
    private PDO $pdo;

    public function __construct(PDO $pdo) {
        $this->pdo = $pdo;
    }

    public function tousLesUtilisateurs() {
        $sql = "SELECT idUtilisateur, nom, prenom, adresse, cp, ville, mail, club_id FROM UTILISATEUR";
        return $this->pdo->query($sql)->fetchAll();
    }

    public function tousLesClubs() {
        $sql = "SELECT idClub, nom, adresse, cp, ville FROM CLUB";
        return $this->pdo->query($sql)->fetchAll();
    }

    public function sessionsAvecPlanning() {
        $sql = "SELECT s.idSession, s.theme, s.tarif, s.nbPlace, p.date, p.estMatin, sa.nom AS Salle
                FROM SESSION s
                JOIN PLANNING p ON s.planning_id = p.idPlanning
                JOIN SALLE sa ON s.salle_id = sa.idSalle";
        return $this->pdo->query($sql)->fetchAll();
    }

    public function toutesLesSessions() {
        $sql = "SELECT idSession, theme, tarif, nbPlace FROM SESSION";
        return $this->pdo->query($sql)->fetchAll();
    }

    public function activitesAvecPlanning() {
        $sql = "SELECT a.idActivite, a.libelle, a.tarif, a.nbPlace, p.date, p.estMatin
                FROM ACTIVITE a
                JOIN PLANIFIER pl ON a.idActivite = pl.idActivite
                JOIN PLANNING p ON pl.idPlanning = p.idPlanning";
        return $this->pdo->query($sql)->fetchAll();
    }

    public function toutesLesActivites() {
        $sql = "SELECT idActivite, libelle, tarif, nbPlace FROM ACTIVITE";
        return $this->pdo->query($sql)->fetchAll();
    }

    public function inscriptionExiste($idUtilisateur) {
        $sql = "SELECT u.idUtilisateur, u.nom, u.prenom, i.estValidee
                FROM UTILISATEUR u
                JOIN INSCRIPTION i ON u.idUtilisateur = i.utilisateur_id
                WHERE u.idUtilisateur = :id";

        $stmt = $this->pdo->prepare($sql);
        $stmt->execute(["id" => $idUtilisateur]);
        return $stmt->fetchAll();
    }

    public function sessionsDisponibles() {
        $sql = "SELECT s.idSession, s.theme, s.tarif, s.nbPlace, p.date, p.estMatin
                FROM SESSION s
                JOIN PLANNING p ON s.planning_id = p.idPlanning
                LEFT JOIN INSCRIRE i ON s.idSession = i.idSession
                GROUP BY s.idSession
                HAVING COUNT(i.idInscription) < s.nbPlace";
        return $this->pdo->query($sql)->fetchAll();
    }

    public function activitesDisponibles() {
        $sql = "SELECT a.idActivite, a.libelle, a.tarif, a.nbPlace, p.date, p.estMatin
                FROM ACTIVITE a
                LEFT JOIN PARTICIPER pa ON a.idActivite = pa.idActivite
                JOIN PLANIFIER pl ON a.idActivite = pl.activite_id
                JOIN PLANNING p ON pl.planning_id = p.idPlanning
                GROUP BY a.idActivite
                HAVING COUNT(pa.idInscription) < a.nbPlace";
        return $this->pdo->query($sql)->fetchAll();
    }

    public function statsSessions() {
        $sql = "SELECT s.idSession, s.theme, s.tarif,
                       s.nbPlace - COUNT(i.idInscription) AS nbPlacesRestantes,
                       p.date, p.estMatin, sa.nom
                FROM SESSION s
                JOIN PLANNING p ON s.planning_id = p.idPlanning
                JOIN SALLE sa ON s.salle_id = sa.idSalle
                LEFT JOIN INSCRIRE i ON s.idSession = i.idSession
                GROUP BY s.idSession";
        return $this->pdo->query($sql)->fetchAll();
    }

    public function statsActivites() {
        $sql = "SELECT a.idActivite, a.libelle, a.tarif,
                       a.nbPlace - COUNT(pa.idInscription) AS nbInscrit,
                       p.date, p.estMatin
                FROM ACTIVITE a
                LEFT JOIN PARTICIPER pa ON a.idActivite = pa.idActivite
                JOIN PLANIFIER pl ON a.idActivite = pl.activite_id
                JOIN PLANNING p ON pl.planning_id = p.idPlanning
                GROUP BY a.idActivite";
        return $this->pdo->query($sql)->fetchAll();
    }

    public function participantsSession($idSession) {
        $sql = "SELECT u.idUtilisateur, u.nom, u.prenom, u.mail
                FROM INSCRIRE i
                JOIN INSCRIPTION ins ON i.idInscription = ins.idInscription
                JOIN UTILISATEUR u ON ins.utilisateur_id = u.idUtilisateur
                WHERE i.idSession = :id";

        $stmt = $this->pdo->prepare($sql);
        $stmt->execute(["id" => $idSession]);
        return $stmt->fetchAll();
    }

    public function participantsActivite($idActivite) {
        $sql = "SELECT u.idUtilisateur, u.nom, u.prenom, u.mail
                FROM PARTICIPER p
                JOIN INSCRIPTION i ON p.idInscription = i.idInscription
                JOIN UTILISATEUR u ON i.utilisateur_id = u.idUtilisateur
                WHERE p.idActivite = :id";

        $stmt = $this->pdo->prepare($sql);
        $stmt->execute(["id" => $idActivite]);
        return $stmt->fetchAll();
    }
}
?>

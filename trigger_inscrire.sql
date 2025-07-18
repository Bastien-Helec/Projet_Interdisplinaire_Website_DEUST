--Trigger pour empecher une inscription si l'utilisateur participe déjà à une activité au même moment
DELIMITER $

CREATE TRIGGER trg_check_conflit_activite
BEFORE INSERT ON INSCRIRE
FOR EACH ROW
BEGIN
    DECLARE v_utilisateur_id INT;
    DECLARE v_date DATE;
    DECLARE v_estMatin BOOLEAN;

    SELECT utilisateur_id INTO v_utilisateur_id
    FROM INSCRIPTION
    WHERE idInscription = NEW.idInscription;

    SELECT PLANNING.date, PLANNING.estMatin INTO v_date, v_estMatin
    FROM SESSION
    JOIN PLANNING ON SESSION.planning_id = PLANNING.idPlanning
    WHERE SESSION.idSession = NEW.idSession;

    IF EXISTS (
        SELECT *
        FROM INSCRIPTION
        JOIN PARTICIPER ON INSCRIPTION.idInscription = PARTICIPER.idInscription
        JOIN PLANIFIER ON PARTICIPER.idActivite = PLANIFIER.activite_id
        JOIN PLANNING ON PLANIFIER.planning_id = PLANNING.idPlanning
        WHERE INSCRIPTION.utilisateur_id = v_utilisateur_id
          AND PLANNING.date = v_date
          AND PLANNING.estMatin = v_estMatin
    ) THEN
        SIGNAL SQLSTATE '45000'
        SET MESSAGE_TEXT = 'Vous êtes déjà inscrit à une activité à ce moment.';
    END IF;
END; $
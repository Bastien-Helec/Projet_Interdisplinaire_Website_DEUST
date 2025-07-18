--Trigger pour empêcher une participation si un utilisateur est déjà inscrit à une session au même moment
DELIMITER $

CREATE TRIGGER trg_check_conflit_session
BEFORE INSERT ON PARTICIPER
FOR EACH ROW
BEGIN
    DECLARE v_utilisateur_id INT;
    DECLARE v_date DATE;
    DECLARE v_estMatin BOOLEAN;

    SELECT utilisateur_id INTO v_utilisateur_id
    FROM INSCRIPTION
    WHERE idInscription = NEW.idInscription;

    
    SELECT PLANNING.date, PLANNING.estMatin INTO v_date, v_estMatin
    FROM PLANIFIER
    JOIN PLANNING ON PLANIFIER.planning_id = PLANNING.idPlanning
    WHERE PLANIFIER.activite_id = NEW.idActivite;

    IF EXISTS (
        SELECT *
        FROM INSCRIPTION 
        JOIN INSCRIRE ON INSCRIPTION.idInscription = INSCRIRE.idInscription
        JOIN SESSION ON SESSION.idSession = INSCRIRE.idSession
        JOIN PLANNING ON SESSION.idPlanning = PLANNING.planning_id
        WHERE INSCRIPTION.utilisateur_id = v_utilisateur_id
          AND PLANNING.date = v_date
          AND PLANNING.estMatin = v_estMatin
    ) THEN
        SIGNAL SQLSTATE '45000'
        SET MESSAGE_TEXT = 'Vous êtes déjà inscrit à une session à ce moment.';
    END IF;
END; $
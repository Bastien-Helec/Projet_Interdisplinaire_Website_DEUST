USE congres;
-- Jeu d'essai
-- Salles
INSERT INTO SALLE (nom)
VALUES
('Salle Méditerranée'),
('Salle Atlantique'),
('Salle Amazonie'),
('Salle Pacifique'),
('Salle Oceanie'),
('Salle Everest');

-- Clubs
INSERT INTO CLUB (nom, adresse, cp, ville)
VALUES
('Elan Sante', '12 rue Trinité', '33000', 'Bordeaux'),
('Sport Senior', '112 avenue Lenoir', '69000', 'Lyon'),
('Vie Action', '29 avenue Manin', '31000', 'Toulouse');

-- Utilisateurs 
INSERT INTO UTILISATEUR (nom, prenom, adresse, cp, ville, mail, login, mdp, estAdmin, club_id)
VALUES
('Dupont', 'Alice', '1 rue Santé', '31000', 'Toulouse', 'alice@example.com', 'dalice', 'pass123', FALSE, 3),
('Martin', 'Bob', '2 avenue Forme', '69000', 'Lyon', 'bob@example.com', 'mbob', 'pass456', FALSE, 2),
('Michel', 'Jean', '3 allée Martyr', '75000', 'Paris', 'jean@example.com', 'mjean', 'adminpass', TRUE, NULL), -- Admin sans club
('Rodin', 'Fred', '7 boulevard Lilas', '33000', 'Bordeaux', 'fred@example.com', 'rfred', 'pass789', FALSE, 1);

-- Planning
INSERT INTO PLANNING (date, estMatin)
VALUES 
('21-07-25', TRUE), -- id 1
('21-07-25', FALSE), -- id 2
('22-07-25', TRUE), -- id 3
('22-07-25', FALSE), -- id 4
('23-07-25', TRUE), -- id 5
('23-07-25', FALSE), -- id 6
('24-07-25', TRUE), -- id 7
('24-07-25', FALSE), -- id 8
('25-07-25', TRUE), -- id 9
('25-07-25', FALSE); -- id 10

-- Sessions
INSERT INTO SESSION (theme, tarif, nbPlace, salle_id, planning_id)
VALUES
('Bien etre au travail', 25.00, 30, 1, 1), -- 21/07 matin
('Nutrition et performance', 30.00, 40, 4, 2), -- 21/07 après midi
('Prevention des blessures', 20.00, 25, 5, 3), -- 22/07 matin
('Gestion du stress', 35.00, 60, 2, 4), -- 22/07 après midi
('Sport en entreprise', 27.00, 35, 3, 5); -- 23/07 matin

-- Activites
INSERT INTO ACTIVITE (libelle, tarif, nbPlace)
VALUES
('Atelier yoga', 18.00, 15),
('Marche nordique', 20.00, 30),
('Atelier nutrition', 25.00, 15),
('Atelier posture au travail', 18.00, 20),
('Tennis', 19.00, 16);

-- Planifier
INSERT INTO PLANIFIER
VALUES
(1, 2), -- Atelier yoga, 21/07 après midi
(2, 3), -- Marche nordique, 22/07 matin
(3, 6), -- Atelier nutrition, 23/07 après midi
(4, 7), -- Atelier posture au travail, 24/07 matin
(5, 10); -- Tennis, 25/07 après midi

-- Inscriptions
INSERT INTO INSCRIPTION (estValidee, utilisateur_id)
VALUES
(TRUE, 1), -- Alice
(TRUE, 2), -- Bob
(TRUE, 4); -- Fred

-- Inscrire
INSERT INTO INSCRIRE (idInscription, idSession)
VALUES
(1, 1), -- Alice, session 'Bien etre au travail' 21/07 matin
(1, 3), -- Alice, session 'Prevention des blessures' 22/07 matin
(2, 4), -- Bob, session 'Gestion du stress' 22/07 après midi
(3, 5), -- Fred, session 'Sport en entreprise' 23/07 matin
(3, 1); -- Fred, session 'Bien etre au travail' 21/07 matin

-- Participer
INSERT INTO PARTICIPER (idInscription, idActivite)
VALUES
(1, 3), -- Alice, 'Atelier nutrition' 23/07 après midi
(2, 1), -- Bob, 'Atelier yoga' 21/07 après midi
(2, 3), -- Bob, 'Atelier nutrition' 23/07 après midi
(2, 5), -- Bob, 'Tennis' 25/07 après midi
(3, 2); -- Fred, 'Marche nordique' 22/07 matin

/*
-- Conflits pour tester les triggers
INSERT INTO ACTIVITE (libelle, tarif, nbPlace)
VALUES
('Atelier massage', 60.00, 10);

INSERT INTO PLANIFIER (activite_id, planning_id)
VALUES
(6, 1); -- Atelier massage 21/07 matin

INSERT INTO PARTICIPER (idInscription, idActivite)
VALUES
(1, 6); -- Alice est inscrite à 'Bien être au travail' le 21/07 matin, donc ne peut pas participer à l'atelier massage

INSERT INTO SESSION (theme, tarif, nbPlace, salle_id, planning_id)
VALUES
('La cuisine en hiver', 27.00, 20, 6, 6); -- Session 'La cuisine en hiver' 23/07 après midi

INSERT INTO INSCRIRE (idInscription, idSession)
VALUES
(2, 6); -- Bob participe à l'atelier nutrition  le 23/07 après midi, donc ne pas assister à la session 'La cuisine en hiver'
*/
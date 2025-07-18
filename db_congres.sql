-- Creation de la base de données
DROP DATABASE IF EXISTS congres;
CREATE DATABASE congres DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE congres;

--Table club
CREATE TABLE CLUB (
    idClub INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(100) NOT NULL,
    adresse VARCHAR(150),
    cp CHAR(5),
    ville VARCHAR(100)
);

--Table utilisateur
CREATE TABLE UTILISATEUR (
    idUtilisateur INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(50),
    prenom VARCHAR(50),
    adresse VARCHAR(150),
    cp CHAR(5),
    ville VARCHAR(100),
    mail VARCHAR(100),
    login VARCHAR(50),
    mdp VARCHAR(255),
    club_id INT,
    FOREIGN KEY (club_id) REFERENCES CLUB(idClub)
);

--Table inscription
CREATE TABLE INSCRIPTION (
    idInscription INT AUTO_INCREMENT PRIMARY KEY,
    estValidee BOOLEAN DEFAULT FALSE,
    utilisateur_id INT UNIQUE,
    FOREIGN KEY (utilisateur_id) REFERENCES UTILISATEUR(idUtilisateur)
);

--Table salle
CREATE TABLE SALLE (
    idSalle INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(100)
);

--Table planning
CREATE TABLE PLANNING (
    idPlanning INT AUTO_INCREMENT PRIMARY KEY,
    date DATE,
    estMatin BOOLEAN
);

--Table session
CREATE TABLE SESSION (
    idSession INT AUTO_INCREMENT PRIMARY KEY,
    theme VARCHAR(150),
    tarif DECIMAL(6,2),
    nbPlace INT,
    salle_id INT,
    planning_id INT,
    FOREIGN KEY (salle_id) REFERENCES SALLE(idSalle),
    FOREIGN KEY (planning_id) REFERENCES PLANNING(idPlanning),
    UNIQUE (salle_id, planning_id)
);

--Table activite
CREATE TABLE ACTIVITE (
    idActivite INT AUTO_INCREMENT PRIMARY KEY,
    libelle VARCHAR(150),
    tarif DECIMAL(6,2),
    nbPlace INT
);

--Table planifier
CREATE TABLE PLANIFIER (
    activite_id INT,
    planning_id INT,
    PRIMARY KEY (activite_id, planning_id),
    FOREIGN KEY (activite_id) REFERENCES ACTIVITE(idActivite),
    FOREIGN KEY (planning_id) REFERENCES PLANNING(idPlanning)
);

--Table inscrire
CREATE TABLE INSCRIRE (
    idInscription INT,
    idSession INT,
    PRIMARY KEY (idInscription, idSession),
    FOREIGN KEY (idInscription) REFERENCES INSCRIPTION(idInscription),
    FOREIGN KEY (idSession) REFERENCES SESSION(idSession)
);

--Table participer
CREATE TABLE PARTICIPER (
    idInscription INT,
    idActivite INT,
    PRIMARY KEY (idInscription, idActivite),
    FOREIGN KEY (idInscription) REFERENCES INSCRIPTION(idInscription),
    FOREIGN KEY (idActivite) REFERENCES ACTIVITE(idActivite)
);
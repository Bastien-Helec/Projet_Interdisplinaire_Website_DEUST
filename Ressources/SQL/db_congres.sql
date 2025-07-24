-- Creation de la base de données
DROP DATABASE IF EXISTS congres;
CREATE DATABASE congres DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE congres;

-- Table club
CREATE TABLE CLUB (
    idClub INT AUTO_INCREMENT,
    nom VARCHAR(100) NOT NULL,
    adresse VARCHAR(150),
    cp CHAR(5),
    ville VARCHAR(100),
    CONSTRAINT pk_club PRIMARY KEY (idClub)
) ENGINE=InnoDB;

-- Table utilisateur
CREATE TABLE UTILISATEUR (
    idUtilisateur INT AUTO_INCREMENT,
    nom VARCHAR(50),
    prenom VARCHAR(50),
    adresse VARCHAR(150),
    cp CHAR(5),
    ville VARCHAR(100),
    mail VARCHAR(100),
    login VARCHAR(50),
    mdp VARCHAR(255),
    estAdmin BOOLEAN DEFAULT FALSE,
    club_id INT,
    CONSTRAINT pk_utilisateur PRIMARY KEY (idUtilisateur),
    CONSTRAINT fk_club_utilisateur FOREIGN KEY (club_id) REFERENCES CLUB(idClub)
) ENGINE=InnoDB;

-- Table inscription
CREATE TABLE INSCRIPTION (
    idInscription INT AUTO_INCREMENT,
    estValidee BOOLEAN DEFAULT FALSE,
    utilisateur_id INT UNIQUE,
    CONSTRAINT pk_inscription PRIMARY KEY (idInscription),
    CONSTRAINT fk_utilisateur_inscription FOREIGN KEY (utilisateur_id) REFERENCES UTILISATEUR(idUtilisateur)
) ENGINE=InnoDB;

-- Table salle
CREATE TABLE SALLE (
    idSalle INT AUTO_INCREMENT,
    nom VARCHAR(100),
    CONSTRAINT pk_salle PRIMARY KEY (idSalle)
) ENGINE=InnoDB;

-- Table planning
CREATE TABLE PLANNING (
    idPlanning INT AUTO_INCREMENT,
    date DATE,
    estMatin BOOLEAN,
    CONSTRAINT pk_planning PRIMARY KEY (idPlanning)
) ENGINE=InnoDB;

-- Table session
CREATE TABLE SESSION (
    idSession INT AUTO_INCREMENT,
    theme VARCHAR(150),
    tarif DECIMAL(6,2),
    nbPlace INT,
    salle_id INT,
    planning_id INT,
    CONSTRAINT pk_session PRIMARY KEY (idSession),
    CONSTRAINT fk_salle_session FOREIGN KEY (salle_id) REFERENCES SALLE(idSalle),
    CONSTRAINT fk_planning_session FOREIGN KEY (planning_id) REFERENCES PLANNING(idPlanning),
    CONSTRAINT un_salle_planning_session UNIQUE (salle_id, planning_id)
) ENGINE=InnoDB;

-- Table activite
CREATE TABLE ACTIVITE (
    idActivite INT AUTO_INCREMENT,
    libelle VARCHAR(150),
    tarif DECIMAL(6,2),
    nbPlace INT,
    CONSTRAINT pk_activite PRIMARY KEY (idActivite)
) ENGINE=InnoDB;

-- Table planifier
CREATE TABLE PLANIFIER (
    activite_id INT,
    planning_id INT,
    CONSTRAINT pk_planifier PRIMARY KEY (activite_id, planning_id),
    CONSTRAINT fk_activite_planifier FOREIGN KEY (activite_id) REFERENCES ACTIVITE(idActivite),
    CONSTRAINT fk_planning_planifier FOREIGN KEY (planning_id) REFERENCES PLANNING(idPlanning)
) ENGINE=InnoDB;

-- Table inscrire
CREATE TABLE INSCRIRE (
    idInscription INT,
    idSession INT,
    CONSTRAINT pk_inscrire PRIMARY KEY (idInscription, idSession),
    CONSTRAINT fk_inscription_inscrire FOREIGN KEY (idInscription) REFERENCES INSCRIPTION(idInscription),
    CONSTRAINT fk_session_inscrire FOREIGN KEY (idSession) REFERENCES SESSION(idSession)
) ENGINE=InnoDB;

-- Table participer
CREATE TABLE PARTICIPER (
    idInscription INT,
    idActivite INT,
    CONSTRAINT pk_participer PRIMARY KEY (idInscription, idActivite),
    CONSTRAINT fk_inscription_participer FOREIGN KEY (idInscription) REFERENCES INSCRIPTION(idInscription),
    CONSTRAINT fk_activite_participer FOREIGN KEY (idActivite) REFERENCES ACTIVITE(idActivite)
) ENGINE=InnoDB;
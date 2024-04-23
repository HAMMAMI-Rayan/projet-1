CREATE TABLE utilisateurs (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nom_utilisateur VARCHAR(50) UNIQUE NOT NULL,
    mot_de_passe VARCHAR(255) NOT NULL,
    role ENUM('administrateur', 'utilisateur') NOT NULL
);

CREATE TABLE art_martial(
   id INT,
   nom VARCHAR(50),
   image VARCHAR(50),
   PRIMARY KEY(id)
);

CREATE TABLE categorie(
   id INT,
   nom VARCHAR(50),
   poids INT NOT NULL,
   PRIMARY KEY(id)
);

CREATE TABLE Combattant(
   id INT,
   nom VARCHAR(50),
   prenom VARCHAR(50),
   poids INT NOT NULL,
   taille INT,
   origine VARCHAR(50),
   dateNaissance DATE,
   nbDeVictoir INT,
   nbDeVictoirParSoumission INT,
   nbDeDefaite INT,
   id_1 INT NOT NULL,
   PRIMARY KEY(id),
   FOREIGN KEY(id_1) REFERENCES categorie(id)
);

CREATE TABLE critiquer(
   id INT,
   commentaire VARCHAR(50),
   id_1 INT NOT NULL,
   PRIMARY KEY(id),
   FOREIGN KEY(id_1) REFERENCES Combattant(id)
);

CREATE TABLE pratiquer(
   id INT,
   id_1 INT,
   PRIMARY KEY(id, id_1),
   FOREIGN KEY(id) REFERENCES Combattant(id),
   FOREIGN KEY(id_1) REFERENCES art_martial(id)
);

INSERT INTO Combattant VALUES (1, 'McGregor', 'Conor', 155, 175, 'Irlande', '1988-07-14', 22, 5, 6, 1);
INSERT INTO Combattant VALUES (2, 'Nurmagomedov', 'Khabib', 170, 178, 'Russie', '1988-09-20', 29, 10, 0, 1);
INSERT INTO Combattant VALUES (3, 'Makhachev', 'Islam', 155, 177, 'Russie', '1991-09-27', 21, 10, 2, 1);
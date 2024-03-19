CREATE TABLE utilisateurs (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nom_utilisateur VARCHAR(50) UNIQUE NOT NULL,
    mot_de_passe VARCHAR(255) NOT NULL,
    role ENUM('administrateur', 'utilisateur') NOT NULL
);

CREATE TABLE art_marcial(
   id INT,
   nom VARCHAR(50),
   image VARCHAR(50),
   PRIMARY KEY(id)
);

CREATE TABLE categorie(
   id INT,
   poids INT,
   nom VARCHAR(50),
   PRIMARY KEY(id, poids)
);

CREATE TABLE critiquer(
   id INT,
   commentaire VARCHAR(50),
   PRIMARY KEY(id)
);

CREATE TABLE technique(
   id INT,
   nom VARCHAR(50),
   id_1 INT NOT NULL,
   PRIMARY KEY(id),
   FOREIGN KEY(id_1) REFERENCES art_marcial(id)
);

CREATE TABLE Combattant(
   id INT,
   poids INT,
   nom VARCHAR(50),
   prenom VARCHAR(50),
   tails INT,
   origine VARCHAR(50),
   age INT,
   Nombre_de_victoir INT,
   Nombre_de_victoir_par_soumition INT,
   Nombre_de_défaite INT,
   id_1 INT NOT NULL,
   poids_1 INT NOT NULL,
   PRIMARY KEY(id, poids),
   FOREIGN KEY(id_1, poids_1) REFERENCES categorie(id, poids)
);

CREATE TABLE pratiquer(
   id INT,
   poids INT,
   id_1 INT,
   PRIMARY KEY(id, poids, id_1),
   FOREIGN KEY(id, poids) REFERENCES Combattant(id, poids),
   FOREIGN KEY(id_1) REFERENCES art_marcial(id)
);

CREATE TABLE commentair(
   id INT,
   poids INT,
   id_1 INT,
   PRIMARY KEY(id, poids, id_1),
   FOREIGN KEY(id, poids) REFERENCES Combattant(id, poids),
   FOREIGN KEY(id_1) REFERENCES critiquer(id)
);

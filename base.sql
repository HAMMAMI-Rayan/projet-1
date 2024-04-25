CREATE TABLE utilisateurs (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nom_utilisateur VARCHAR(50) UNIQUE NOT NULL,
    adressMail VARCHAR(255) UNIQUE NOT NULL,
    mot_de_passe VARCHAR(255) NOT NULL,
    role ENUM('administrateur', 'utilisateur') NOT NULL
);

CREATE TABLE art_martial(
   nomArtMartial VARCHAR(50) PRIMARY KEY
);

INSERT INTO art_martial VALUES ("KickBoxing");
INSERT INTO art_martial VALUES ("Sambo");




CREATE TABLE categorie(
   CategorieCombattant VARCHAR(50) PRIMARY KEY,
   poids INT NOT NULL
);

INSERT INTO categorie VALUES ("Léger" , 70);



CREATE TABLE Combattant(
   id INT PRIMARY KEY,
   nom VARCHAR(50),
   prenom VARCHAR(50),
   age INT NOT NULL ,
   poids INT NOT NULL,
   taille INT,
   origine VARCHAR(50),
   nomArtMartial VARCHAR(50),
   CategorieCombattant VARCHAR(50),
   Bilan VARCHAR(100),
   FOREIGN KEY (nomArtMartial) REFERENCES art_martial(nomArtMartial),
   FOREIGN KEY (CategorieCombattant) REFERENCES categorie(CategorieCombattant)
);

INSERT INTO Combattant VALUES (1, 'McGregor', 'Conor', 35, 155, 175, 'Irlande', "KickBoxing" ,"Léger",'19-1-1');
INSERT INTO Combattant VALUES (2, 'Nurmagomedov', 'Khabib', 35, 170, 178, 'Russie', "Sambo" , "Léger", '29-0-0');
INSERT INTO Combattant VALUES (3, 'Makhachev', 'Islam', 32, 155, 177, 'Russie', "Sambo" , "Léger" , '25-1-0');

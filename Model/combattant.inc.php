<?php
$serveur = "ec2-3-95-15-204.compute-1.amazonaws.com";
$utilisateur = "root";
$mot_de_passe = "";
$base_de_donnees = "MMA";

$connexion = mysqli_connect($serveur, $utilisateur, $mot_de_passe, $base_de_donnees);

if (!$connexion) {
    die("La connexion à la base de données a échoué : " . mysqli_connect_error());
}

// Requête SQL pour récupérer les données des combattants avec leurs catégories et arts martiaux
$requete = "SELECT c.id, c.nom, c.prenom, c.age, c.poids, c.taille, c.origine, c.Bilan, a.nomArtMartial AS nom_art_martial, cat.CategorieCombattant AS categorie_combattant
            FROM Combattant c
            INNER JOIN art_martial a ON c.nomArtMartial = a.nomArtMartial
            INNER JOIN categorie cat ON c.CategorieCombattant = cat.CategorieCombattant";

$resultat = mysqli_query($connexion, $requete);

if (!$resultat) {
    die("Erreur lors de l'exécution de la requête : " . mysqli_error($connexion));
}
?>

<?php
$serveur = "localhost";
$utilisateur = "root";
$mot_de_passe = "";
$base_de_donnees = "MMA";

$connexion = mysqli_connect($serveur, $utilisateur, $mot_de_passe, $base_de_donnees);

if (!$connexion) {
    die("La connexion à la base de données a échoué : " . mysqli_connect_error());
}

// Requête SQL pour récupérer les données des combattant avec leurs catégories et arts martiaux
$requete = "SELECT c.id, c.nom, c.prenom, c.age, c.poids, c.taille, c.origine, c.Bilan, a.nomArtMartial AS nom_art_martial, cat.CategorieCombattant AS categorie_combattant
            FROM Combattant c
            INNER JOIN art_martial a ON c.nomArtMartial = a.nomArtMartial
            INNER JOIN categorie cat ON c.CategorieCombattant = cat.CategorieCombattant";

$resultat = mysqli_query($connexion, $requete);

if (!$resultat) {
    die("Erreur lors de l'exécution de la requête : " . mysqli_error($connexion));
}

// Fonction pour ajouter un combattant
function ajouterCombattant($connexion, $nom, $prenom, $age, $poids, $taille, $origine, $bilan, $art_martial) {
    $sql = "INSERT INTO combattant (nom, prenom, age, poids, taille, origine, bilan, nomArtMartial) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = mysqli_prepare($connexion, $sql);
    mysqli_stmt_bind_param($stmt, "ssiissss", $nom, $prenom, $age, $poids, $taille, $origine, $bilan, $art_martial);
    return mysqli_stmt_execute($stmt);
}

// Fonction pour modifier un combattant
function modifierCombattant($connexion, $id, $nom, $prenom, $age, $poids, $taille, $origine, $bilan, $art_martial) {
    $sql = "UPDATE combattant SET nom=?, prenom=?, age=?, poids=?, taille=?, origine=?, bilan=?, nomArtMartial=? WHERE id=?";
    $stmt = mysqli_prepare($connexion, $sql);
    mysqli_stmt_bind_param($stmt, "ssiissssi", $nom, $prenom, $age, $poids, $taille, $origine, $bilan, $art_martial, $id);
    return mysqli_stmt_execute($stmt);
}

// Fonction pour supprimer un combattant
function supprimerCombattant($connexion, $id) {
    $sql = "DELETE FROM combattant WHERE id = ?";
    $stmt = mysqli_prepare($connexion, $sql);
    mysqli_stmt_bind_param($stmt, "i", $id);
    return mysqli_stmt_execute($stmt);
}
?>

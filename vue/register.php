<?php
// Connexion à la base de données
$serveur = "localhost";
$utilisateur = "root";
$mot_de_passe = "";
$base_de_donnees = "mma";

$connexion = mysqli_connect($serveur, $utilisateur, $mot_de_passe, $base_de_donnees);

// Vérifier la connexion
if (!$connexion) {
    die("La connexion à la base de données a échoué : " . mysqli_connect_error());
}

// Vérifier si le formulaire a été soumis
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupérer les données du formulaire
    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $adresse_email = $_POST['adresse_email'];
    $mot_de_passe = $_POST['mot_de_passe'];

    // Préparer la requête SQL d'insertion
    $requete = "INSERT INTO utilisateurs (nom, prenom, adresse_email, mot_de_passe) VALUES ('$nom', '$prenom', '$adresse_email', '$mot_de_passe')";

    // Exécuter la requête
    if (mysqli_query($connexion, $requete)) {
        echo "Inscription réussie !";
    } else {
        echo "Erreur : " . $requete . "<br>" . mysqli_error($connexion);
    }

    // Fermer la connexion à la base de données
    mysqli_close($connexion);
}
?>

<?php
session_start(); // Démarrer la session

// Connexion à la base de données
$serveur = "localhost";
$utilisateur = "root";
$mot_de_passe = "";
$base_de_donnees = "MMA";

$connexion = mysqli_connect($serveur, $utilisateur, $mot_de_passe, $base_de_donnees);

// Vérifier la connexion
if (!$connexion) {
    die("La connexion à la base de données a échoué : " . mysqli_connect_error());
}

// Vérifier si le formulaire a été soumis
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupérer les données du formulaire
    $nom_utilisateur = mysqli_real_escape_string($connexion, $_POST['username']);
    $adresse_email = mysqli_real_escape_string($connexion, $_POST['email']);
    $mot_de_passe = mysqli_real_escape_string($connexion, $_POST['password']);

    // Définir le rôle de l'utilisateur (par défaut)
    $role = 'utilisateur';

    // Préparer la requête SQL d'insertion avec des paramètres sécurisés
    $requete = "INSERT INTO utilisateurs (nom_utilisateur, adressMail, mot_de_passe, role) VALUES ('$nom_utilisateur', '$adresse_email', '$mot_de_passe', '$role')";

    // Exécuter la requête
    if (mysqli_query($connexion, $requete)) {
        // Initialiser la session avec l'identifiant de l'utilisateur
        $_SESSION['identifiant'] = $nom_utilisateur;
        
        // Redirection vers la page d'accueil après inscription réussie
        header("Location: Acceuil.php");
        exit; // Arrêter l'exécution du script après la redirection
    } else {
        echo "Erreur : " . $requete . "<br>" . mysqli_error($connexion);
    }

    // Fermer la connexion à la base de données
    mysqli_close($connexion);
}
?>

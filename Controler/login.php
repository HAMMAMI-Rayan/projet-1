<?php
// Connexion à la base de données
$serveur = "localhost";
$utilisateur = "root";
$mot_de_passe = "";
$base_de_donnees = "MMA";

$connexion = mysqli_connect($serveur, $utilisateur, $mot_de_passe, $base_de_donnees);

if (!$connexion) {
    die("La connexion à la base de données a échoué : " . mysqli_connect_error());
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $identifiant = mysqli_real_escape_string($connexion, $_POST['username']);
    $mot_de_passe = mysqli_real_escape_string($connexion, $_POST['password']);

    $requete = "SELECT * FROM utilisateurs WHERE nom_utilisateur = '$identifiant' AND mot_de_passe = '$mot_de_passe'";

    $resultat = mysqli_query($connexion, $requete);

    if (mysqli_num_rows($resultat) == 1) {
        session_start();
        $_SESSION['loggedin'] = true; 
        $_SESSION['identifiant'] = $identifiant;
        header("Location: ../vue/Acceuil.php"); 
        exit; 
    } else {
        echo "Identifiant ou mot de passe incorrect.";
    }

    mysqli_free_result($resultat);
}

mysqli_close($connexion);
?>

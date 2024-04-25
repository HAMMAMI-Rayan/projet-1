<?php
session_start(); 

if (!isset($_SESSION['identifiant'])) {
    header("Location: ../vue/connexion.php");
    exit; 
}

$identifiant = $_SESSION['identifiant'];

$serveur = "localhost";
$utilisateur = "root";
$mot_de_passe = "";
$base_de_donnees = "MMA";

$connexion = mysqli_connect($serveur, $utilisateur, $mot_de_passe, $base_de_donnees);

if (!$connexion) {
    die("La connexion à la base de données a échoué : " . mysqli_connect_error());
}

$requete = "SELECT nom_utilisateur, adressMail FROM utilisateurs WHERE nom_utilisateur = '$identifiant'";

$resultat = mysqli_query($connexion, $requete);

if (mysqli_num_rows($resultat) == 1) {
    $row = mysqli_fetch_assoc($resultat);
    $nom_utilisateur = $row['nom_utilisateur'];
    $adresse_email = $row['adressMail'];
} else {
    echo "Erreur : Utilisateur non trouvé.";
}

mysqli_free_result($resultat);

mysqli_close($connexion);
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>Mon Compte</title>
    <link rel="stylesheet" href="../css/Acceuil.css">
    <style>
        .container {
            position: relative;
            padding-bottom: 200px;
            padding-left: 500px;
            top: 20%;
            width: 100%;
            text-align: center;
        }

        .logo {
            font-size: 32px;
            color: rgb(0, 0, 0);
            text-decoration: none;
            font-weight: 700;
        }
    </style>
</head>

<body>
    <header class="header">
        <a href="Acceuil.php" class="logo">PUGILAT FR</a>

        <nav class="navbar">
            <a href="Acceuil.php">Accueil</a>
            <a href="tableau.php">Combattant</a>
            <?php
            if (isset($_SESSION['identifiant'])) {
                echo '<a href="mon_compte.php">Mon Compte</a>';
            } else {
                echo '<a href="Inscription.php">Inscrivez-vous</a>';
            }
            ?>

            <form id="form">
                <input type="text" placeholder="Rechercher" id="search" class="search">
            </form>
        </nav>
    </header>

    <div class="container">
        <h1>Mon Compte</h1>
        </br>
        <div class="informations">
            <p><strong>Nom d'utilisateur :</strong> <?php echo $nom_utilisateur; ?></p>
            </br>
            <p><strong>Adresse e-mail :</strong> <?php echo $adresse_email; ?></p>
            </br>
            <!-- Bouton de déconnexion -->
            <form action="../Controler/logout.php" method="POST">
                <button type="submit">Déconnexion</button>
            </form>
        </div>
    </div>
</body>

</html>
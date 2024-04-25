<?php session_start(); ?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>B. Movies</title>
    <link rel="stylesheet" type="text/css" href="../css/Acceuil.css">
    <style>
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
            <a href="Tableau.php">Combattant</a>
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


</body>

</html>

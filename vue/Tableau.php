<?php session_start(); ?>


<!DOCTYPE html>
<html>

<head>
    <title>Tableau des Combattants MMA</title>
    <meta charset="utf-8">
    <link rel="stylesheet" href="../css/Acceuil.css">
    <style>
        .tab {
            padding-left: 700px;
            padding-bottom: 200px;
            text-align: center;
        }

        .logo {
            font-size: 32px;
            color: black;
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

    <div class="tab">
        <h1>Tableau des Combattants MMA</h1>

        <table style="border-spacing: 10px;">
            <thead>
                <tr>
                    <th>Nom</th>
                    <th>Prénom</th>
                    <th>Âge</th>
                    <th>Poids</th>
                    <th>Taille</th>
                    <th>Origine</th>
                    <th>Bilan</th>
                    <th>Art Martial</th>
                    <th>Catégorie</th>
                </tr>
            </thead>
            <tbody>
                <?php
                include '../Model/combattant.inc.php';

                if (mysqli_num_rows($resultat) > 0) {
                    while ($row = mysqli_fetch_assoc($resultat)) {
                        echo "<tr>";
                        echo "<td>" . $row['nom'] . "</td>";
                        echo "<td>" . $row['prenom'] . "</td>";
                        echo "<td>" . $row['age'] . "</td>";
                        echo "<td>" . $row['poids'] . "</td>";
                        echo "<td>" . $row['taille'] . "</td>";
                        echo "<td>" . $row['origine'] . "</td>";
                        echo "<td>" . $row['Bilan'] . "</td>";
                        echo "<td>" . $row['nom_art_martial'] . "</td>";
                        echo "<td>" . $row['categorie_combattant'] . "</td>";
                        echo "</tr>";
                    }
                } else {
                    echo "Aucun combattant trouvé dans la base de données.";
                }

                mysqli_free_result($resultat);
                mysqli_close($connexion);
                ?>
            </tbody>
        </table>
    </div>
</body>

</html>
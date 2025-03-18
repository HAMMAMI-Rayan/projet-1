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
// Ajouter un combattant
if (isset($_POST['ajouter'])) {
    ajouterCombattant(
        $connexion,
        $_POST['nom'],
        $_POST['prenom'],
        $_POST['age'],
        $_POST['poids'],
        $_POST['taille'],
        $_POST['origine'],
        $_POST['bilan'],
        $_POST['art_martial'],
        $_POST['categorie']
    );
    header("Location: Tableau.php");
    exit();
}


// Modifier un combattant
if (isset($_POST['modifier'])) {
    modifierCombattant(
        $connexion, 
        $_POST['id'], 
        $_POST['nom'], 
        $_POST['prenom'], 
        $_POST['age'], 
        $_POST['poids'], 
        $_POST['taille'], 
        $_POST['origine'], 
        $_POST['bilan'], 
        $_POST['art_martial']
    );
    header("Location: Tableau.php");
    exit();
}


// Supprimer un combattant
if (isset($_GET['supprimer'])) {
    supprimerCombattant($connexion, $_GET['supprimer']);
    header("Location: Tableau.php");
}

    if (mysqli_num_rows($resultat) > 0) {
        while ($row = mysqli_fetch_assoc($resultat)) {
            echo "<tr>";
            echo "<form method='post'>";
            echo "<input type='hidden' name='id' value='" . $row['id'] . "'>";
            echo "<td><input type='text' name='nom' value='" . $row['nom'] . "'></td>";
            echo "<td><input type='text' name='prenom' value='" . $row['prenom'] . "'></td>";
            echo "<td><input type='number' name='age' value='" . $row['age'] . "'></td>";
            echo "<td><input type='number' name='poids' value='" . $row['poids'] . "'></td>";
            echo "<td><input type='number' name='taille' value='" . $row['taille'] . "'></td>";
            echo "<td><input type='text' name='origine' value='" . $row['origine'] . "'></td>";
            echo "<td><input type='text' name='bilan' value='" . $row['Bilan'] . "'></td>";
            echo "<td><input type='text' name='art_martial' value='" . $row['nom_art_martial'] . "'></td>";
            echo "<td>";
            echo "<button type='submit' name='modifier'>Modifier</button>";
            echo "<a href='Tableau.php?supprimer=" . $row['id'] . "' onclick='return confirm(\"Supprimer ce combattant ?\");'>Supprimer</a>";
            echo "</td>";
            echo "</form>";
            echo "</tr>";
        }
    } else {
        echo "<tr><td colspan='10'>Aucun combattant trouvé dans la base de données.</td></tr>";
    }


    mysqli_free_result($resultat);
    mysqli_close($connexion);
    ?>

            </tbody>
        </table>
        <form method="post">
    <tr>
        <td><input type="text" name="nom" required></td>
        <td><input type="text" name="prenom" required></td>
        <td><input type="number" name="age" required></td>
        <td><input type="number" name="poids" required></td>
        <td><input type="number" name="taille" required></td>
        <td><input type="text" name="origine" required></td>
        <td><input type="text" name="bilan" required></td>
        <td>
            <select name="art_martial" required>
                <option value="KickBoxing">KickBoxing</option>
                <option value="Sambo">Sambo</option>
            </select>
        </td>
        <td>
            <select name="categorie" required>
                <option value="Leger">Léger</option>
            </select>
        </td>
        <td>
            <button type="submit" name="ajouter">Ajouter</button>
        </td>
    </tr>
</form>


    </div>
</body>

</html>
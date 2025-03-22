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
        <a href="Acceuil.php" class="logo">MMA Web Fan</a>

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

        <?php
        // Vérifier si l'utilisateur est connecté
        $isLoggedIn = isset($_SESSION['identifiant']);
        
        if (!$isLoggedIn && (isset($_POST['ajouter']) || isset($_POST['modifier']) || isset($_GET['supprimer']))) {
            echo "<p style='color: red;'>Vous devez être connecté pour modifier le tableau des combattants.</p>";
            echo "<p><a href='login.php'>Se connecter</a></p>";
            exit();
        }

        include '../Model/combattant.inc.php';
        
        // Ajouter un combattant
        if ($isLoggedIn && isset($_POST['ajouter'])) {
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
        if ($isLoggedIn && isset($_POST['modifier'])) {
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
        if ($isLoggedIn && isset($_GET['supprimer'])) {
            supprimerCombattant($connexion, $_GET['supprimer']);
            header("Location: Tableau.php");
        }
        ?>

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
                    <?php if ($isLoggedIn) echo "<th>Actions</th>"; ?>
                </tr>
            </thead>
            <tbody>
            <?php
            if (mysqli_num_rows($resultat) > 0) {
                while ($row = mysqli_fetch_assoc($resultat)) {
                    echo "<tr>";
                    
                    if ($isLoggedIn) {
                        // Affichage pour utilisateurs connectés (avec des champs éditables)
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
                        echo "<td>" . $row['categorie_combattant'] . "</td>";
                        echo "<td>";
                        echo "<button type='submit' name='modifier'>Modifier</button> ";
                        echo "<a href='Tableau.php?supprimer=" . $row['id'] . "' onclick='return confirm(\"Supprimer ce combattant ?\");'>Supprimer</a>";
                        echo "</td>";
                        echo "</form>";
                    } else {
                        // Affichage pour visiteurs (vue en lecture seule)
                        echo "<td>" . $row['nom'] . "</td>";
                        echo "<td>" . $row['prenom'] . "</td>";
                        echo "<td>" . $row['age'] . "</td>";
                        echo "<td>" . $row['poids'] . "</td>";
                        echo "<td>" . $row['taille'] . "</td>";
                        echo "<td>" . $row['origine'] . "</td>";
                        echo "<td>" . $row['Bilan'] . "</td>";
                        echo "<td>" . $row['nom_art_martial'] . "</td>";
                        echo "<td>" . $row['categorie_combattant'] . "</td>";
                    }
                    
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

        <?php if ($isLoggedIn): ?>
        <!-- Formulaire d'ajout de combattant (visible uniquement pour les utilisateurs connectés) -->
        <h2>Ajouter un nouveau combattant</h2>
        <form method="post">
            <table style="border-spacing: 10px; margin: auto;">
                <tr>
                    <td><input type="text" name="nom" placeholder="Nom" required></td>
                    <td><input type="text" name="prenom" placeholder="Prénom" required></td>
                    <td><input type="number" name="age" placeholder="Âge" required></td>
                    <td><input type="number" name="poids" placeholder="Poids" required></td>
                    <td><input type="number" name="taille" placeholder="Taille" required></td>
                    <td><input type="text" name="origine" placeholder="Origine" required></td>
                    <td><input type="text" name="bilan" placeholder="Bilan" required></td>
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
            </table>
        </form>
        <?php else: ?>
        <p>Connectez-vous pour pouvoir modifier, ajouter ou supprimer des combattants.</p>
        <p><a href="connexion.php">Se connecter</a></p>
        <?php endif; ?>
    </div>
</body>

</html>
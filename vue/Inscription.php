<!DOCTYPE HTML PUBLIC>
<html>

<head>
    <link href="../css/Inscription.css" type="text/css" rel="stylesheet" media="all">
</head>

<body>
    <header class="header">
        <a href="Acceuil.php" class="logo">PUGILAT FR</a>

        <nav class="navbar">
            <a href="Acceuil.php">Accueil</a>
            <a href="tableau.php">Combattant</a>
        </nav>
    </header>

    <div class="wrapper">
        <form id="signupForm" action="register.php" method="post">
            <h1>Sign Up</h1>

            <div class="input-box">
                <input type="email" name="email" placeholder="Email" required>
                <i class='bx bxs-user'></i>
            </div>

            <div class="input-box">
                <input type="text" name="username" placeholder="Username" required>
                <i class='bx bxs-user'></i>
            </div>

            <div class="input-box">
                <input type="password" name="password" placeholder="Password" required>
                <i class='bx bxs-lock-alt'></i>
            </div>

            <button type="submit" class="btn">Sign Up</button>

        </form>

        <div class="register-link">
            <p>Vous avez déjà un compte ? <a href="connexion.php">Connectez-vous</a></p>
        </div>
</body>

</html>
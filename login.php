
<?php
// Vérifier si le formulaire a été soumis
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Vérifier les identifiants de connexion
    $identifiant_valide = "utilisateur";
    $mot_de_passe_valide = "motdepasse";

    $identifiant = $_POST['identifiant'];
    $mot_de_passe = $_POST['mot_de_passe'];

    // Vérifier si les identifiants sont valides
    if ($identifiant === $identifiant_valide && $mot_de_passe === $mot_de_passe_valide) {
        // Identifiants valides, rediriger vers la page d'accueil par exemple
        header("Location: accueil.php");
        exit;
    } else {
        // Identifiants invalides, afficher un message d'erreur
        echo "Identifiants invalides. Veuillez réessayer.";
    }
}
?>


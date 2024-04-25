<?php
session_start(); // Démarrer la session

// Vérifier si l'utilisateur est connecté en vérifiant la présence de l'identifiant dans la session
if (isset($_SESSION['identifiant'])) {
    // Détruire toutes les variables de session
    session_unset();

    // Détruire la session
    session_destroy();

    // Rediriger vers la page d'accueil ou une autre page après la déconnexion
    header("Location: ../vue/Acceuil.php");
    exit; // Arrêter l'exécution du script après la redirection
}

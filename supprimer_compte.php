<?php
session_start();

// Vérifier si l'utilisateur est connecté
if (isset($_SESSION["user_id"])) {
    // Connexion à la base de données
    $mysqli = require __DIR__ . "./_db/connexionDB.php";

    // Vérifier si le formulaire de suppression a été soumis
    if (isset($_POST["delete_account"])) {
        // Code de suppression de l'utilisateur
        $user_id = $_SESSION["user_id"];
        $sql = "DELETE FROM user WHERE id = $user_id";
        
        if ($mysqli->query($sql)) {
            // Rediriger vers une page de confirmation ou de déconnexion
            header("Location: confirmation_suppression.php");
            exit;
        } else {
            echo "Erreur lors de la suppression de l'utilisateur : " . $mysqli->error;
        }
    }
} else {
    // Si l'utilisateur n'est pas connecté, rediriger vers la page de connexion
    header("Location: connexion.php");
    exit;
}
?>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $destinataire = "igormaquin@gmail.com";
    $sujet = "Nouveau message depuis le site web";
    $message = $_POST["message"];
    $headers = "From: " . $_POST["email"];

    // Envoyer le message par e-mail
    if (mail($destinataire, $sujet, $message, $headers)) {
        echo "Votre message a été envoyé avec succès.";
    } else {
        echo "Une erreur s'est produite lors de l'envoi du message.";
    }
} else {
    // Redirection si le formulaire n'a pas été soumis
    header("Location: crypto.php");
    exit;
}
?>
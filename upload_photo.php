<?php
session_start();

// Vérifiez si l'utilisateur est connecté
if (isset($_SESSION["user_id"])) {
    // Le code de gestion du téléchargement de la photo de profil va ici

    if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_FILES["profile_photo"])) {
        $file = $_FILES["profile_photo"];
        $upload_dir = "uploads/"; // Répertoire où stocker les photos de profil

        // Récupérez l'extension du fichier
        $file_extension = strtolower(pathinfo($file["name"], PATHINFO_EXTENSION));

        // Vérifiez si l'extension est valide (autorisez les .jpg, .jpeg, .png et tout autre format d'image)
        $allowed_extensions = array("jpg", "jpeg", "png", "gif"); // Ajoutez les extensions autorisées ici
        if (!in_array($file_extension, $allowed_extensions)) {
            echo "Le format du fichier n'est pas autorisé. Veuillez télécharger une image au format .jpg, .jpeg, .png ou .gif.";
            exit;
        }

        // Gérez le téléchargement du fichier (vérification, renommage, etc.)
        // Assurez-vous que le fichier est une image valide (vous pouvez utiliser des bibliothèques comme GD ou Imagick pour cela).

        // Déplacez le fichier téléchargé vers le répertoire de destination
        $new_filename = "profile_photo_" . $_SESSION["user_id"] . "." . $file_extension; // Nom de fichier unique avec l'extension
        $destination = $upload_dir . $new_filename;
        if (move_uploaded_file($file["tmp_name"], $destination)) {
            // Mettez à jour la base de données avec le chemin de la nouvelle photo de profil
            $mysqli = require __DIR__ . "./_db/connexionDB.php";
            $user_id = $_SESSION["user_id"];
            $update_sql = "UPDATE users SET photo_path = '$destination' WHERE id = $user_id";
            $result = $mysqli->query($update_sql);

            if ($result) {
                // Redirigez l'utilisateur vers la page de profil
                header("Location: crypto.php");
                exit;
            } else {
                echo "Erreur lors de la mise à jour de la photo de profil dans la base de données.";
            }
        } else {
            echo "Erreur lors du déplacement du fichier téléchargé.";
        }
    }

    // Récupérez le chemin de la photo de profil actuelle depuis la base de données
    $mysqli = require __DIR__ . "./_db/connexionDB.php";
    $user_id = $_SESSION["user_id"];
    $sql = "SELECT photo_path FROM users WHERE id = $user_id";
    $result = $mysqli->query($sql);

    if ($result) {
        $row = $result->fetch_assoc();
        $photo_path = $row["photo_path"];
        echo "Chemin de la photo de profil : " . $photo_path;
    } else {
        echo "Erreur lors de la récupération du chemin de la photo de profil depuis la base de données.";
    }
} else {
    // Si l'utilisateur n'est pas connecté, redirigez-le vers la page de connexion
    header("Location: connexion.php");
    exit;
}
?>

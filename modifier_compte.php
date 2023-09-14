<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    if (strlen($_POST["mdp"]) < 8) {
        die("Le mot de passe doit faire au moins 8 caractères");
    }

    if (!preg_match("/[0-9]/", $_POST["mdp"])) {
        die("Le mot de passe doit contenir au moins un chiffre");
    }

    if ($_POST["mdp"] != $_POST["mdp_confirmation"]) {
        die("Les deux mots de passe doivent être identiques");
    } elseif ($_POST["email"] != $_POST["email_confirmation"]) {
        die("Les deux adresses email doivent être identiques");
    }
    $sql = "UPDATE utilisateurs SET pseudo=?, email=?, mdp=? WHERE id=?";

    $stmt = $connexion->prepare($sql);
    if (!$stmt) {
        die("Erreur SQL : " . $connexion->error);
    }
    
    $stmt->bind_param("sssi", $pseudo, $email, $password_hash, $id_utilisateur);
    
    if ($stmt->execute()) {
        echo "Vos données ont bien été modifiées";
    } else {
        die("Erreur SQL : " . $stmt->error);
    }
}  
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/cree_compte.css">
    <script src="https://unpkg.com/just-validate@latest/dist/just-validate.production.min.js" defer></script>
    <script src="./js/validation.js" defer></script>
    <title>Mon suivi Crypto - Crée un compte</title>
</head>
<body>
    <header>
        <h1>Modifier un compte</h1>
    </header>
    <form method="post" id="signup" novalidate>
        <div class="input-block" id="1">
            <label for="name">Pseudo</label>
            <input type="text" id="pseudo" name="pseudo"  placeholder="Pseudo" />
        </div>
        <div class="input-block" id="2">
            <label for="email">Email</label>
            <input type="email" id="email" name="email">
        </div>
        <div class="input-block" id="3">
            <label for="email">Confirmer votre email</label>
            <input type="email" id="email_confirmation" name="email_confirmation">
        </div>
        <div class="input-block" id="4">
            <label for="mdp">Mot de Passe</label>
            <input type="password" id="mdp" name="mdp">
        </div>
        <div class="input-block" id="5">
            <label for="mdp_confirmation">Confirmer le Mot de Passe</label>
            <input type="password" id="mdp_confirmation" name="mdp_confirmation">
        </div>
         <div class="button-block" id="6">
         <button type="submit" id="create_account" name="inscription">Modifier le compte</button>
         </div>
    </form>
</body>
</html>
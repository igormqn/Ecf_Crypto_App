<?php
$is_invalid = false;

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $mysqli = require __DIR__ . "./_db/connexionDB.php";
    
    $sql = sprintf("SELECT * FROM users WHERE email = '%s'", $_POST["email"]);

    $result = $mysqli->query($sql);

    $user = $result->fetch_assoc();

    if ($user) {
       if (password_verify($_POST["mdp"], $user["password_hash"])) {
            session_start();
            $_SESSION["user_id"] = $user["id"];
            $_SESSION["pseudo"] = $user["pseudo"];
            $_SESSION["email"] = $user["email"];
            $_SESSION["date_naissance"] = $user["date_naissance"];
            header("Location: crypto.php");
            exit;
       }
    }

    $is_invalid = true;
}
?>




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/connexion.css">
    <title>Mon suivi Crypto - Se connecter</title>
</head>
<body>
    <header>
        <h1>Connexion</h1>
        <?php if ($is_invalid): ?>
        <em>Invalid login</em>
        <?php endif; ?>
    
    </header>
    <div class="input-block">
    <form method="post" class="connexion-form">
        <label for="email">
            <input type="email" name="email" id="email" placeholder="Email" value="<?= htmlspecialchars($_POST["email"] ?? "") ?>">
        </label>
        <label for="mdp">
            <input type="password" name="mdp" id="mdp" placeholder="Mot de Passe">
        </label>
    </div>
    <div class="button-block">
       
            <button type="submit" id="connexion" name="connexion">Connexion</button>
            <a href="./cree_compte.php">Vous n'avez pas de comptes ? Créer un compte</a>
    </div>
    </form>
</body>
</html>
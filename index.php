<?php
    include_once('./_db/connexionDB.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/styles.css">
    <title>Mon suivi Crypto</title>
</head>
<body>
    <div class="Welcome-title">
        <h1>BIENVENUE SUR <br> MON SUIVI CRYPTO</h1>
    </div>
    <div class="logo-images">
        <img src="./Ressources/protocol.png" alt="">
    </div>
    <div class="button-block">
            <button id="create-account" onclick="window.location.href='./cree_compte.php';">Crée un Compte</button>
            <button id="connect" onclick="window.location.href='./connexion.php';">Connexion</button>
    </div>
</body>
</html>
<?php

session_start();

// Vérifier si l'utilisateur est connecté
if (isset($_SESSION["user_id"])) {
    $mysqli = require __DIR__ . "./_db/connexionDB.php";

    $sql = "SELECT * FROM user
            WHERE id = {$_SESSION["user_id"]}";

    $result = $mysqli->query($sql);

    // Vérifier si la requête a réussi
    if ($result) {
        $user = $result->fetch_assoc();
         var_dump($user);
        $pseudo = $_SESSION["pseudo"];
        $email = $_SESSION["email"];
        $date_naissance = $_SESSION["date_naissance"];
    }
}

// Si l'utilisateur n'est pas connecté, rediriger vers la page de connexion
if (!isset($_SESSION["user_id"])) {
    header("Location: connexion.php");
    exit;
}
// Récupérez le chemin de la photo de profil actuelle depuis la base de données
$mysqli = require __DIR__ . "./_db/connexionDB.php";
$user_id = $_SESSION["user_id"];
$sql = "SELECT photo_path FROM users WHERE id = $user_id";
$result = $mysqli->query($sql);

if ($result) {
    $row = $result->fetch_assoc();
    $photo_path = $row["photo_path"];
} else {
    echo "Erreur lors de la récupération du chemin de la photo de profil depuis la base de données.";
}

// Maintenant que vous avez récupéré le chemin de la photo, vous pouvez l'afficher dans votre code HTML


?>






<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mon Suivi Crypto - Mon Profil</title>
    <link rel="stylesheet" href="./css/crypto.css">
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script src="https://kit.fontawesome.com/01decfa74a.js" crossorigin="anonymous"></script>
    <script>
        function confirmDelete() {
         
            var confirmation = confirm("Êtes-vous sûr de vouloir supprimer votre profil ? Cette action est irréversible.");

            if (confirmation) {
             
                document.getElementById("deleteForm").submit();
            }
        }
    </script>
</head>
<body>
    <header>
        <h1>Mon profil</h1>
    </header>
    <div class="profile">
        <img src="<?php echo $photo_path; ?>" alt="Photo de profil">
        <form action="upload_photo.php" method="post" enctype="multipart/form-data">
            <input type="file" class="custom-file-input" name="profile_photo" accept="image/*">
            <input type="submit" class="submit-input" value="Modifier la photo">
        </form>
    </div>
    <section class="info-block">
        <div class="info-container">
            <ul>
            <li>Pseudo: <?= $_SESSION["pseudo"] ?></li>
            <li>Email: <?= $_SESSION["email"] ?></li>
            <li>Date de Naissance: <?= $_SESSION["date_naissance"] ?></li>
                <li><a href="deconnexion.php">Deconnexion</a></li>
            </ul>
        </div>
        <div class="account-administrator">
                <ul>
                    <li><a href="modifier_compte.php" id="modify-account">Modifier le Compte</a></li>
                    <form method="POST" id="deleteForm"  action="supprimer_compte.php">
                    <li><a href="" id="delete-account" onclick="confirmDelete()">Supprimer le Compte</a></li>
                    </form>
                </ul>
        </div>
    </section>
    <section class="crypto-container">
        <div class="crypto-block crypto-link" id="1" data-target="./chart/btcchart.html">
            <div class="crypto-info">
                <img src="./Ressources/btc-svgrepo-com.svg" alt="btc-logo">
                <div class="crypto-chart">
                <img src="./Ressources/forex_chart_images.png" alt="btc-chart">
                </div>
                <div class="crypto-data">
                <span id="BTC">BTC</span>
                <span id="bitcoin"></span>
                </div>
            </div>
        </div>
        <div class="crypto-block crypto-link" id="2" data-target="./chart/ethereumchart.html">
            <div class="crypto-info">
                <img src="./Ressources/ethereum.png" alt="eth-logo">
                <div class="crypto-chart">
                <img src="./Ressources/forex_trading_chart_number_2.png" alt="eth-chart">
                </div>
                <div class="crypto-data">
                <span id="ETH">ETH</span>
                <span id="ethereum"></span>
                </div>
            </div>
        </div>
        <div class="crypto-block crypto-link" id="3" data-target="./chart/tetherchart.html">
            <div class="crypto-info">
                <img src="./Ressources/tether-crypto-cryptocurrency-2-svgrepo-com.svg" alt="btc-logo">
                <div class="crypto-chart">
                <img src="./Ressources/forex_chart_images.png" alt="theth-chart">
                </div>
                <div class="crypto-data">
                <span id="TETH">TETH</span>
                <span id="tether"></span>
                </div>
            </div>
        </div>
        <div class="crypto-block crypto-link" id="4" data-target="./chart/litecoinchart.html">
            <div class="crypto-info">
                <img src="./Ressources/litecoin-svgrepo-com.svg" alt="tc-logo">
                <div class="crypto-chart">
                    <img src="./Ressources/forex_trading_chart_number_2.png" alt="xrp-chart">
                </div>
                <div class="crypto-data">
                    <span id="LTC" style="color: red;">LTC</span>
                    <span id="litecoin">60.37</span>
                </div>
            </div>
        </div>
        <div class="crypto-block crypto-link" id="5" data-target="./chart/zcashchart.html">
            <div class="crypto-info">
                <img src="./Ressources/zcash.png" alt="zcash">
                <div class="crypto-chart">
                    <img src="./Ressources/forex_chart_images.png" alt="zcash-chart">
                </div>
                <div class="crypto-data">
                    <span id="ZSH">ZCASH</span>
                    <span id="zcash">25.03</span>
                </div>
            </div>
        </div>
        <div class="crypto-block crypto-link" id="6" data-target="./chart/solanachart.html">
            <div class="crypto-info">
                <img src="./Ressources/solana.svg" alt="solana">
                <div class="crypto-chart">
                    <img src="./Ressources/forex_chart_images.png" alt="solana-chart">
                </div>
                <div class="crypto-data">
                    <span id="SOL">Solana</span>
                    <span id="solana">17.98</span>
                </div>
            </div>
        </div>
    </div>
    </section>
    <footer>
        <h1>Contactez-Nous</h1>
        <div class="message-block">
        <form action="envoyer_message.php" method="post">
            <input type="email" placeholder="Email">
            <input type="message" id="Enter-Message" placeholder="Veuillez entrer votre message">
        </form>
        </div>
        <div class="follow-us">
            <a href="https://facebook.com" ><i class="fab fa-facebook" id="facebook-logo"   ></i></a>
            <a href="https://linkedin.com" ><i class="fab fa-linkedin" id="linkedin-logo"   ></i></a>
            <a href="https://instagram.com"><i class="fab fa-instagram" id="instagram-logo" ></i></a>
            <a href="https://twitter.com"  ><i class="fab fa-twitter-square" id="twitter-logo"></i></a>
        </div>
    </footer>
    <script src="./js/app.js"></script>
    <script>
        // Sélectionnez toutes les divs avec la classe "crypto-link"
        const cryptoBlocks = document.querySelectorAll('.crypto-link');

        // Ajoutez un gestionnaire de clic à chaque div
        cryptoBlocks.forEach((block) => {
            block.addEventListener('click', () => {
                // Obtenez l'URL cible à partir de l'attribut "data-target"
                const targetUrl = block.getAttribute('data-target');
                if (targetUrl) {
                    // Redirigez l'utilisateur vers l'URL cible
                    window.location.href = targetUrl;
                }
            });
        });
    </script>

</body>
</html>

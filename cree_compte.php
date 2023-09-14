

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
        <h1>Créer un compte</h1>
    </header>
    <form method="post" id="signup" action="signup-process.php" novalidate>
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
     <div class="input-block" id="6">

             <label for="date_naissance">Date de naissance</label>
             <input type="date" id="date_naissance" name="date_naissance">
       
         <div class="button-block" id="7">
         <button type="submit" id="create_account" name="inscription">Créez un compte</button>
        <a href="./connexion.php">Vous avez déjà un compte ? Connectez-Vous</a>
         </div>
    </form>
</body>
</html>
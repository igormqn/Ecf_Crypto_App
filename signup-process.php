<?php

if (empty($_POST['pseudo'])) {
    die("Un pseudo est requis");
}elseif(strlen($_POST["pseudo"] < 8)){
    die("Le pseudo doit faire plus de 8 caractères");
}

if ( ! filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) {
    die("Un email valide est requis");
}

if (strlen($_POST["mdp"]) < 8) {
    die("Le mot de passe doit faire au moins 8 caractères");
}

if ( ! preg_match("/[0-9]/", $_POST["mdp"])){
    die("Le mot de passe doit contenir au moins un chiffre");
}


if (($_POST["mdp"] != $_POST["mdp_confirmation"])){
    die("Les deux mots de passes doivent être identiques");
}elseif(($_POST["email"] != $_POST["email_confirmation"])){
    die("Les deux mails doivent être identiques");
}

if($_SERVER['REQUEST_METHOD'] === 'POST'){
$date_naissance_str = $_POST['date_naissance'];
$date_naissance = new DateTime($date_naissance_str);

// Create a DateTime object for January 1, 2005
$minimum_birthdate = new DateTime('2006-01-01');

// Compare the input date with the minimum allowed date
if ($date_naissance > $minimum_birthdate) {
    die("Vous devez avoir 18 ans pour vous inscrire");
}}

$password_hash = password_hash($_POST['mdp'], PASSWORD_DEFAULT);

$mysqli = require __DIR__ . "./_db/connexionDB.php";

$sql = "INSERT INTO users (pseudo, email, password_hash, date_naissance) VALUES (?, ?, ?, ?)";

$stmt = $mysqli->stmt_init();
if ( ! $stmt->prepare($sql)){
    die("SQL error: " . $mysqli->error);
}

$stmt->bind_param("ssss", $_POST["pseudo"], $_POST["email"], $password_hash, $_POST["date_naissance"]);

if ($stmt->execute()){
    session_start();
    $_SESSION["user_id"] = $stmt->insert_id; 
    $_SESSION["pseudo"] = $_POST["pseudo"];
    $_SESSION["email"] = $_POST["email"];
    $_SESSION["date_naissance"] = $_POST["date_naissance"];
echo "Signup Successful";

} else {
    if($mysqli->errno === 1062){
        die("L'email est déjà utilisé");
    }else{
        die($mysqli->error." ".$mysqli->errno);
    }
}
?>

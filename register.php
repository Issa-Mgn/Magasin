<?php
include("exemple15-2.php");

$success = "";
$erreur  = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $idcom    = connexobjet("essaiBDD", "myparam");
    $nom      = $idcom->real_escape_string($_POST['nom']);
    $prenom   = $idcom->real_escape_string($_POST['prenom']);
    $contact  = $idcom->real_escape_string($_POST['contact']);
    $login    = $idcom->real_escape_string($_POST['login']);
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    $requete = "INSERT INTO users (nom, prenom, contact, login, password) 
                VALUES ('$nom', '$prenom', '$contact', '$login', '$password')";
    $result  = $idcom->query($requete);

    if (!$result) {
        $erreur = "Erreur : " . $idcom->error;
    } else {
        $success = "Inscription réussie !";
    }
    $idcom->close();
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscription</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h2 style="text-align: center; padding: 50px;">Inscription</h2>

    <?php if ($erreur)  echo "<p style='color:red;'>$erreur</p>"; ?>
    <?php if ($success) echo "<p style='color:green;'>$success <a href='index.php'>Se connecter</a></p>"; ?>

    <form method="POST">
        <label>Nom :</label>
        <input type="text" name="nom" required><br><br>

        <label>Prénom :</label>
        <input type="text" name="prenom" required><br><br>

        <label>Contact :</label>
        <input type="text" name="contact" required><br><br>

        <label>Login :</label>
        <input type="text" name="login" required><br><br>

        <label>Mot de passe :</label>
        <input type="password" name="password" required><br><br>

        <button type="submit">S'inscrire</button>
    </form>
    <br>
    <a href="index.php" style="text-align: center; margin: 45rem;" >Déjà un compte ? Se connecter</a>
</body>
</html>

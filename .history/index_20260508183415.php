<?php
session_start();
include("exemple15-2.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $idcom    = connexobjet("<?php
function connexobjet($base, $param)
{
    include_once($param.".inc.php");
    $idcom = new mysqli(HOST, USER, PASS, $base, PORT);
    if (!$idcom) {
        echo "<script type=text/javascript>";
        echo "alert('Connexion impossible à la base')</script>";
        exit();
    }
    return $idcom;
}
?>", "myparam");
    $login    = $idcom->real_escape_string($_POST['login']);
    $password = $_POST['password'];

    $requete = "SELECT * FROM users WHERE login='$login'";
    $result  = $idcom->query($requete);

    if ($result->num_rows === 0) {
        $erreur = "Utilisateur introuvable.";
    } else {
        $user = $result->fetch_assoc();
        if (password_verify($password, $user['password'])) {
            $_SESSION['user'] = $user['login'];
            header("Location: accueil.php");
            exit();
        } else {
            $erreur = "Mot de passe incorrect.";
        }
    }
    $idcom->close();
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h2 style="text-align: center; padding: 50px;">Connexion</h2>

    <?php if (isset($erreur)) echo "<p style='color:red;'>$erreur</p>"; ?>

    <form method="POST">
        <label>Login :</label>
        <input type="text" name="login" required><br><br>

        <label>Mot de passe :</label>
        <input type="password" name="password" required><br><br>

        <button type="submit">Se connecter</button>
    </form>
    <br>
    <a href="register.php" style="text-align: center; margin: 45rem;">Pas de compte ? S'inscrire</a>
</body>
</html>

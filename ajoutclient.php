<?php
session_start();
if (!isset($_SESSION['user'])) { header("Location: index.php"); exit(); }
include("exemple15-2.php");

$success = "";
$erreur  = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $idcom   = connexobjet("essaiBDD", "myparam");
    $nom     = $idcom->real_escape_string($_POST['nom']);
    $prenom  = $idcom->real_escape_string($_POST['prenom']);
    $age     = $_POST['age'];
    $adresse = $idcom->real_escape_string($_POST['adresse']);
    $ville   = $idcom->real_escape_string($_POST['ville']);
    $mail    = $idcom->real_escape_string($_POST['mail']);

    $req = "INSERT INTO client (nom, prenom, age, adresse, ville, mail) 
            VALUES ('$nom', '$prenom', '$age', '$adresse', '$ville', '$mail')";

    if ($idcom->query($req)) {
        $success = "Client ajouté avec succès !";
    } else {
        $erreur = "Erreur : " . $idcom->error;
    }
    $idcom->close();
}
?>
<!DOCTYPE html>
<html lang="fr">
<head><meta charset="UTF-8"><title>Ajouter un client</title><link rel="stylesheet" href="style.css"></head>
<body>
    <h2 style="text-align: center; padding: 50px;">Ajouter un client</h2>

    <?php if ($erreur)  echo "<p style='color:red;'>$erreur</p>"; ?>
    <?php if ($success) echo "<p style='color:green;'>$success — <a href='listeclient.php'>Retour à la liste</a></p>"; ?>

    <form method="POST">
        <label>Nom :</label>
        <input type="text" name="nom" required><br><br>
        <label>Prénom :</label>
        <input type="text" name="prenom" required><br><br>
        <label>Age :</label>
        <input type="number" name="age" required><br><br>
        <label>Adresse :</label>
        <input type="text" name="adresse" required><br><br>
        <label>Ville :</label>
        <input type="text" name="ville" required><br><br>
        <label>Mail :</label>
        <input type="email" name="mail" required><br><br>
        <button type="submit">Enregistrer</button>
        <button onclick="window.location.href='accueil.php'">Quitter</button>
    </form>
    <br>
</body>
</html>
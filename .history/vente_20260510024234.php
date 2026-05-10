<?php
session_start();
if (!isset($_SESSION['user'])) { header("Location: index.php"); exit(); }
include("exemple15-2.php");

$success = "";
$erreur  = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $idcom      = connexobjet("if0_41867433_magasin", "myparam");
    $id_client  = $_POST['id_client'];
    $date       = $_POST['date'];
    $montant    = $_POST['montant'];
    $id_article = $idcom->real_escape_string($_POST['id_article']);
    $qte        = $_POST['qte_comm'];

    // Insérer dans commande
    $req1 = "INSERT INTO commande (date, id_client, montant) 
             VALUES ('$date', '$id_client', '$montant')";
    $idcom->query($req1);
    $id_comm = $idcom->insert_id;

    // Insérer dans contenir
    $req2 = "INSERT INTO contenir (id_comm, id_article, qte_comm) 
             VALUES ('$id_comm', '$id_article', '$qte')";

    if ($idcom->query($req2)) {             
        $success = "Vente enregistrée avec succès !";
    } else {
        $erreur = "Erreur : " . $idcom->error;
    }
    $idcom->close();
}

$idcom2   = connexobjet("if0_41867433_magasin", "myparam");
$clients  = $idcom2->query("SELECT idclient, nom, prenom FROM client");
$articles = $idcom2->query("SELECT id_article, design FROM article");
?>
<!DOCTYPE html>
<html lang="fr">
<head><meta charset="UTF-8"><meta name="viewport" content="width=device-width, initial-scale=1.0"><title>Effectuer une vente</title><link rel="stylesheet" href="style.css"></head>
<body>
    <h2 style="text-align: center; padding: 50px;">Effectuer une vente</h2>

    <?php if ($erreur)  echo "<p style='color:red;'>$erreur</p>"; ?>
    <?php if ($success) echo "<p style='color:green;'>$success</p>"; ?>

    <form method="POST">
        <label>Client :</label>
        <select name="id_client" required>
            <?php while($c = $clients->fetch_assoc()): ?>
            <option value="<?= $c['idclient'] ?>"><?= $c['nom'].' '.$c['prenom'] ?></option>
            <?php endwhile; ?>
        </select><br><br>

        <label>Date :</label>
        <input type="date" name="date" required><br><br>

        <label>Montant :</label>
        <input type="number" step="0.01" name="montant" required><br><br>

        <label>Article :</label>
        <select name="id_article" required>
            <?php while($a = $articles->fetch_assoc()): ?>
            <option value="<?= $a['id_article'] ?>"><?= $a['id_article'].' - '.$a['design'] ?></option>
            <?php endwhile; ?>
        </select><br><br>

        <label>Quantité :</label>
        <input type="number" name="qte_comm" required><br><br>

        <button type="submit">Enregistrer</button>
        <button type="button" onclick="window.location.href='accueil.php'"> Quitter</button>
    </form>
    <br>
</body>
</html>

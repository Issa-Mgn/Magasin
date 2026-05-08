<!DOCTYPE html>
<html lang="fr">
<head>
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Ajout d'un article</title>
</head>
<body>
    <h2 style="text-align: center; padding: 50px;">Enregistrement d'un article</h2>
    <form action="exemple15-4.php" method="POST">

        <label>Code article :</label>
        <input type="text" name="id_article" required><br><br> 

        <label>Désignation :</label>
        <input type="text" name="design" required><br><br>

        <label>Prix :</label>
        <input type="number" step="0.01" name="prix" required><br><br>

        <label>Catégorie :</label>
        <input type="text" name="categorie" required><br><br>

        <button type="button" onclick="window.location.href='accueil.php'"> Quitter</button>
        <button type="submit">Enregistrer</button>
    </form>
</body>
</html>

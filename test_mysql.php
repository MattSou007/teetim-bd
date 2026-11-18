<?php
$cnx = new mysqli('db', 'teetim', 'teetim', 'teetim');

$requeteProduits = "SELECT nom, prix From produit LIMIT 10";

$resultat = $cnx -> query($requeteProduits);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Test mysql</title>
</head>
<body>
    <h2>10 premiers produits (nom & prix)</h2>
    <ul>
        <?php while($unProduit = $resultat->fetch_assoc()): ?>
        <li><?php echo $unProduit['nom']; ?>(<?= $unProduit['prix']; ?>)</li>
        <?php endwhile; ?>
    </ul>
</body>
</html>
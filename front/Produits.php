<?php

require ("../back/ModelProduits.php");

$displayProd = new Produits();

if(isset($_GET['id_produit'])){
    $var = $displayProd->getProd($_GET['id_produit']);
}

if(isset($_GET['id_produit'])){
    $imgDetails = $displayProd->getProdDetailsImg($_GET['id_produit']);
}

/*echo "<pre>";
    print_r($var);
echo "</pre>";*/

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/styleOrdi.css">
    <title>Produits</title>
    <style>@import url('https://fonts.googleapis.com/css2?family=Noto+Sans:ital@0;1&display=swap');</style>
</head>
<body>
    <?php require "header.php" ?>
    <main>
        <div class="containerProduit">
            
        <div class="containerProduitImageMain">
        <?php
            foreach($var as $vars){
        ?>
            <div class="containerProduitImage">
                <img src="<?php print $vars['url'] ?>">
            </div>
        <?php
            }
        ?>
        </div>
            <div class="containerProduitTexte">
            <hr>
                <h1><?= $vars['titre']; ?></h1>
                <p><?= $vars['descriptif']; ?></p>
            </div>
            
            <div class="containerProduitPrix">
                <p><b>Prix: <?= $vars['prix']; ?> €</b></p>
            </div>
            
            <div class="containerProduitPanier">
                <a href="Payment.php"> <img src="./images/panier.jpg" class="boutonPanierProduit"></a>
            </div>
        </div>

        <div class="containerDetailsTech">
            
            <div class="containerDetailsText">
                <h1>Détails techniques</h1>
                <hr>
                <p><?= $vars['details']; ?></p>
            
            <?php
            foreach($imgDetails as $imgDetailss){
        ?>
        <div class="containerDetailsImg">
            <img src="<?php print $imgDetailss['url'] ?>">
        </div>
            </div>
            <?php
            }
            ?>

    
    <?php require "footer.php"; ?>

</body>
</html>
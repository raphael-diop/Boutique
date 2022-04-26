<?php
session_start();
require ("../back/ModelProduits.php");
$produit = new Produits;
$prod = $produit->getAllProd();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/styleOrdi.css">
    <title>Accueil</title>
</head>
<body>
   <?php require 'header.php'; ?>
    <main>
        <div class="containerMenuImage">
            <!-- MENU CAT GAUCHE-->
                <form class="menuGauche" action="boutique.php" method="get">
                        <input type="submit" name="catégorie" value="Cheminées">
                        <input type="submit" name="catégorie" value="Fauteuils">
                        <input type="submit" name="catégorie" value="Sculptures">
                        <input type="submit" name="catégorie" value="Suspensions">
                        <input type="submit" name="catégorie" value="Tables">
                        <input type="submit" name="catégorie" value="Tabourets">
                </form>
            <!-- PHOTO  -->
            <div>
            <img src="./images/image accueil.jpg" alt="Salon présentation">
            </div>
            <div class="blockcouleur">
                
            </div>
        </div>


        <div class="containeurBestSeller">
            <h1>Les meilleures ventes</h1>
            <hr>
            <!-- BEST SELLERS -->
            <div class="figures">
                <figure>
                    <div class="figureImage">
                        <img src="<?php print $prod[0]['url'] ?>" alt="">
                    </div>
                    <?php  $prod[0]['url'] ?>
                    <div class="figureTitre">
                       <a href="#"><h3><?php echo $prod[0]['titre'] ?></h3></a> 
                    </div>
                    <div class="prix">
                        <!-- require prix bdd -->
                        <h4><?php echo $prod[0]['prix']. " " . "euros"?></h4>
                    </div>
                </figure>
                <figure>
                    <div class="figureImage"">
                        <!-- require img bdd -->
                        <img src="<?php print $prod[1]['url'] ?>" alt="">
                    </div>
                    <div class="figureTitre">
                        <!-- require titre bdd -->
                        <a href="#"><h3><?php echo $prod[1]['titre'] ?></h3></a> 
                    </div>
                    <div class="figurePrix">
                        <!-- require prix bdd -->
                        <h4><?php echo $prod[1]['prix']. " " . "euros"?></h4>
                    </div>
                </figure>
                <figure>
                    <div class="figureImage"">
                        <!-- require img bdd -->
                        <img src="<?php print $prod[2]['url'] ?>" alt="">
                    </div>
                    <div class="figureTitre">
                        <!-- require titre bdd -->
                        <a href="#"><h3><?php echo $prod[2]['titre'] ?></h3></a> 
                    </div>
                    <div class="figurePrix">
                        <!-- require prix bdd -->
                        <h4><?php echo $prod[2]['prix']. " " . "euros"?></h4>
                    </div>
                </figure>
               
            </div>
        </div>


        <div class="containerCategories">
            <h1>Les Catégories</h1>
            <hr>
            <!-- CATEGORIES -->
            <div class="blockCategories">
                <div class="categoriesGauche" >
                <a href="#">
                    <section class="categories">
                        <p class="categorieTitre">
                            Sculptures
                        </p>
                        <img src="./images/sculptures/renard.jpeg" alt="Sculpture">
                    </section>
                </a>
                <a href="#">
                    <section class="categories">
                        <p class="categorieTitre">
                            Fauteuils
                        </p>
                        <img src="./images/fauteuils/fauteil.jpeg" alt="fauteuil">
                    </section>
                </a>
                <a href="#">
                    <section class="categories">
                        <p class="categorieTitre">
                            Tables
                        </p>
                        <img src="./images/tables/table.jpeg" alt="Table">
                    </section>
                </a>
                </div>

                <div class="categoriesDroite" >
                <a href="#">
                    <section class="categories">
                        <p class="categorieTitre">
                            Cheminées
                        </p>
                        <img src="./images/cheminées/cheminée.jpeg" alt="cheminée">
                    </section>
                </a>
                <a href="#">
                    <section class="categories">
                        <p class="categorieTitre">
                            Luminaires
                        </p>
                        <img src="./images/luminaire.jpeg" alt="Luminaire">
                    </section>
                </a>
                <a href="#">
                    <section class="categories">
                        <p class="categorieTitre">
                            Tabourets
                        </p>
                        <img src="./images/tabouret.jpeg" alt="toubouret">
                    </section>
                </a>
                </div>
            </div>
        </div>
    </main>
   <?php require 'footer.php'; ?>
</body>
</html>
<?php
require ("../back/ModelPagination.php");
require ("../back/ModelPanier.php");

$pagination = new Pagination();
//Gestion Pagination
$pag = $pagination->Pagination();
$getajout = "&amp;";

if($pag[3] > 5) {
    // afficher la pagination
}
elseif($pag[3] === null) {
    // affichage des produits et la pagination disparait
    $pagination = null;
}

//Gestion Categories
$fix = null;
if(isset($_GET["catégorie"]) && !empty($_GET["catégorie"])){
    $nomcat = $_GET["catégorie"];
    $cat = $pagination->getCategorie($nomcat);
    $currentPage = $cat['2'];
    $pages = $cat['1'];
    var_dump($cat);
}else{
    $nomcat = $fix;
    $pag = $pagination->Pagination();
    $currentPage = $pag['2'];
    $pages = $pag['1'];
    var_dump($pag);

}
var_dump($cat);



//$cat = $pagination->getCategorie($nomcat);

//Gestion ajout panier
$panier = new Panier();
$addpanier = $panier->verif();

 //var_dump($_SESSION["panier"]);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/styleOrdi.css">
    <title>Boutique</title>
    <style>@import url('https://fonts.googleapis.com/css2?family=Noto+Sans:ital@0;1&display=swap');</style>
</head>
<body>
<?php //require 'header.php'; ?>
    <main>
        <div class="containerallProduits">
            <div class="containerMenuProduits">
                    <!-- MENU CAT GAUCHE-->
                        <h3>Trier par catégories:</h3>
                        <form class="menuGaucheProduits" action="" method="GET">
                                <input type="submit" name="catégorie" value="Cheminées">
                                <input type="submit" name="catégorie" value="Fauteuils">
                                <input type="submit" name="catégorie" value="Sculptures">
                                <input type="submit" name="catégorie" value="Suspensions">
                                <input type="submit" name="catégorie" value="Tables">
                                <input type="submit" name="catégorie" value="Tabourets">
                        </form>
            </div>

              <?php
              if(!isset($nomcat)){
                foreach($pag[0] as $pags[0]) {
                ?>
                <div class="containerProduits">
                    <div class="produits">  
                        <img src="<?php print $pags[0]['url'] ?>">
                        <p><?= $pags[0]['titre']; ?></p> 
                        <p><?= $pags[0]['prix']; ?></p>
                        <p><a href="boutique.php?id=<?=$pags[0]['id_produit'];?>"><img style="width:50px; height:50px;" src="./images/panier.jpg" alt="panier"></a></p>
                        </div>
                    <?php
                    }
                    ?>
                <?php    
                ;}
                 else{
                    //var_dump($cat);
                    foreach($cat[0] as $cats[0]) {
                        ?>
                        <div class="containerProduits">
                            <div class="produits">  
                                <img src="<?php print $cats[0]['url']; ?>">
                                <p><?= $cats[0]['titre']; ?></p> 
                                <p><?= $cats[0]['prix']; ?></p>
                                <p><a href="boutique.php?id=<?=$cats[0]['id_produit'];?>"><img style="width:50px; height:50px;" src="./images/panier.jpg" alt="panier"></a></p>
                                </div>
                            <?php
                    }
                    ?>
                <?php    
                }
                ?>

                    </div> 
                </div>
        </div>
        
    </main>
    <div class="centrerpagination">
            <nav class="pagination">
                    <ul>                 <!-- dans cette boucle et cette pagination j'utilise l'appel d'un css par une condition php pour désactiver le bouton suivant et précédent
                        avec l'echo disabled, j'utilise aussi des condition pour générer mon url qui devra prendre la forme suivante : articles.php?page=1 si aucune catégorie n'est selectionné
                        et la forme suivante articles.php?categorie=jul&amp;page=1 si une catégorie est selectionné, si il y a deux infos dans get on utilise &amp; pour les mettre à la suite
                        le echo : "?" me permet d'afficher ce foutu point d'interrogation de l'enfer du cul qui ne doit être présent avant "page=" QUE si il n'y a pas de catégorie selectionné car il ne doit être présent qu'une fois dans l'url après articles.php-->
                        <li class="<?php if($currentPage == '1') {echo "disabled"; } ?>"> 
                            <a href="./boutique.php<?php if(isset($_GET['catégorie']) && !empty($_GET['catégorie'])) {echo "?catégorie=" . $nomcat . $getajout ;} else {echo "?"; }?>page=<?= $currentPage - 1 ?>" > ◄</a>
                        </li>
                        <?php  for($page = 1; $page <= $pages; $page++): ?>
                          <!-- Lien vers chacune des pages (activé si on se trouve sur la page correspondante) https://www.youtube.com/watch?v=dH4xHMFfS6c 28:00-->
                          <li <?= ($currentPage == $page) ? "active" : "" ?>>
                                <a href="./boutique.php<?php if(isset($_GET['catégorie']) && !empty($_GET['catégorie'])) {echo "?catégorie=" . $nomcat . $getajout ;} else {echo "?"; }?>page=<?= $page ?>"><?= $page ?></a>
                            </li>
                        <?php endfor ?>
                          <li class="<?php if($currentPage == $pages) {echo "disabled"; } ?>">
                            <a href="./boutique.php<?php if(isset($_GET['catégorie']) && !empty($_GET['catégorie'])) {echo "?catégorie=" . $nomcat . $getajout ;} else {echo "?"; }?>page=<?php if($currentPage != $pages) { echo $currentPage + 1;} ?>">►</a>
                        </li>
                    </ul>
                </nav>
        </div>


    <?php var_dump($pages); 
     require 'footer.php'; ?>

</body>
</html>
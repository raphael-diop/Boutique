<?php
require ("../back/ModelPanier.php");
$panier = new Panier();
// $verif = $panier->verif();
$message = "";
$message_err = "";
$qtn = 1;

$fix = null;
if(isset($_SESSION["panier"])) {
    $adds = $_SESSION["panier"];
}else{
    $adds = $fix;
}

if(isset($_SESSION["panierPrix"])) {
    $total = $panier->total();
}else{
    $total = 0;
}

if($total >= 500){
    $message = "Livraison Gratuite";
}else{
    $message = "Gratuite à partir de 500 euros d'achats";
}

if(isset($verif)){
    var_dump($verif);
}


if(isset($_POST["supp"])){
    unset($_SESSION["panier"]);
    unset($_SESSION["panierCount"]);
    unset($_SESSION["panierPrix"]);
    // if(!isset($_SESSION["panier"])){
    //     session_start();  
    // }
    
    //var_dump($_SESSION["panier"]["id_produit"]);
}



//unset($_SESSION);
//var_dump($_SESSION["panier"]);
//var_dump($_SESSION["panierCount"]);
// var_dump($_SESSION["panierPrix"]);
//var_dump($_POST["supp"]);
 


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/styleOrdi.css">
    <title>Panier</title>
</head>
<body>

<?php require 'header.php'; ?>
<main>
    <?php 
    if(isset($_SESSION["panier"])){
        echo "<a class = 'PanierButton' href='boutique.php'>Continuer mes achats</a>";
    }   
    ?>
    <div class="containerPanier">
        <section class="PanierBlockGauche">
        <?php if(isset($adds)){
                foreach($adds as $add){   
                ?>
                <div class="ProduitsPanier">
                    <div class="produitPanier">  
                        <img src="<?php print $add['url'] ?>">
                        <div class="produitPanierP">
                            <h2><strong><?= $add['titre']; ?></strong></h2> 
                            <h3><?= $add['prix']; ?> euros</h3>
                            <p>Quantité:
                                <?php
                                    $id_prod = $add['id_produit'];
                                    if(isset($_SESSION["panierCount"][$id_prod])) {echo $_SESSION["panierCount"][$id_prod];}
                                ?>
                            </p> 
                        </div>
                        
                </div>
                    <?php
                    ;}
                    ?>
                <form action="" method="POST">
                    <button type="submit" name="supp" class="supprimer" value="<?= $id_prod?>">
                        Supprimer Mon Panier
                    </button>
                </form>
        <?php
        }else{
            ?>
            <h3>
                Il semble que votre panier traverse une période de grand vide.

                En manque d’inspiration ?
                <a href="boutique.php">Laissez vous guider</a>
            </h3>
            <?php
        }
        ?>
        </section>
        <section class="PanierBlockDroite">
            <figure>
                <h2>Sous-Total: <?= $total ?> €</h2>
                <h2>Livraison: <?= $message; ?></h2>
                <button>
                    <a href="<?php 
                    if(isset($_SESSION['panier'])){
                        if(isset($_SESSION['user'])){
                            echo 'infos.php';
                        }else{echo 'inscription.php';}
                    }else{$message_err = "Panier Vide: Veuillez ajouter des articles";}
                    ?>">
                    Paiement
                    </a>
                </button>
                <p><?php  echo $message_err; ?></p>
                <div>
                    <h3>Nous Acceptons: </h3>
                   <div class="moyenPaiement">
                        <img src="https://lacoupedesfees.com/img/cms/paiements%20s%C3%A9curis%C3%A9s%20paypal.png" alt="">
                   </div>
                </div>
            </figure>
        </section>
    </div>
</main>
<?php require 'footer.php'; ?>
</body>
</html>
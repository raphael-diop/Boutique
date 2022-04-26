<?php
   require ("../back/ModelCommande.php");
   session_start();
   $resum = new Commande();
   $id_client = $_SESSION["user"];
   $resumeComs = $resum->recupCommande($id_client);

   $infos = $resum->infoUser($id_client);
   //var_dump($infos);

   unset($_SESSION["panier"]);
   unset($_SESSION["panierCount"]);
   unset($_SESSION["panierPrix"]);

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/styleOrdi.css">
    <title>Résumé de commande</title>
</head>
<body>
    <?php require "header.php"; ?>
    <h1>
        Merci d'avoir commandé chez nous ! En éspérant cous revoir bientot sur Les nouveaux collectionneurs.
    </h1>
    <h3>Récapitulatif de commande</h3>
    <div>
    <?php 
    if(isset($resumeComs)){
                foreach($resumeComs[0] as $resumeCom[0]) {
                ?>
                <div class="containerProduits">
                    <div class="produits">  
                        <img src="<?php print $resumeCom[0]['url'] ?>">
                        <p><?= $resumeCom[0]['titre']; ?></p> 
                        <p><?= $resumeCom[0]['prix']; ?></p>
                        <p><?= $resumeCom[0]['quantité']; ?></p> 
                    </div>
                        
                    <?php
                    }
                    ?>
                <?php    
                ;}
                ?>
    </div>
    <section>
        <h2>Informations Commandes: </h>
        <div>
    <?php 
        if(isset($infos)){
                foreach($infos as $info) {
                ?>
                <div class="containerProduits">
                    <div class="produits">  
                        <p>Nom : <?= $info['nom']; ?></p>
                        <p>Prenom: <?= $info['prenom']; ?></p> 
                        <p>Email: <?= $info['email'];  ?></p>
                        <p>Tel: <?= $info['téléphone'];  ?></p> 
                        <p>Rue: <?= $info['num et nom de rue'];  ?></p> 
                        <p>Ville: <?= $info['ville'];  ?></p> 
                        <p>Pays: <?= $info['pays'];  ?></p> 
                    </div>
                        
                    <?php
                    }
                    ?>
                <?php    
                ;}
                ?>
    </div>
        <h2>Total Commandes: <?= $resumeComs[1] ?> €</h2>            
    </section>
    <div>
        <a href="index.php">Retour à l'acceuil</a>
    </div>
</body>
</html>
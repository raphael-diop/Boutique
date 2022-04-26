<?php
require ("../back/ModelDoc.php");
require ("../back/ModelCommande.php");
require ("../back/ModelPanier.php");
$docs = new Docs();
$getconf = $docs->getCGV();
$message_pan = "";
$message_error = "";
$message_acc = "";

$panier = new Panier();
if(isset($_SESSION["panier"])) {
  $total = $panier->total();
}else{
  $total = 0;
}

$id_client = $_SESSION["user"];
$paiement = new Commande();
$payer = $paiement->insertBdd($id_client);
//var_dump($_SESSION["panier"]);

if(isset($_POST["titulaire"]) && $_POST["numero"] && $_POST["expiration"] && $_POST["CVV"]){
  $titulaire = htmlspecialchars($_POST["titulaire"]);
  $numero = htmlspecialchars($_POST["numero"]);
  $expiration = htmlspecialchars($_POST["expiration"]);
  $CVV = htmlspecialchars($_POST["CVV"]);

  $id_client = $_SESSION["user"];

  if(strlen($numero) != 16){
    $message_error = "Longeur numero de carte  irrecevable";
  }else if(strlen($CVV) != 3){
    $message_error = "Longeur du CVV irrecevable"; 
  }else if(isset($_SESSION["panier"])){
    
    $message_acc = "Paiement accépté";
    header('Refresh: 3; url=resumeCom.php');
  
  }
  
}
//var_dump($_SESSION["user"]);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/styleOrdi.css">
    <title>Payment</title>
</head>
<body>
  <?php
    //require "header.php";
  ?> 
  <div class="containerCarte">
  <img src="./images/carte bancaire.png" alt="">
    <div class="containerForm">
        <form action="" method="post">
                <input required="required" type="text" id="titulaire" name="titulaire" placeholder="Nom du Titulaire de la carte">
                <input required="required" type="int" id="numero" name="numero" placeholder="Numéros de carte">
                <div>
                  <input required="required" id="int" name="expiration" placeholder="Date Expiration" >
                  <input required="required" id="int" name="CVV" placeholder="CVV" >
                </div>
                  <?php 
                    echo "$message_error";
                    echo "$message_acc";   
                  ?>
                <div>
                  <h3>Politique de Confidentialité </h3>
                  <textarea readonly >
                    <?php
                        echo $getconf['text']; 
                    ?>
                  </textarea>
                </div>
                <div>
                  <h2>Total: <?= $total; ?> €</h2>
                </div>
                <input type="submit" name="paiement" value="Procéder au Paiement">
        </form>
    </div>
  </div>
</body>
  <?php
    require "footer.php";
  ?>  
</html>
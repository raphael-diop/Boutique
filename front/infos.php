<?php
session_start();
require ("../back/ModelDoc.php");
require ("../back/ModelCommande.php");

$docs = new Docs();
$getconf = $docs->getConfid();
var_dump($_SESSION['user']);

if(isset($_POST['nom']) && isset($_POST['prenom']) && isset($_POST['email']) && isset($_POST['tel']) && isset($_POST['nomrue']) && isset($_POST['ville'])&& isset($_POST['pays'])){
        $nom = htmlspecialchars($_POST['nom']);
        $prenom = htmlspecialchars($_POST['prenom']);
        $email = htmlspecialchars($_POST['email']);
        $tel = htmlspecialchars($_POST['tel']);
        $nomrue= htmlspecialchars($_POST['nomrue']);
        $ville = htmlspecialchars($_POST['ville']);
        $pays = htmlspecialchars($_POST['pays']);

        
        $id_client = $_SESSION['user'];
    
        $commande = new Commande();
        $insertion = $commande->getCommande($nom, $prenom, $email, $tel, $nomrue, $ville, $pays, $id_client);
        var_dump($insertion);
        header("location: Payment.php");
        
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/styleOrdi.css">
    <title>Infos</title>
</head>
<body>
      <?php //require "header.php" ?>
    <main class="infoMain">
        
        <section class="infoBlockBas">
            <div class="InfoRGPD">
                <h1>Politique de Confidentialité </h1>
                <textarea readonly >
                <?php
                    echo $getconf['text']; 
                ?>
                </textarea>
            </div>
        </section>
        <section class="infoBlockHaut">
            <div class="infoContact">
                <h2>Informations complémentaires</h2> 
                <form action="infos.php" method="post">
                    <div class="infoContact">
                        <input type="text" required="required" id="nom" name="nom" placeholder="Nom" >
                        <input type="text" required="required" id="prenom" name="prenom" placeholder="Prenom" require>
                        <input type="text" required="required" id="email" name="email" placeholder="Adresse e-mail" require>
                        <input type="text" required="required" id="Tel" name="tel" placeholder="Téléphone" require>
                        <input type="text" required="required" id="nom" name="nomrue" placeholder="Nom et Numéro de rue" require>
                        <input type="text" required="required" id="adresse" name="ville" placeholder="Ville" require>
                        <input type="text" required="required" id="Tel" name="pays" placeholder="Pays" require> 
                        <input type="submit" name="submit" value="Passer au Paiement"> 
                    </div>
            </form>
        </section>
    </main>
</body>
<?= require "footer.php" ?>
</html>
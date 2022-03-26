<?php

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
    require "header.php";
  ?> 
  <div class="containerCarte">
  <img src="./images/carte bancaire.png" alt="">
    <div class="containerForm">
        <form action="" method="post">
            <div>
                <label for="titulaire">Nom titulaire de la carte</label>
                <input type="titulaire" id="titulaire" name="titulaire">
            </div>
            <div>
                <label for="num carte">Numéro de la carte&nbsp;:</label>
                <input type="num carte" id="mail" name="user_mail">
            </div>
            <div>
                <label for="expiration">Date d'expiration</label>
                <textarea id="expiration" name="expiration"></textarea>
            </div>
        </form>
    </div>
  </div>
</body>
  <?php
    require "footer.php";
  ?>  
</html>
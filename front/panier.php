<?php
require ("../back/ModelPanier.php");
$panier = new Panier();
$addpanier = $panier->recupPanier();
var_dump($addpanier);
var_dump($prod_id);
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

<?php //require 'header.php'; ?>
<main>

    <a href="payment.php">va payer </a>
</main>
<?php require 'footer.php'; ?>
</body>
</html>
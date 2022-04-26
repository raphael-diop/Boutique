<?php 
if(isset($_GET["catégorie"]) && empty($_GET["catégorie"])){
    $nomcat = $_GET["catégorie"];
}else{
    $nomcat = $_GET["catégorie"];
}

$cat = $pagination->getCategorie($nomcat);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title></title>
</head>
<body>
<?php
                foreach($cat as $cats) {
                ?>
                <div class="containerProduits">
                    <div class="produits">  
                        <img src="<?php print $cats['url'] ?>">
                        <p><?= $cats['titre']; ?></p> 
                        <p><?= $cats['prix']; ?></p>
                        </div>
                    <?php
                    }
                    ?>
                    </div> 
                </div> 
</body>
</html>
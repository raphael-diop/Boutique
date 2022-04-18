<?php require ("../back/ModelAdmin.php");

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
<?php require 'header.php';?>
    <main>
    <form action="admin.php" method="get">
  <button name="element" type="submit" value="documents">Documents</button>
  <button name="element" type="submit" value="produits">Produits</button>
    </form>
    <?php 
    if((isset($_GET['modif'])) && !empty($_GET['modif'])) {
        $id = $_GET['modif'];
    }
    else {
        $id = null;
    }
    if(isset($_GET['element']) && $_GET['element'] == 'documents' ) { 
        $admincontent = new Admin();
        $getDocs = $admincontent->getAllDoc(); ?>
                <h1>titre</h1>
                <table>
                  <thead>
                      <th>id</th>
                      <th>titre</th>
                      <th>lien</th>

                      
                  </thead>
                  <tbody>
                      <?php
                      foreach($getDocs as $getDoc){
                      ?>
                      <tr>
                      <td data-label="Date"><?=$getDoc['id'] ?></td>
                          <td data-label="Date"><?=$getDoc['titre'] ?></td>
                          <td> <a href="./admin.php?element=document&amp;modif=<?= $getDoc['id']; ?>">modification</a></td> 

                      </tr>

                      <?php
                      //var_dump($getDoc);
                      }
                      ?>
                      </table>
                      <?php } ?>

                      <?php 
    if(isset($_GET['element']) && $_GET['element'] == 'produits' ) {
        $admincontent = new Admin();
        $getProduits = $admincontent->getAllProd();
 ?>
                <h1>titre</h1>
                <table>
                  <thead>
                      <th>id</th>
                      <th>titre</th>
                      <th>lien</th>

                      
                  </thead>
                  <tbody>
                      <?php
                      foreach($getProduits as $getProduit){
                      ?>
                      <tr>
                      <td data-label="Date"><?=$getProduit['id'] ?></td>
                          <td data-label="Date"><?=$getProduit['titre'] ?></td>
                          <td> <a href="./admin.php?element=produits&amp;modif=<?= $getProduit['id']; ?>">modification</a></td> 

                      </tr>

                      <?php
                      //var_dump($getDoc);
                      }
                    }
                      ?>
                      </table>
                      <?php 
                    if($_GET['element'] == 'produits' && $_GET['modif'] !== 0 && !empty($_GET['modif'])) {
                        $admincontent = new Admin();
                        $getProduit = $admincontent->getOneProd($id);  
                        var_dump($getProduit);

                    }?>
                      
                      
    </main>

<?php require 'footer.php'; ?>

</body>
</html>
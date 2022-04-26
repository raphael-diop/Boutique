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
  <button name="element" type="submit" value="utilisateurs">Utilisateurs</button>
  <button name="element" type="submit" value="produits">Produits</button>
  <button name="element" type="submit" value="creerproduit">Créer un produit</button>

    </form>
    <?php 
    var_dump($_SESSION['user']);

    if(empty($_GET['element'])) {
        $_GET['element'] = null;
    }
    if((isset($_POST['document'])) && !empty($_POST['document'])) {
        $contenu = $_POST['document'];
    }
    else {
        $contenu = null;
    }

    if((isset($_GET['modif'])) && !empty($_GET['modif'])) {
        $id = $_GET['modif'];
    }
    else {
        $id = null;
    }
    if(isset($_GET['element']) && $_GET['element'] == 'documents' ) { 
        $admincontent = new Admin();
        $getDocs = $admincontent->getAllDoc(); ?>
                <h1>Documents</h1>
                <table class="tableau-style">
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
                      <?php } 
    ?>
                      <?php 
                      
                      if($_GET['element'] == 'document' && $_GET['modif'] !== 0 && !empty($_GET['modif'])) {
                        $admincontent = new Admin();
                        $getOnedoc = $admincontent->getOneDoc($id);  
                        //var_dump($getOnedoc); ?>
                    <h1>Modification de la documentation</h1>
                    <form method="POST">
                      
                      <textarea name="document" class="texterg">
                      <?php $document = $getOnedoc[0]['text'];
                        echo stripslashes($document); ?>
                      </textarea>

                      <input type="submit" name="modifier" value="Modifier">
                      </form>
                    <?php

                    if(isset($_POST['document']) && isset($_POST['modifier'])  && strlen($contenu) <= 10000) {
                      $contenu = $_POST['document'];
                      $admincontent = new Admin();
                      $modifDoc = $admincontent->modifOneDoc($id, $contenu);
                      }

                    }?>

                    <?php if(isset($_GET['element']) && $_GET['element'] == 'utilisateurs' ) { 
                    $admincontent = new Admin();
                    $getUsers = $admincontent->getAllUser(); ?>
                    <h1>Utilisateurs</h1>
                    <table class="tableau-style">
                    <thead>
                      <th>id</th>
                      <th>login</th>
                      <th>email</th>
                      <th>droits</th>
                      <th>lien</th>

                      
                  </thead>
                  <tbody>
                      <?php
                      foreach($getUsers as $getUser){
                      ?>
                      <tr>
                        <td data-label="Date"><?=$getUser['id'] ?></td>
                          <td data-label="Date"><?=$getUser['login'] ?></td>
                          <td data-label="Date"><?=$getUser['email'] ?></td>
                          <td data-label="Date"><?=$getUser['id_droit'] ?></td>
                          <td> <a href="./admin.php?element=utilisateurs&amp;modif=<?= $getUser['id']; ?>">modification</a></td> 

                      </tr>

                      <?php
                      //var_dump($getDoc);
                      }
                    }
                      ?>
                      </table>

    <?php if($_GET['element'] == 'utilisateurs' && isset($_GET['modif'])) {
        $_GET['modif'] = $id;
        $admincontent = new Admin();
        $getUser = $admincontent->getOneUser($id);
        if(empty($getUser)) {
            $getUser['0']['id_droit'] = " ";
            $getUser['0']['login'] = " ";
            $getUser['0']['email'] = " ";
            echo "Cet utilisateur n'existe pas";
        }?>
        <h1>Modification de l'utilisateur</h1>
        <form method="POST">
                      
                      <label for="login">Login</label>
                      <input type="text" id="login" name="login" class="form-control" value="<?=$getUser['0']['login'] ?>">
           
           
                      <label for="email">email</label>
                      <input type="text" id="email" name="email"  class="form-control" value="<?= $getUser['0']['email'] ?>">
          
                      <label for="id_droits">id_droits</label>
                      <input type="text" id="id_droit" name="id_droit"  class="form-control" value="<?= $getUser['0']['id_droit'] ?>">
   
                      <input type="submit" name="modifier" value="Modifier">
                      <input  type="submit" name="supprimer" value="supprimer" method="POST"> 

              </form>
    <?php if(isset($_POST['modifier']) && !empty($_POST['login']) && !empty($_POST['email']) && !empty($_POST['id_droit'])) {
        $id = $_GET['modif'];
        $login = $_POST['login'];
        $email = $_POST['email'];
        $id_droit = $_POST['id_droit'];
        $admincontent = new Admin();
        $modifUser = $admincontent->modifOneUser($id, $login, $email, $id_droit);

    }
    if(isset($_POST['supprimer']) && $_GET['modif'] !== 0 && !empty($_GET['modif'])) {
        $admincontent = new Admin();
        $deleteUser = $admincontent->deleteOneUser($id);
        unset($_GET);
        
    }
}

    
                      
    if(isset($_GET['element']) && $_GET['element'] == 'produits' ) {
        $admincontent = new Admin();
        $getProduits = $admincontent->getAllProd();
 ?>
                <h1>Liste des produits</h1>
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
                       if((!isset($_GET['modif'])) && empty($_GET['modif'])) {
                        $_GET['modif'] = null;
                    }
                    if($_GET['element'] == 'produits' && $_GET['modif'] !== 0 && !empty($_GET['modif'])) {
                        $admincontent = new Admin();
                        $getProduit = $admincontent->getOneProd($id);
                        $categories = $admincontent->getAllCat();
                        $id_categorie = $getProduit['0']['id_categorie'];
                        $getCatName = $admincontent->getOneCat($id_categorie);
                        var_dump($getCatName[0]);
                        var_dump($getProduit);
                        
                        ?>
                    <h1>Modification d'un produit</h1>
                    <form method="POST">
                    <label for="titre">Titre</label>
                      <input type="text" id="titleprod" name="titleprod" class="form-control" value="<?=$getProduit['0']['titre'] ?>">
                    <label for="titre">Titre</label>
                      <input type="text" id="prixprod" name="prixprod" class="form-control" value="<?=$getProduit['0']['prix'] ?>">
                    <h1></h1>
                    <select name="categorie">
                        <option value="<?= $getCatName[0]['id']?>"><?= $getCatName[0]['categorie']?></option>
                        <?php foreach($categories as $categorie) {           
                        
                        ?>

                        <option  value="<?=$categorie['id']?>"><?=$categorie['categorie']?></option>
                        <?php }?>
                        </select>

                    <p>Description du produit:</p>
                    <textarea id="descriptifprod" name="descriptifprod"><?= $getProduit['0']['descriptif'] ?></textarea> 
                    <textarea id="descriptifprod" name="detailsprod"><?= $getProduit['0']['details'] ?></textarea> 
                    <input type="submit" class="boutonvalidation" name="submit2" value="Etape Suivante">
                    <input  type="submit" name="supprimerprod" value="supprimer" method="POST"> 


                        <?php if(isset($_POST['titleprod']) && isset($_POST['prixprod']) && isset($_POST['descriptifprod']) && isset($_POST['detailsprod']) && isset($_POST['categorie']) ) {
                         $_GET['modif'] = $id;
                         $prix = $_POST['prixprod'];
                         $title = $_POST['titleprod'];
                         $descriptif = $_POST['descriptifprod'];
                         $details = $_POST['detailsprod'];
                         $categorie = $_POST['categorie'];
                         $admincontent = new Admin();
                         $modifOneProd = $admincontent->modifOneProd($id, $prix, $title, $descriptif, $details, $categorie);
                        }
                        if(isset($_POST['supprimerprod'])) {
                        $_GET['modif'] = $id;
                        $admincontent = new Admin();
                        $deleteOneProd = $admincontent->deleteOneProd($id);
                        ?>
                        <script type="text/javascript">
                        document.location.href="admin.php?element=produits"
                        </script>
                        <?php
                        }

                    }

                    
                    if(isset($_GET['element']) && $_GET['element'] == 'creerproduit' ) {
                        $admincontent = new Admin();
                        $categories = $admincontent->getAllCat();
                         ?>
                         <h1>Création d'un produit</h1>
                    <form action="" method="POST">
                                <p>Renseigner le nom du produit:</p>
                            <input type="text" id="titleprod" name="titleprod">
                            <p>Prix</p>
                            <input type="text" id="prixprod" name="prixprod">
                            <h1></h1>
                            <select name="categorie">
                                <?php foreach($categories as $categorie) {?>

                                <option value="<?=$categorie['id']?>"><?=$categorie['categorie']?></option>
                                <?php }?>
                                </select>

                            <p>Description du produit:</p>
                            <textarea id="descriptifprod" name="descriptifprod"></textarea> 
                            <p>Mesures du produit:</p>
                            <textarea id="detailsprod" name="detailsprod"></textarea> 
                            <input type="submit" class="boutonvalidation" name="submit1" value="Etape Suivante">
                        </form>

                    

                    <?php if(isset($_POST['titleprod']) && isset($_POST['prixprod']) && isset($_POST['descriptifprod']) && isset($_POST['detailsprod']) && isset($_POST['categorie']) ) {
                    $prix = $_POST['prixprod'];
                    $title = $_POST['titleprod'];
                    $descriptif = $_POST['descriptifprod'];
                    $details = $_POST['detailsprod'];
                    var_dump($details);
                    $categorie = $_POST['categorie'];
                    $admincontent = new Admin();
                    $addOneProd = $admincontent->addOneProd($prix, $title, $descriptif, $details, $categorie);
                    //var_dump($_POST);
                    //var_dump($prix);


                     } }

                     if(isset($_POST['submit1']) ) {
                        header('Location: ./admin.php?element=imageproduits&name='.$title);}
                    if(isset($_GET['element']) && $_GET['element'] == 'imageproduits') {    
                    ?>
                     <form action="" method="post" enctype="multipart/form-data">
                    <label for="photo">Choisir une image</label>
                    <input type="file" accept="image/png, image/jpeg, image/webp" name="image">
                    <input type="radio" name="typeimage" type="checkbox" id="typeimage" value="1">Ceci est une image produit
                    <input type="radio" name="typeimage" type="checkbox" id="typeimage" value="2">Ceci est une image de mesure
                    <button type="submit" name="addimages">Envoyer</button>
                    </form>


                    <?php
                    $name = $_GET['name'];
                    if(isset($_POST['addimages']) && isset($_POST['typeimage']) && $_FILES['image']['size'] > 0){//la super global FILE correspond à un fichier temporaire stocker dans C:\wamp64\tmp\phpE493.tmp elle contient les détails du fichier (poid, nom ect...)

                        //ces informations sont stocké dans un array (deux dans le cas présent pour faire matcher le nombre de valeur de l'arrêt au nombre de valeur attendu dans la requête mysl et ainsi éviter une erreur) pour être envoyé
                            $dataImage = [
                                'img_link' => './images/' . $_FILES['image']['name'],
                                'img_file' => $_FILES['image']['tmp_name']
                            ];
                            $data = [
                                'img_link' => $dataImage['img_link']
                            ];
                        
                            $typeimage = $_POST['typeimage'];
                            echo $typeimage;
                            $admincontent = new Admin();
                            $imgProd = $admincontent->imgProd($name, $dataImage, $data, $typeimage);

                        }

                    }
                    
                     ?>


                    
                    
                      
                      
    </main>

<?php require 'footer.php'; ?>

</body>
</html>
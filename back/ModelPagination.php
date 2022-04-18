<?php
require ('ModelProduits.php');

class Pagination extends Produits{

    public function __construct(){
        parent::__construct();
    }

    public function pagination(){
        
        // On compte le nombre de produits
        // $getProd = $this->bdd->prepare("SELECT * FROM `produits`");
        // $getProd->execute();
        // $nbrProdTotal = (int)$getProd->rowCount();
        
        $sql = "SELECT COUNT(*) AS nbrProdTotal FROM produits;";
        $query = $this->bdd->prepare($sql);
        $query->execute();
        $result = $query->fetch();

        $nbrProdTotal = (int) $result['nbrProdTotal'];
        
        //Charger le nombre de produits par page
        $nbrProdpage = 5;
      
        //Nombre de pages
        $pages = ceil($nbrProdTotal / $nbrProdpage);
    
        //Calcul de la page courante 
        if(isset($_GET['page']) && !empty($_GET['page'])){
            $currentPage = (int) strip_tags($_GET['page']);
        }else{
            $currentPage = 1;
        }

        //déterminer le premier article qui doit apparaïtre sur chacune des pages
        $premier = ($currentPage * $nbrProdpage) - $nbrProdpage;
        


        // nouvelle requête pour  avoir les articles par 5. En commençant par le $premier article qui doit être sur la page 
        $sql = "SELECT * FROM images INNER JOIN produits WHERE id_produit = produits.id  ORDER BY prix DESC LIMIT $premier, $nbrProdpage;";
        $query = $this->bdd->prepare($sql);
        $query->execute();
        $produits= $query->fetchAll(PDO::FETCH_ASSOC);
        return array ($produits, $pages,$currentPage, $result['nbrProdTotal']);
        
    }

    public function getCategorie($nomcat) {
        //Récupération de l'id_categorie en fonction du nom
        $getId = $this->bdd->prepare("SELECT `id` FROM `categories` WHERE  `categorie` = '$nomcat'");
        $getId->execute();
        $getId = $getId->fetch(PDO::FETCH_ASSOC);
    


        $sql = "SELECT COUNT(*) AS nbrProdTotal FROM produits WHERE  `categorie` = '$nomcat';"; //verfier la query
        $query = $this->bdd->prepare($sql);
        $query->execute();
        $result = $query->fetch();

        $nbrProdTotal = (int) $result['nbrProdTotal'];

        $nbrProdpage = 5;
        $pages = ceil($nbrProdTotal / $nbrProdpage);

        if(isset($_GET['page']) && !empty($_GET['page'])){
                $currentPage = (int) strip_tags($_GET['page']);
        }else{
                $currentPage = 1;
        }
        $premier = ($currentPage * $nbrProdpage) - $nbrProdpage;

        $getCat = $this->bdd->prepare("SELECT*FROM images INNER JOIN produits ON id_produit = produits.id INNER JOIN categories ON produits.id_categorie = categories.id WHERE categories.id= $getId[id]");
        $getCat -> execute();
        $produits= $getCat->fetchAll(PDO::FETCH_ASSOC);

        return array ($produits, $pages,$currentPage, $result['nbrProdTotal']);
    }
}
?>
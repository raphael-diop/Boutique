<?php
require ('ModelProduits.php');

class Pagination extends Produits{

    public function __construct(){
        parent::__construct();
    }

    public function pagination(){
        // On compte le nombre de produits
        $getProd = $this->bdd->prepare("SELECT * FROM `produits`");
        $getProd->execute();
        $nbrProdTotal = (int)$getProd->rowCount();
        
        
        //Charger le nombre de produits par page
        $nbrProdpage = 5;
        global $nbrProdTotal;
        global $currentPage;

        //Nombre de pages
        $pages = ($nbrProdTotal/$nbrProdpage);
        global $pages;

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
        return $produits;
    }

    public function categorie() {
        $getProd = $this->bdd->prepare("SELECT * FROM `produits`");
        $getProd->execute();
        $nbrProdTotal = (int)$getProd->rowCount();
        global $nbrProTotal;
        
        
        //Charger le nombre de produits par page
        $nbrProdpage = 5;
        global  $nbrProdpage;

        //Calcul de la page courante 
        if(isset($_GET['categorie']) && !empty($_GET['categorie'])){
            $currentPage = (int) strip_tags($_GET['categorie']);
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
        return $produits;
    }
}
?>
<?php
require ('Model.php');

class Produits extends Model{

    public function __construct(){
        parent::__construct();

    }

    public function getAllProd(){
    $getProd = $this->bdd->prepare("SELECT * FROM `images`INNER JOIN `produits` WHERE id_produit = produits.id");
    $getProd->execute();
    $getProduit = $getProd->fetchall(PDO::FETCH_ASSOC);
    return $getProduit;
    }

    //Pour la page acceuil
    public function getBestSellers(){
        $getBestProd = $this->bdd->prepare("SELECT * FROM `images`INNER JOIN `produits` WHERE id_produit = produits.id ");
        $getBestProd->execute();
        $getBestProduit = $getBestProd->fetchall(PDO::FETCH_ASSOC);
        return $getBestProduit; 
    }

    public function insertProd(){

    }

    public function deleteProd(){

    }


}


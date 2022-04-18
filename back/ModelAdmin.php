<?php
require ('Model.php');

class Admin extends Model{

    
    
    public function __construct(){
        parent::__construct();
    }

    public function getAllDoc(){
        $getDoc = $this->bdd->prepare("SELECT * FROM `documents`");
        $getDoc->execute();
        $getDocs = $getDoc->fetchall(PDO::FETCH_ASSOC);
        //var_dump($getDoc);
        return $getDocs;
    }

    public function getAllProd(){
        $getProd = $this->bdd->prepare("SELECT * FROM `produits`");
        $getProd->execute();
        $getProduits = $getProd->fetchall(PDO::FETCH_ASSOC);
        return $getProduits;
        }

    public function getOneProd($id){
        $getOneProd = $this->bdd->prepare("SELECT * FROM `images`INNER JOIN `produits` WHERE id_produit = produits.id AND id_produit = $id");
        $getOneProd->execute();
        $getProduit = $getOneProd->fetchall(PDO::FETCH_ASSOC);
        return $getProduit;
        }

        

    
}
?>
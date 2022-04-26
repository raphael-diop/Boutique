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

    //Pour la page accueuil
    public function getBestSellers(){
    $getBestProd = $this->bdd->prepare("SELECT * FROM images INNER JOIN produits WHERE id_produit = produits.id ");
    $getBestProd->execute();
    $getBestProduit = $getBestProd->fetchall(PDO::FETCH_ASSOC);
    return $getBestProduit; 
    }

    public function insertProd(){
    }

    public function deleteProd(){
    }

    //Récupère un produit par id
    public function getProd(){
    $fix = null;
    if(isset($_GET['id_produit'])){
        $idProd = $_GET['id_produit'];
    }else{
        $idProd = $fix;
    }
    $findProd = $this->bdd->prepare("SELECT * FROM images INNER JOIN produits ON id_produit = produits.id WHERE produits.id = '$idProd' AND id_mesure = 1");
    $findProd->execute();
    $getOneProd = $findProd->fetchAll(PDO::FETCH_ASSOC);
    return $getOneProd;
    }

    //Récupère image id_mesure 2
    public function getProdDetailsImg(){
    $fix = null;
    if(isset($_GET['id_produit'])){
        $idProd = $_GET['id_produit'];
    }else{
        $idProd = $fix;
    }
    $findImg = $this->bdd->prepare("SELECT * FROM images INNER JOIN produits ON id_produit = produits.id WHERE produits.id = '$idProd' AND id_mesure = 2");
    $findImg->execute();
    $getDetailsImg = $findImg->fetchAll(PDO::FETCH_ASSOC);
    return $getDetailsImg;
    }

}
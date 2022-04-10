<?php
session_start();

class Panier {

    public function __construct(){
         $bdd;
         $this->bdd=new PDO('mysql:host=localhost;dbname=boutique;charset=utf8','root','');
        
    
    }

    public function verif(){
        // Vérification que le produit existe
        if(isset($_GET["id"])){
            $id = $_GET["id"];
            $verif = $this->bdd->prepare("SELECT id FROM produits WHERE id = $id");
            $verif->execute();
            $verification = $verif->rowCount(PDO::FETCH_ASSOC);
                //Si verif true on ajoute le produit a la _SESSION["panier"]
                if($verification != 0){
                    $prod = $this->bdd->prepare("SELECT id FROM produits WHERE id = $id");
                    $prod->execute();
                    $prod_id = $prod->fetch(PDO::FETCH_ASSOC);
                    $_SESSION["panier"][] = $prod_id;
                    //ajouter message de confirmation.
                    echo "Porduit a été ajouté au panier";
                }else{
                    echo "Verification failed";
                }

                return $verification;
        } 
    }

    public function recupPanier(){
        $ids = $_SESSION["panier"];
        // foreach($ids as $id){
        //     $ids;
        // }
        // $ids = implode(',' , $ids);
        // $prod = $this->bdd->prepare(" SELECT*FROM produits WHERE id = '$ids' ");
        // $prod->execute();
        // $produits = $prod->fetchAll(PDO::FETCH_ASSOC);
        return $ids;
    }

}



?>
<?php
session_start();
//session_destroy();
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
                    $prod = $this->bdd->prepare("SELECT url,titre,prix,id_produit FROM images INNER JOIN produits ON id_produit = produits.id INNER JOIN categories ON produits.id_categorie = categories.id WHERE produits.id = $id");
                    $prod->execute();
                    $prods = $prod->fetch(PDO::FETCH_ASSOC);
                    $_SESSION["panierPrix"][] = $prods;
                   
                    $id_prod = $prods['id_produit'];
                    if(isset($_SESSION["panierCount"][$id_prod])){
                        $_SESSION["panierCount"][$id_prod] ++ ;
                    }else{
                        $_SESSION["panierCount"][$id_prod] = 1;
                    }

                    if($_SESSION["panierCount"][$id_prod] > 1){

                    }else{
                        $_SESSION["panier"][] = $prods;
                    }
                    return array($prods);

                    //ajouter message de confirmation.
                    echo "Porduit a été ajouté au panier";
                }else{
                    echo "Verification failed";
                }
                        
        }
        
    }


    public function total() {
        $paniers = $_SESSION["panierPrix"];
        $total = 0;

        foreach($paniers as $p => $prix) {
            $total += $prix['prix'];
        }
        
        return ($total);
    }

}



?>
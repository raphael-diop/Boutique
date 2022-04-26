<?php
class Commande{
    protected $bdd;

    public function __construct(){
        $this->bdd=new PDO('mysql:host=localhost;dbname=boutique;charset=utf8','root','');
    }

    public function getCommande($nom, $prenom, $email, $tel, $nomrue, $ville, $pays, $id_client){
        $sql = $this->bdd->prepare("INSERT INTO `commandes` ( `nom`, `prenom`, `email`, `téléphone`, `num et nom de rue`, `ville`, `pays`, `id_client`) VALUES (:nom, :prenom, :email, :tel, :nomrue, :ville, :pays, :id_client)");
        $sql -> execute(array(':nom' => $nom, ':prenom' => $prenom, ':email' => $email, ':tel' => $tel, ':nomrue' => $nomrue, ':ville' => $ville, ':pays' => $pays, ':id_client' => $id_client ));
        $result = $sql -> fetch(PDO::FETCH_ASSOC);
    }
    
    public function infoUser($id_client){
        $recup = $this->bdd->prepare("SELECT * FROM `commandes` WHERE `id_client` = :id_client");
        $recup -> execute(array(':id_client' => $id_client));
        $recuperation = $recup -> fetchAll(PDO::FETCH_ASSOC);
        return $recuperation;
    }

    public function insertBdd($id_client){
        $recup = $this->bdd->prepare("SELECT `id` FROM `commandes` WHERE `id_client` = '$id_client'");
        $recup -> execute();
        $id_comm = $recup -> fetch(PDO::FETCH_ASSOC);
        //var_dump($id_commande);
        //var_dump($_SESSION['panier']);
        //var_dump(in_array( '11',(array_column($_SESSION['panier'],'id_produit'))));
        $counts = $_SESSION['panierCount'];
        //var_dump($id_prod);

        foreach ($counts as $count){
            $quant[] = $count;
        }
        for ($i=0; $i < count($quant); $i++) { 
            $_SESSION['panier'][$i]['quantité'] = $quant[$i];
        }

        $paniers = $_SESSION['panier'];
        $id_commande = rand(5,30);
        
    
        for($i=0; $i < count($paniers); $i++)
        {
            $id_produit = $paniers[$i]['id_produit'];
            $quantité = $paniers[$i]['quantité'];
            $insert = $this->bdd->prepare("INSERT INTO `produitcom` ( `id_produits`, `id_commande`, `quantité`, `id_client`)  VALUES ('$id_produit', '$id_commande', '$quantité', '$id_client')");
            $insert -> execute();
            //var_dump($panier);
        }
        var_dump($paniers);

        // return $recuperation;
    }

    public function recupCommande($id_client){
        $prod = $this->bdd->prepare("SELECT url,titre,prix,quantité,id_produit FROM images INNER JOIN produits ON id_produit = produits.id INNER JOIN produitcom ON produits.id = id_produits WHERE id_client = :id_client");
        $prod->execute([ ':id_client' => $id_client]);
        $prods = $prod->fetchAll(PDO::FETCH_ASSOC);

        $total = 0;
        foreach($prods as $p => $prix) {
            $total += $prix['prix'];
        }

        return array($prods, $total);   
    }
}
?>
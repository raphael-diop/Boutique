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

    public function getOneDoc($id){
        $getDoc = $this->bdd->prepare("SELECT * FROM `documents` WHERE `id` = $id");
        $getDoc->execute();
        $getOneDoc = $getDoc->fetchall(PDO::FETCH_ASSOC);
        //var_dump($getDoc);
        return $getOneDoc;
    }

    public function modifOneDoc($id, $contenu){

        $contenu = addslashes($contenu);
        //$this->bdd->quote($contenu);
        $modifDoc = $this->bdd->prepare("UPDATE documents SET text = '$contenu' WHERE id = $id");
        $modifDoc->execute();
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

    public function modifOneProd($id, $prix, $title, $descriptif, $categorie){
        $prix = addslashes($prix);
        $title = addslashes($title);
        $descriptif = addslashes($descriptif);
        $modifProd = $this->bdd->prepare("UPDATE produits SET prix = '$prix', titre = '$title', descriptif = '$descriptif', id_categorie = '$categorie'  WHERE id = $id");
        $modifProd->execute();
        $modifOneProd = $modifProd->fetchall(PDO::FETCH_ASSOC);
        return $modifOneProd;
        }

    public function addOneProd($prix, $title, $descriptif, $categorie){
        $prix = addslashes($prix);
        $title = addslashes($title);
        $descriptif = addslashes($descriptif);
        $request = "SELECT titre FROM `produits` WHERE titre = '$title'";
        $calcul = $this->bdd->prepare($request);
        $calcul -> execute();
        $result = $calcul->rowCount();
        //var_dump($calcul);

        if(($result) == 1){
        $messNewProd = "Le nom du produit doit être unique, réessayez avec un autre nom.";
    }
        else {
            $requetesql1 = "INSERT INTO `produits` (`prix`, `titre`, `descriptif`, `id_categorie`) VALUES ('$prix', '$title', '$descriptif', '$categorie')";
        $calcul1 = $this->bdd->prepare($requetesql1);
        $calcul1 -> execute();
        $messNewProd = "Première étape réussi";
        }
        return $title;
    

        }

    public function imgProd($name, $dataImage, $data, $typeimage){
        echo $name;
        $calculid = $this->bdd->prepare("SELECT id FROM `produits` WHERE titre = '$name'");
        $calculid -> execute();
        $id_Art = $calculid->fetchall(PDO::FETCH_ASSOC);
        $idArt = $id_Art['0']['id'];


        if(mime_content_type($dataImage['img_file']) == "image/jpeg" || mime_content_type($dataImage['img_file']) == "image/png" || mime_content_type($dataImage['img_file']) == "image/webp") {
            move_uploaded_file($dataImage['img_file'], $dataImage['img_link']); //https://www.php.net/manual/fr/function.move-uploaded-file.php la première variable 'imgfile' est le from, la seconde 'imglink' est le to, la fonction moveupladedfile déplace from, to. Ainsi le fichier temp va du dossier tmp de l'ordinateur au chemin indiqué dans to (imglink) donc le dossier image qui a été choisi.
            $addImage = $this->bdd->prepare("INSERT INTO images (link, id_produit, id_mesure) VALUES (:img_link, $idArt, $typeimage)");
            $addImage->execute($data);
            }


    }

    public function deleteOneProd($id) {
        $deleteOneProd = $this->bdd->prepare("DELETE FROM produits WHERE id=$id");
        $deleteOneProd->execute();
    }

    //public function modifImgProd($name,)
        

        public function getAllCat(){
        $getCat = $this->bdd->prepare("SELECT `categorie`, `id`  FROM `categories`");
        $getCat->execute();
        $getAllCat = $getCat->fetchall(PDO::FETCH_ASSOC);
        return $getAllCat;
        }

        public function getOneCat($id_categorie){
        $getCat = $this->bdd->prepare("SELECT * FROM `categories` WHERE `id` = $id_categorie");
        $getCat->execute();
        $getCatName = $getCat->fetchall(PDO::FETCH_ASSOC);
        return $getCatName;
        var_dump($getCatName);
        }


        
        public function getAllUser(){
        $getUser = $this->bdd->prepare("SELECT * FROM `users`");
        $getUser->execute();
        $getUsers = $getUser->fetchall(PDO::FETCH_ASSOC);
        return $getUsers;
    }

    public function getOneUser($id){
        $getOneUser = $this->bdd->prepare("SELECT * FROM `users` WHERE `id` = $id");
        $getOneUser->execute();
        $getUser = $getOneUser->fetchall(PDO::FETCH_ASSOC);
        //var_dump($getDoc);
        return $getUser;
    }

    public function modifOneUser($id, $login, $email, $id_droit){
        $modifUser = $this->bdd->prepare("UPDATE users SET login = '$login', email = '$email', id_droit = '$id_droit' WHERE id = $id");
        $modifUser->execute();
    }

    public function deleteOneUser($id){
        $deleteUser = $this->bdd->prepare("DELETE FROM users WHERE id=$id");
        $deleteUser->execute();
    }



    

        

    
}
?>
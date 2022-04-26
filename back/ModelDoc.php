<?php
require ("../back/Model.php");


class Docs extends Model{

    public function __construct(){
        parent::__construct();

    }

    public function getAllDoc(){
        $id = $_GET['doc'];
        $getDoc = $this->bdd->prepare("SELECT * FROM `documents` WHERE `id` = '$id'");
        $getDoc->execute();
        $getDocs = $getDoc->fetchall(PDO::FETCH_ASSOC);
        //var_dump($getDoc);
        return $getDocs;
    }

}
?>



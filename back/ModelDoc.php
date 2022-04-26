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

    public function getConfid(){
        $getconf = $this->bdd->prepare("SELECT * FROM `documents` WHERE `id` = :id");
        $getconf -> execute(array(':id' => 5));
        $getconfid = $getconf->fetch(PDO::FETCH_ASSOC);
        return $getconfid;
    }

    public function getCGV(){
        $getconf = $this->bdd->prepare("SELECT * FROM `documents` WHERE `id` = :id");
        $getconf -> execute(array(':id' => 2));
        $getconfid = $getconf->fetch(PDO::FETCH_ASSOC);
        return $getconfid;
    }

}
?>
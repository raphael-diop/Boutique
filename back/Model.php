<?php

abstract class Model{
public $bdd;

function __construct(){

    $this->bdd=new PDO('mysql:host=localhost;dbname=boutique;charset=utf8','root','');

}

}
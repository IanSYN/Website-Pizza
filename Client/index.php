<?php

$objet = "accueil";
$action = "Afficher";
$objets = ["accueil","produit"];
$actions = ["afficherProduit","afficher"];

if(isset($_GET['objet']) && in_array($_GET['objet'],$objets)){
    $objet = $_GET['objet'];
}

if(isset($_GET['action']) && in_array($_GET['action'],$actions)){
    $action = $_GET['action'];
}

$controller = "controller".ucfirst($objet);
$action = ucfirst($action);

require_once ("controller/$controller.php");
require_once ("config/connexion.php");
connexion::connect();
$controller::$action();
?>
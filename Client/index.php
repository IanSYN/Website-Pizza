<?php

$objet = "accueil";
$action = "AfficherAccueil";
$objets = ["accueil","connexion","produit","panier", "gestionnaire", "info"];
$actions = ["afficherProduit","afficher","afficherAccueil", "afficherConnexion", "afficherPageGestionnaire", "afficherPage", "afficherOne"];

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
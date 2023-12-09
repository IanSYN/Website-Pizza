<?php
$objet = "pizza";
//$objets = ["adherent", "serie" , "auteur" , "nationalite" , "bd" , "categorie" , "etat"];
//$actions = ["displayAll", "displayOne" , "delete"];

if(isset($_GET["objet"]) && in_array($_GET["objet"], $objets)){
    $objet = $_GET["objet"];
}

$action = "displayAll";
if(isset($_GET["action"]) && in_array($_GET["action"], $actions)){
    $action = $_GET["action"];
}

$controller = "controller".ucfirst($objet);
require_once ("../controller/$controller.php");
require_once ("../config/connexion.php");
connexion::connect();
$controller::$action();
?>

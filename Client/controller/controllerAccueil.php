<?php
require_once('controllerDefaut.php');
require_once('model/VPizza.php');
require_once('model/Categorie.php');
require_once('model/Produit.php');
require_once('model/VProduit.php');
class controllerAccueil extends controllerDefaut{

    protected static $classeC = 'Categorie';
    protected static $identifiantC = 'idCategorie';
    protected static $classeP = 'VProduit';
    protected static $identifiantP = 'idProduit';
}
?>
<?php
require_once('controllerDefaut.php');
require_once('model/Produit.php');
class controllerProduit extends controllerDefaut{
    protected static $classe = 'Produit';
    protected static $identifiant = 'idProduit';
}
?>
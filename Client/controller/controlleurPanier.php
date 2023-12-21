<?php
require_once('controllerDefaut.php');
require_once('model/Panier.php');
class controllerPanier extends controlleurDefaut{

    protected static $identifiant = "idCommande";
    protected static $classe = 'Panier';
}
?>
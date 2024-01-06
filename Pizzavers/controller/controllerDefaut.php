<?php
require_once('model/Pizza.php');
require_once('model/Produit.php');
require_once('model/VPizza.php');
require_once('model/VProduit.php');
require_once('model/Gestionnaire.php');
require_once('model/Client.php');
require_once('model/VPanier.php');

class controllerDefaut{

    public static function AfficherErreur403() {
        require_once('view/deb.html');
        require_once('view/menu.php');
        require_once('view/erreur403.html');
        require_once('view/fin.html');
    }
}
?>
<?php
require_once('controllerDefaut.php');
require_once('model/VPizza.php');
require_once('model/Categorie.php');
require_once('model/Produit.php');
require_once('model/VProduit.php');
class controllerAccueil extends controllerDefaut{

    protected static $classeC = 'Categorie';
    protected static $identifiantC = 'idCategorie';
    protected static $classe = 'VProduit';
    protected static $identifiant = 'idProduit';

    public static function afficherOne(){
        $id = $_GET[static::$identifiant];
        $classCat = static::$classeC;
        $classProd = static::$classe;
        require_once('view/deb.html');
        require_once('view/menu.php');
        $unProd = $classProd::getOne($id);
        require_once('view/list.php');
        require_once('view/fin.html');
    }
}
?>
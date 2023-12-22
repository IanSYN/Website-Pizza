<?php
require_once('model/Pizza.php');
require_once('model/Produit.php');
require_once('model/VPizza.php');
require_once('model/VProduit.php');

class controllerDefaut{

    public static function Afficher(){
        $title = static::$classe;
        if(isset($_GET[static::$identifiant])){
            $id = $_GET[static::$identifiant];
        }
        else{
            $id = 1;
        }
        $classe = static::$classe;
        require_once('view/deb.html');
        require_once('view/menu.html');
        $tableau = $title::getOne($id);
        require_once('view/unProduit.php');
        require_once('view/fin.html');
    }

    public static function AfficherProduit(){
        $class = static::$classe;
        require_once('view/deb.html');
        require_once('view/menu.html');
        $tableau = $class::getAll();
        require_once('view/produit.php');
        require_once('view/fin.html');
    }

    public static function AfficherAccueil(){
        $classCat = static::$classeC;
        $classProd = static::$classeP;
        require_once('view/deb.html');
        require_once('view/menu.html');
        $listCate = $classCat::getAll();
        $listProd = $classProd::getAll();
        require_once('view/Accueil.php');
        require_once('view/fin.html');
    }
}
?>
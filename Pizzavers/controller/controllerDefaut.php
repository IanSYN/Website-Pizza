<?php
require_once('model/Pizza.php');
require_once('model/Produit.php');
require_once('model/VPizza.php');
require_once('model/VProduit.php');
require_once('model/Gestionnaire.php');
require_once('model/Client.php');
require_once('model/VPanier.php');

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
        require_once('view/menu.php');
        $tableau = $title::getOne($id);
        require_once('view/unProduit.php');
        require_once('view/fin.html');
    }

    public static function AfficherProduit(){
        $class = static::$classe;
        require_once('view/deb.html');
        require_once('view/menu.php');
        $tableau = $class::getAll();
        require_once('view/produit.php');
        require_once('view/fin.html');
    }

    public static function AfficherAccueil(){
        $identifiant = static::$identifiant;
        $classCat = static::$classeC;
        $classProd = static::$classe;
        require_once('view/deb.html');
        require_once('view/menu.php');
        $listCate = $classCat::getAll();
        $listProd = $classProd::getAll();
        require_once('view/Accueil.php');
        require_once('view/fin.html');
    }

    public static function AfficherErreur403() {
        require_once('view/deb.html');
        require_once('view/menu.php');
        require_once('view/erreur403.html');
        require_once('view/fin.html');
    }
}
?>
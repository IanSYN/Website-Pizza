<?php
require_once('model/Pizza.php');
require_once('model/Produit.php');
require_once('model/VPizza.php');

class controlleurDefaut{

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
        require_once('view/Accueil.php');
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
}
?>
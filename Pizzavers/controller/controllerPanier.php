<?php
require_once('controllerDefaut.php');
require_once('model/Panier.php');
class controllerPanier extends controllerDefaut{

    protected static $identifiant = "idCommande";
    protected static $classe = 'VPanier';
    public static function AjoutePanier(){
        $identifiant = static::$identifiant;
        $classe = static::$classe;

        require_once('view/Panier/debPanier.html');
        require_once('view/menu.php');
        require_once('view/Panier/Panier.php');
        require_once('view/fin.html');
    }

    public static function AfficherPanier(){
        $identifiant = static::$identifiant;
        $classe = static::$classe;
        
        if(isset($_GET[static::$identifiant])){
            $id = $_GET[static::$identifiant];
        }
        else{
            $id = NULL;
        }

        require_once('view/Panier/debPanier.html');
        require_once('view/menu.php');
        $value = $classe::getPanier($id);
        require_once('view/Panier/Panier.php');
        require_once('view/fin.html');
    }
}
?>
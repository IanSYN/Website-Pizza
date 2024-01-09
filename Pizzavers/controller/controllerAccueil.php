<?php
require_once('controllerDefaut.php');
require_once('model/VPizza.php');
require_once('model/Categorie.php');
require_once('model/VPanier.php');
require_once('model/VProduit.php');
require_once('model/Produit.php');
require_once('model/Ingredient.php');
//require_once('model/Base.php');
class controllerAccueil extends controllerDefaut{

    protected static $classeC = 'Categorie';
    protected static $identifiantC = 'idCategorie';
    protected static $classe = 'VProduit';
    protected static $identifiant = 'idProduit';
    protected static $classeP = 'VPanier';
    protected static $identifiantP = 'idClient';

    public static function AfficherOne(){
        $id = $_GET[static::$identifiant];
        $identifiant = static::$identifiant;
        $classCat = static::$classeC;
        $classProd = static::$classe;
        require_once('view/UnProd/debOne.html');
        require_once('view/menu.php');
        $unProd = $classProd::getOne($id);
        $listProd = Ingredient::getAll();
        //$listQtnIngr = Base::getIngreAll();
        require_once('view/UnProd/unProd.php');
        require_once('view/fin.html');
    }
    public static function AfficherAjoute(){
        $id = $_GET[static::$identifiant];
        $classPan = static::$classeP;
        $classCat = static::$classeC;
        $classProd = static::$classe;
        require_once('view/UnProd/debOne.html');
        require_once('view/menu.php');
        //$val = $classPan::AjoutePanier($id);
        require_once('view/unProdAjoute.php');
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
        $AlAffiche = Produit::getAffiche();
        require_once('view/Accueil/Accueil.php');
        require_once('view/fin.html');
    }
}
?>
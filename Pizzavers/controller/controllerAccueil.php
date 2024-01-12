<?php
require_once('controllerDefaut.php');
require_once('model/VPizza.php');
require_once('model/Categorie.php');
require_once('model/VPanier.php');
require_once('model/VProduit.php');
require_once('model/Produit.php');
require_once('model/Commande.php');

require_once('model/VIngrBase.php');
require_once('model/VAllergenePizza.php');


class controllerAccueil extends controllerDefaut{

    protected static $classeC = 'Categorie';
    protected static $identifiantC = 'idCategorie';
    protected static $classe = 'VProduit';
    protected static $identifiant = 'idProduit';
    protected static $classeP = 'VPanier';
    protected static $identifiantP = 'idClient';
    //protected static $identifiantB = 'idPizza';
    //protected static $identifiantCI = 'idIngredient';


    public static function AfficherOne(){
        $id = $_GET[static::$identifiant];
        //$id1 = static::$identifiantB;
        //$id2 = static::$identifiantCI;
        $identifiant = static::$identifiant;
        $classCat = static::$classeC;
        $classProd = static::$classe;
        require_once('view/UnProd/debOne.html');
        require_once('view/menu.php');
        $unProd = $classProd::getOne($id);
        $lstIngr = VIngrBase::getOneVIngrBase($id);
        $lstAllergene = VAllergenePizza::getOneVAP($id);
        //$listQtnIngr = Base::getIngreAll();
        require_once('view/UnProd/unProd.php');
        //require_once('view/test.php');
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
    public static function SuivreCommande() {
        $idClient = $_SESSION["idClient"];
        $commandes = Commande::getCommandeClient($idClient);
        require_once('view/Accueil/debSuivie.html');
        require_once('view/menu.php');
        require_once('view/Accueil/suivreCommande.php');
        require_once('view/fin.html');
    }
}
?>
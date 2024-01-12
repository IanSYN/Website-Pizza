<?php
require_once('controllerDefaut.php');
require_once('controllerPanier.php');
require_once('model/session.php');
require_once('model/VIngrPersonnalisee.php');
require_once('model/Ingredient.php');
require_once('model/VPanier.php');
require_once('model/Commande.php');

class controllerPersonnalisation extends controllerDefaut{

    protected static $identifiant = "idClient";
    protected static $identifiantB = "idProduit";
    protected static $identifiantC = "idIngredient"; //
    protected static $identifiantD = "idCommande"; //
    protected static $classe = 'VIngrPersonnalisee';
    protected static $classeCmd = 'VPanier';
    

    public static function AfficherIngr(){
        $id2 = $_GET[static::$identifiantB];
        $identifiantB = static::$identifiantB;
        // Cas où aucun client n'est connecté
        // on le renvoie vers la page de connexion
        if (!(session::clientConnected())){
            controllerConnexion::AfficherConnexion();
        }
        else {
            $identifiant = static::$identifiantB;
            $classe = static::$classe;
            $id = $_SESSION["idClient"];
            require_once('view/UnProd/debOne.html');
            require_once('view/menu.php');
            VIngrPersonnalisee::getOnePersonnalisation($id2, $id);
            require_once('view/UnProd/unProd.php');
            require_once('view/fin.html');
        }

    }

    public static function AjoutePersonnalisation(){
        $tabIngre = ingredient::getAll();
        if (!(session::clientConnected())){
            controllerConnexion::AfficherConnexion();
        }else{
            $identifiant = static::$identifiant;
            $classe = static::$classe;
            $id = $_SESSION["idClient"];
            $idProd = $_GET["idProduit"];
            $unProd = Produit::getOne($idProd);
            require_once('view/UnProd/debOne.html');
            require_once('view/menu.php');
            require_once('view/Personnalisation/UnePersonnalisation.php');
        }
    }

    public static function ajouterPP(){
        $valide = false;
        $idClient = $_SESSION["idClient"];
        $idProd = $_GET["idProduit"];

        $quantite = array();
        $ingre0 = $_POST['ingre0'];
        $ingre1 = $_POST['ingre1'];
        $ingre2 = $_POST['ingre2'];
        $ingre3 = $_POST['ingre3'];
        $ingre4 = $_POST['ingre4'];
        $ingre5 = $_POST['ingre5'];
        $ingre6 = $_POST['ingre6'];
        $ingre7 = $_POST['ingre7'];
        $ingre8 = $_POST['ingre8'];
        $ingre9 = $_POST['ingre9'];
        $ingre10 = $_POST['ingre10'];
        $ingre11 = $_POST['ingre11'];
        $quantite = array(Null, $ingre0, $ingre1, $ingre2, $ingre3, $ingre4, $ingre5, $ingre6, $ingre7, $ingre8, $ingre9, $ingre10, $ingre11);
        $idCmd = Commande::idPanier($idClient);
        VIngrPersonnalisee::AjoutePanier($idProd, $idCmd, $quantite);
        controllerPanier::AfficherPanier();
    }
}
?>
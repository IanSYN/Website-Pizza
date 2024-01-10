<?php
require_once('controllerDefaut.php');
require_once('controllerConnexion.php');
require_once('model/VPanier.php');
require_once('model/session.php');
require_once('model/PaiementCB.php');
require_once('model/Commande.php');

class controllerPanier extends controllerDefaut{

    protected static $identifiant = "idClient";
    protected static $classe = 'VPanier';
    protected static $paiement = 'PaiementCB';

    public static function AjoutePanier(){
        $identifiant = static::$identifiant;
        $classe = static::$classe;
        $id = $_SESSION["idClient"];
        $idProd = $_GET["idProduit"];
        $idPanier = Commande::idPanier($id);
        $classe::AjoutePanierProduit($idPanier, $idProd);
        self::AfficherPanier();
        //require_once('view/test.php');
    }

    public static function AfficherPanier(){

        // Cas où aucun client n'est connecté
        // on le renvoie vers la page de connexion
        if (!(session::clientConnected())){
            controllerConnexion::AfficherConnexion();
        }
        else {
            $identifiant = static::$identifiant;
            $classe = static::$classe;
            $id = $_SESSION["idClient"];

            require_once('view/Panier/debPanier.html');
            require_once('view/menu.php');
            //$PizValue = $classe::getPanierPizza($id);
            $value = $classe::getPanierProduit($id);
            require_once('view/Panier/Panier.php');
            require_once('view/fin.html');
        }

    }

    public static function PagePaiement(){
        require_once('view/paiement/debpaiement.html');
        require_once('view/paiement/paiement.php');
    }

    public static function Payer(){
        if(isset($_POST['boutonPayer'])){
            $NCard = $_POST['NCard'];
            $Crypto = $_POST['Crypto'];
            $Date = $_POST['Date'];
            $Nom = $_POST['Nom'];
            $id = $_SESSION["idClient"];
            
            $classe = static::$paiement;
            if($classe::payer($id, $NCard, $Crypto, $Date, $Nom)){
                require_once('view/paiement/debpaiement.html');
                require_once('view/paiement/valider.html');
            }
            else{
                require_once('view/paiement/debpaiement.html');
                require_once('view/paiement/refuser.html');
            }
            
        }
    }

    public static function SupprimerPanier(){
        $identifiant = static::$identifiant;
        $classe = static::$classe;
        $idcmd = $_GET["idCommande"];
        $idProd = $_GET["idProduit"];;
        $classe::SupprimerPanierProduit($idcmd, $idProd);
        self::AfficherPanier();
    }

    public static function Up(){
        $identifiant = static::$identifiant;
        $classe = static::$classe;
        $idcmd = $_GET["idCommande"];
        $idProd = $_GET["idProduit"];;
        $classe::UpPanierProduit($idcmd, $idProd);
        self::AfficherPanier();
    }

    public static function Down(){
        $identifiant = static::$identifiant;
        $classe = static::$classe;
        $idcmd = $_GET["idCommande"];
        $idProd = $_GET["idProduit"];;
        $classe::DownPanierProduit($idcmd, $idProd);
        self::AfficherPanier();
    }
}
?>
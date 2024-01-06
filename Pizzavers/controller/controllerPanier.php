<?php
require_once('controllerDefaut.php');
require_once('controllerConnexion.php');
require_once('model/VPanier.php');
require_once('model/session.php');

class controllerPanier extends controllerDefaut{

    protected static $identifiant = "idClient";
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
            $value = $classe::getPanier($id);
            require_once('view/Panier/Panier.php');
            require_once('view/fin.html');
        }

    }
}
?>
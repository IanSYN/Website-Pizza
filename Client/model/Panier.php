<?php
require_once('objet.php');

class Panier extends objet
{
    protected static $identifiant = "idCommande";

    protected static $classe = 'Panier';

    protected $idProduit;

    protected $quantiteProduit;

    //constructeur
    public function __construct($idCategorie = null, $nomCategorie = null) {
        if(!is_null($idCategorie)){
            $this->idCategorie = $idCategorie;
            $this->nomCategorie = $nomCategorie;
        }
    }

    //methode to string
    public function __toString()
    {
        return $this->nomCategorie . "(" . $this->idCategorie . ")";
    }
}
?>
<?php
require_once('objet.php');

class VPanier extends objet
{
    protected static $identifiant = "idCommande";
    protected static $classe = 'VPanier';

    protected $idCommande;
    protected $nomProduit;
    protected $quantiteProduit;
    protected $idClient;
    protected $nomClient;
    protected $prixTotal;

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
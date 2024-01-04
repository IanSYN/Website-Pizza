<?php
require_once("objet.php");
class Produit extends objet
{
    protected static $identifiant = "idProduit";
    protected static $classe = "VProduit";
    protected $idProduit;
    protected $nomProduit;
    protected $prixProduit;
    protected $coverProduit;
    protected $idCategorie;
    //constructeur
    public function __construct($idProduit = null, $nomProduit = null, $prixProduit = null, $coverProduit = null, $idCategorie = null) {
        if(!is_null($idProduit)){
            $this->idProduit = $idProduit;
            $this->nomProduit = $nomProduit;
            $this->prixProduit = $prixProduit;
            $this->coverProduit = $coverProduit;
            $this->idCategorie = $idCategorie;
        }
    }

    //methode to string
    public function __toString()
    {
        return "Produit " . $this->nomProduit . " (" . $this->idProduit . " " . $this->prixProduit . ")";
    }
}
?>
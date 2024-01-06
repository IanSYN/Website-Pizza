<?php
require_once("objet.php");

class VProduit extends objet
{
    protected static $identifiant = "idProduit";
    protected static $classe = 'VProduit';
    
    protected $idProduit;
    protected $nomCategorie;
    protected $nomProduit;
    protected $coverProduit;
    protected $prixProduit;
    //constructeur
    public function __construct($idProduit = null, $nomCategorie = null, $nomProduit = null, $coverProduit = null, $prixProduit = null) {
        if(!is_null($idProduit)){
            $this->idProduit = $idProduit;
            $this->nomCategorie = $nomCategorie;
            $this->nomProduit = $nomProduit;
            $this->coverProduit = $coverProduit;
            $this->prixProduit = $prixProduit;
        }
    }
    //methode to string
    public function __toString()
    {
        return $this->nomProduit . "(" . $this->idProduit . ")";
    }
}
?>
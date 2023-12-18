<?php
require_once("objet.php");
class VPizza extends objet
{
    protected static $identifiant = "idPizza";
    protected static $classe = 'VPizza';
    protected $idPizza;
    protected $nomProduit;
    protected $nomTaille;
    //constructeur
    public function __construct($idPizza = null, $nomProduit = null, $nomTaille = null) {
        if(!is_null($idPizza)){
            $this->idPizza = $idPizza;
            $this->nomProduit = $nomProduit;
            $this->nomTaille = $nomTaille;
        }
    }

    //methode to string
    public function __toString()
    {
        return "Pizza " . $this->nomProduit . " (" . $this->nomTaille . ")";
    }
}
?>
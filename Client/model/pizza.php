<?php
require_once("objet.php");
class pizza extends objet
{
    protected static $identifiant = "idPizza";
    protected static $classe = 'pizza';
    protected $idPizza;
    protected $idProduit;
    protected $idTaille;
    //constructeur
    public function __construct($idPizza = null, $idProduit = null, $idTaille = null) {
        if(!is_null($idPizza)){
            $this->idPizza = $idPizza;
            $this->idProduit = $idProduit;
            $this->idTaille = $idTaille;
        }
    }

    //methode to string
    public function __toString()
    {
        return "Pizza " . $this->idPizza . " (" . $this->idProduit . " " . $this->idTaille . ")";
    }
}
?>
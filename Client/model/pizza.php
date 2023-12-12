<?php
require_once("objet.php");
class Pizza extends objet
{
    protected static $identifiant = "idPizza";
    protected static $classe = 'Pizza';
    protected $idPizza;
    protected $nomProduit;
    protected $nomTaille;
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
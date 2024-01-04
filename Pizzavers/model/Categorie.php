<?php
require_once('objet.php');

class Categorie extends objet
{
    protected static $identifiant = "idCategorie";

    protected static $classe = 'Categorie';

    protected $idCategorie;

    protected $nomCategorie;

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
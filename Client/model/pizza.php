<?php
require_once ("objet.php");
class pizza extends objet
{
    protected static $identifiant = "idIngredient";
    protected static $classe = 'pizza';
    protected $idIngredient;
    protected $nomIngredient;
    protected $stockIngredient;
    protected $prixIngredient;
    protected $coverIngredient;
    protected $idAllergene;

    //constructeur
    public function __construct($numAuteur = null, $nomAuteur = null, $prenomAuteur = null, $nationalite = null) {
        if(!is_null($numAuteur)){
            $this->numAuteur = $numAuteur;
            $this->nomAuteur = $nomAuteur;
            $this->prenomAuteur = $prenomAuteur;
            $this->nationalite = $nationalite;
            $this->nationalite = $nationalite;
        }
    }

    //methode to string
    public function __toString()
    {
        return "Adhérent " . $this->numAuteur . " (" . $this->nomAuteur . " " . $this->prenomAuteur . ")";
    }
}
?>
<?php
require_once('objet.php');

class VIngrPersonnalisee extends objet
{
    protected static $identifiant = "idPizzaPersonnalisee";
    protected static $classe = 'VIngrPersonnalisee';

    protected $idPizzaPersonnalisee;
    protected $nomIngredient;
    protected $prixIngredient;
    protected $quantiteSupplement;
    protected $idIngredient;

    //constructeur
    public function __construct($idPizzaPersonnalisee = null, $nomIngredient = null, $prixIngredient = null, $quantiteSupplement = null, $idIngredient = null) {
        if(!is_null($idPizzaPersonnalisee)){
            $this->idPizzaPersonnalisee = $idPizzaPersonnalisee;
            $this->nomIngredient = $nomIngredient;
            $this->prixIngredient = $prixIngredient;
            $this->quantiteSupplement = $quantiteSupplement;
            $this->idIngredient = $idIngredient;
        }
    }

    //methode to string
    public function __toString()
    {
        return $this->idPizzaPersonnalisee . "(" . $this->prixIngredient . ")";
    }

    
}
?>
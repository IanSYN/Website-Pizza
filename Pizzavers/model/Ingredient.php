<?php
require_once('objet.php');

class Ingredient extends objet {
    
    // Partie statique
    protected static $identifiant = "idIngredient";
    protected static $classe = "Ingredient";

    // Partie attributs
    protected int $idIngredient;
    protected string $nomIngredient;
    protected float $stockIngredient;
    protected float $prixIngredient;
    protected string $coverIngredient;
    protected ?int $idAllergene;

    // Constructeur
    public function __construct($idIngredient = null, $nomIngredient = null, $stockIngredient = null, $prixIngredient = null, $coverIngredient = null, $idAllergene = null) {
        if(!is_null($idIngredient)) {
            $this->idIngredient = $idIngredient;
            $this->nomIngredient = $nomIngredient;
            $this->stockIngredient = $stockIngredient;
            $this->prixIngredient = $prixIngredient;
            $this->coverIngredient = $coverIngredient;
            $this->idAllergene = $idAllergene;
        }
    }
}
?>
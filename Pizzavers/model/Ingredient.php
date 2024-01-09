<?php
require_once('objet.php');

<<<<<<< HEAD
class Ingredient extends objet
{
    protected static $identifiant = "idIngredient";

    protected static $classe = 'Ingredient';
=======
class Ingredient extends objet {
    
    // Partie statique
    protected static $identifiant = "idIngredient";
    protected static $classe = "Ingredient";
>>>>>>> 340f14f21a836bf5850326861c9a3cc2bd8ba48c

    // Partie attributs
    protected int $idIngredient;
    protected string $nomIngredient;
<<<<<<< HEAD
    protected string $prixIngredient;
    protected string $coverIngredient;

    //constructeur
    public function __construct($idIngredient = null, $nomIngredient = null, $prixIngredient = null, $coverIngredient = null) {
        if(!is_null($idIngredient)){
            $this->idIngredient = $idIngredient;
            $this->nomIngredient = $nomIngredient;
            $this->prixIngredient = $prixIngredient;
            $this->coverIngredient = $coverIngredient;
        }
    }

    //methode to string
    public function __toString()
    {
        return $this->nomIngredient . "(" . $this->idIngredient . ")";
    }

    public static function getIngreAll(){
        $classRecuperee = static::$classe;
        $requete = "SELECT * FROM $classRecuperee;";
        $resultat = connexion::pdo()->query($requete);
        try{
            $resultat->execute();
            $resultat->setFetchMode(PDO::FETCH_CLASS, $classRecuperee);
            $tab = $resultat->fetchAll();
            return $tab;
        }
        catch(PDOException $e){
            echo $e->getMessage();
            return false;
=======
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
>>>>>>> 340f14f21a836bf5850326861c9a3cc2bd8ba48c
        }
    }
}
?>
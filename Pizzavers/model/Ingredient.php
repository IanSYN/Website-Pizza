<?php
require_once('objet.php');

<<<<<<< HEAD
class Ingredient extends objet
{
    protected static $identifiant = "idIngredient";

    protected static $classe = 'Ingredient';
=======
>>>>>>> 884e0727b3314dc160275d21710a06265a2b161e
class Ingredient extends objet {
    // Partie statique
    protected static $identifiant = "idIngredient";
    protected static $classe = "Ingredient";

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
>>>>>>> 884e0727b3314dc160275d21710a06265a2b161e
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
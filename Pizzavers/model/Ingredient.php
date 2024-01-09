<?php
require_once('objet.php');

class Ingredient extends objet
{
    protected static $identifiant = "idIngredient";

    protected static $classe = 'Ingredient';

    // Partie attributs
    protected int $idIngredient;
    protected string $nomIngredient;
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
        }
    }
}
?>
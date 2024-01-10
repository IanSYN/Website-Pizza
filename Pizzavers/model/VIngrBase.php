<?php
require_once('objet.php');
class VIngrBase extends objet
{
   
    protected static $identifiant = "idProduit";
    protected static $identifiantB = "idPizza";
    //protected static $identifiantCI = "idIngredient";

    protected static $classe = 'VIngrBase';

    protected $idProduit;
    protected $idPizza;
    protected $idIngredient;
    protected $idTaille;
    protected $nomIngredient;
    protected $quantiteIngredient;
    protected $coverIngredient;

    //constructeur
    public function __construct($idProduit = null, $idPizza = null, $idIngredient = null, $idTaille = null, $nomIngredient = null, $quantiteIngredient = null, $coverIngredient = null) {
        if(!is_null($idProduit)){
            $this->idProduit = $idProduit;
            $this->idPizza = $idPizza;
            $this->idIngredient = $idIngredient;
            $this->idTaille = $idTaille;
            $this->nomIngredient = $nomIngredient;
            $this->quantiteIngredient = $quantiteIngredient;
            $this->coverIngredient = $coverIngredient;
        }
    }

    //methode to string
    public function __toString()
    {
        return $this->idProduit . "(" . $this->idPizza . $this->idIngredient . ")";
    }

    public static function getOneVIngrBase($id1){
        $classRecuperee = static::$classe;
        $identifiant = static::$identifiant;
        $identifiantB = static::$identifiantB;
        $idPizza = null;
        
        $query = "SELECT * FROM Pizza WHERE $identifiant = :id_tag AND idTaille = 1;";
        $resultat = connexion::pdo()->prepare($query);
        $tags = array(':id_tag' => $id1);
        try{
            $resultat->execute($tags);
            $resultat->setFetchMode(PDO::FETCH_CLASS, $classRecuperee);
            $element = $resultat->fetch();
            if(empty($element)){
                $idPizza = null;
            }
            else{
                $idPizza = $element->idPizza;
            }
        }
        catch(PDOException $e){
            echo $e->getMessage();
        }
        //requete
        $requetePreparee = "SELECT * FROM $classRecuperee WHERE $identifiant = :id_tag AND $identifiantB = :id2_tag AND idTaille = 1;";
        //execution
        $resultat = connexion::pdo()->prepare($requetePreparee);
        $tags = array(':id_tag' => $id1, ':id2_tag' => $idPizza);
        try{
            $resultat->execute($tags);
            //recuperation des resultats
            $resultat->setFetchMode(PDO::FETCH_CLASS, $classRecuperee);
            //renvoi du tableau
            $element = $resultat->fetchAll();
            //retourne le tableau
            return $element;
        }
        catch(PDOException $e){
            echo $e->getMessage();
        }
    }
}
?>
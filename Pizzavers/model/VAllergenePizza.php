<?php
require_once('objet.php');
class VAllergenePizza extends objet
{
   
    protected static $identifiant = "idProduit";
    protected static $identifiantA = "idPizza";
    protected static $classe = 'VAllergenePizza';

    protected $idProduit;
    protected $idPizza;
    protected $idAllergene;
    protected $nomAllergene;

    //constructeur
    public function __construct($idProduit = null, $idPizza = null, $idAllergene = null, $nomAllergene = null) {
        if(!is_null($idProduit)){
            $this->idProduit = $idProduit;
            $this->idPizza = $idPizza;
            $this->idAllergene = $idAllergene;
            $this->nomAllergene = $nomAllergene;
        }
    }

    //methode to string
    public function __toString()
    {
        return $this->idAllergene . "(" . $this->idPizza . $this->nomAllergene . ")";
    }

    public static function getOneVAP($id1){
        $classRecuperee = static::$classe;
        $identifiant = static::$identifiant;
        $identifiantA = static::$identifiantA;
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
        $requetePreparee = "SELECT * FROM $classRecuperee WHERE $identifiant = :id_tag AND $identifiantA = :id2_tag;";
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
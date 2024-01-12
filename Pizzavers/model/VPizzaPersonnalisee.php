<?php
require_once("objet.php");
class VPizzaPersonnalisee extends objet
{
    protected static $identifiant = "idPizzaPersonnalisee";
    protected static $classe = 'VPizzaPersonnalisee';
    protected $idPizzaPersonnalisee;
    protected $idCommande;
    protected $idPizza;
    protected $nomIngredient;
    protected $quantitePizza;
    protected $quantiteSupplement;
    
    //constructeur
    public function __construct($idPizzaPersonnalisee = null, $idCommande = null, $idPizza = null, $nomIngredient = null, $quantitePizza = null, $quantiteSupplement = null) {
        if(!is_null($idPizzaPersonnalisee)){
            $this->idPizzaPersonnalisee = $idPizzaPersonnalisee;
            $this->idCommande = $idCommande;
            $this->idPizza = $idPizza;
            $this->nomIngredient = $nomIngredient;
            $this->quantitePizza = $quantitePizza;
            $this->quantiteSupplement = $quantiteSupplement;
        }
    }

    public static function getPizzaPerso($idCmd){
        $classRecuperee = static::$classe;
        $requete = "SELECT * FROM $classRecuperee WHERE idCommande = :idCmd;";
        $resultat = connexion::pdo()->prepare($requete);
        $tags = array(':idCmd' => $idCmd);
        try{
            $resultat->execute($tags);
            $resultat->setFetchMode(PDO::FETCH_CLASS, $classRecuperee);
            $tab = $resultat->fetchAll();
            if (empty($tab)) {
                return false;
            }
            return $tab;
        }
        catch(PDOException $e){
            echo $e->getMessage();
            return false;
        }
    }
}
?>
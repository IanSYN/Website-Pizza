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
    protected $prixIngredient;
    protected $quantitePizza;
    protected $quantiteSupplement;
    protected $coverProduit;

    //constructeur
    public function __construct($idPizzaPersonnalisee = null, $idCommande = null, $idPizza = null, $nomIngredient = null, $prixIngredient = null, $quantitePizza = null, $quantiteSupplement = null, $coverProduit = null) {
        if(!is_null($idPizzaPersonnalisee)){
            $this->idPizzaPersonnalisee = $idPizzaPersonnalisee;
            $this->idCommande = $idCommande;
            $this->idPizza = $idPizza;
            $this->nomIngredient = $nomIngredient;
            $this->prixIngredient = $prixIngredient;
            $this->quantitePizza = $quantitePizza;
            $this->quantiteSupplement = $quantiteSupplement;
            $this->coverProduit = $coverProduit;
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
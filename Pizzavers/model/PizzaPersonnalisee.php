<?php
require_once("objet.php");
class PizzaPersonnalisee extends objet
{
    protected static $identifiant = "idPizzaPersonnalisee";
    protected static $classe = 'PizzaPersonnalisee';
    protected $idPizzaPersonnalisee;
    protected $quantitePizza;
    protected $idPizza;
    protected $idCommande;
    //constructeur
    public function __construct($idPizzaPersonnalisee = null, $quantitePizza = null, $idPizza = null, $idCommande = null) {
        if(!is_null($idPizzaPersonnalisee)){
            $this->idPizzaPersonnalisee = $idPizzaPersonnalisee;
            $this->quantitePizza = $quantitePizza;
            $this->idPizza = $idPizza;
            $this->idCommande = $idCommande;
        }
    }
    
    public static function getid($idCmd, $idPizza){
        $classRecuperee = static::$classe;
        $requete = "SELECT * FROM $classRecuperee WHERE idCommande = :idCmd AND idPizza = :idPizza;";
        $resultat = connexion::pdo()->prepare($requete);
        $tags = array(':idCmd' => $idCmd, ':idPizza' => $idPizza);
        try{
            $resultat->execute($tags);
            $resultat->setFetchMode(PDO::FETCH_CLASS, "PizzaPersonnalisee");
            $tab = $resultat->fetchAll();
            if (empty($tab)) {
                return false;
            }
            return $tab[0]->idPizzaPersonnalisee;
        }
        catch(PDOException $e){
            echo $e->getMessage();
            return false;
        }
    }

    public static function SupprimerPizzaPerso($idPP){
        $classRecuperee = static::$classe;
        $requete = "DELETE FROM Supplement WHERE idPizzaPersonnalisee = :idCmd;";
        $resultat = connexion::pdo()->prepare($requete);
        $tags = array(':idCmd' => $idPP);
        try{
            $resultat->execute($tags);
            $requete = "DELETE FROM $classRecuperee WHERE idPizzaPersonnalisee = :idCmd;";
            $resultat = connexion::pdo()->prepare($requete);
            $tags = array(':idCmd' => $idPP);
            try{
                $resultat->execute($tags);
                return true;
            }
            catch(PDOException $e){
                echo $e->getMessage();
                return false;
            }
        }
        catch(PDOException $e){
            echo $e->getMessage();
            return false;
        }
    }
}
?>
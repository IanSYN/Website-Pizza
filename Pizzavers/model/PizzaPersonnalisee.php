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
            $requete2 = "DELETE FROM $classRecuperee WHERE idPizzaPersonnalisee = :idCmd;";
            $resultat2 = connexion::pdo()->prepare($requete2);
            $tags = array(':idCmd' => $idPP);
            try{
                $resultat2->execute($tags);
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

    // Permet de supprimer toutes les pizzas personnalisées et leurs suppléments 
    // ayant pour identifiant de pizza celui passé en paramètres
    public static function SupprimerPizzaPersoParIdPizza($idPizza){

        // Requête récupérant les identifiants de pizza personnalisée concernant une pizza
        $requete = "SELECT idPizzaPersonalisee FROM PizzaPersonnalisee WHERE idPizza = :id_Pizza";
        $resultat = connexion::pdo()->prepare($requete);
        $tags = array(':id_Pizza' => $idPizza);
        try {

            // On récupère les identifiants des pizzas persos
            $resultat->execute($tags);
            $tab = $resultat->fetchColumn();

            // On supprime toutes les pizzas personnalisées
            foreach($tab as $unePizzaPerso) {
                self::supprimerPizzaPerso($unePizzaPerso);
            }
        }
        catch(PDOException $e){
            echo $e->getMessage();
        }

    }
}
?>
<?php
require_once('objet.php');
require_once('model/PizzaPersonnalisee.php');

class VIngrPersonnalisee extends objet
{
    protected static $identifiant = "idProduit";
    protected static $identifiantB = "idPizza";
    protected static $identifiantC = "idClient";
    protected static $classe = 'VIngrPersonnalisee';

    protected $idProduit;
    protected $idClient;
    protected $idPizza;
    protected $idTaille;
    protected $idIngredient;
    protected $idPizzaPersonnalisee;
    protected $quantiteIngredient;
    protected $quantiteSupplement;
    protected $prixIngredient;
    
    


    //constructeur
    public function __construct($idProduit = null, $idClient = null, $idPizza = null, $idTaille = null, $idIngredient = null, $idPizzaPersonnalisee = null, $quantiteIngredient = null, $quantiteSupplement = null, $prixIngredient = null) {
        if(!is_null($idClient)){
            $this->idProduit = $idProduit;
            $this->idClient = $idClient;
            $this->idPizza = $idPizza;
            $this->idTaille = $idTaille;
            $this->idIngredient = $idIngredient;
            $this->idPizzaPersonnalisee = $idPizzaPersonnalisee;
            $this->quantiteIngredient = $quantiteIngredient;
            $this->quantiteSupplement = $quantiteSupplement;
            $this->prixIngredient = $prixIngredient;
        }
    }

    //methode to string
    public function __toString()
    {
        return $this->idClient . "(" . $this->idPizzaPersonnalisee . ")";
    }

    public static function getIngr($id1, $id2){

    }

    public static function getOnePersonnalisation($id1, $id2){
        $classRecuperee = static::$classe;
        $identifiant = static::$identifiant;
        $identifiantB = static::$identifiantB;
        $identifiantC = static::$identifiantC;
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
        $requetePreparee = "SELECT * FROM $classRecuperee WHERE $identifiant = :id_tag AND $identifiantB = :id2_tag AND $identifiantC = :id3_tag ;";
        //execution
        $resultat = connexion::pdo()->prepare($requetePreparee);
        $tags = array(':id_tag' => $id1, ':id2_tag' => $idPizza, ':id3_tag' => $id2);
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

    public static function ajoutePanier($idProd, $idCom, $quantite){
        $class = 'Supplement';
        $class2 = 'PizzaPersonnalisee';
        $classRecuperee = static::$classe;
        $identifiant = static::$identifiant;
        $identifiantB = static::$identifiantB;
        $identifiantC = static::$identifiantC;
        $idPizza = null;
        $idPP = null;
        
        //on prend l'id de la pizza de la page 
        $query = "SELECT * FROM Pizza WHERE $identifiant = :id_tag AND idTaille = 1;";
        $resultat = connexion::pdo()->prepare($query);
        $tags = array(':id_tag' => $idProd);
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

        $requeteInsertionPP = "INSERT INTO $class2 (quantitePizza, idPizza, idCommande) VALUES (1, :idPizza, :idCom);";
        $resultat2 = connexion::pdo()->prepare($requeteInsertionPP);
        $tags2 = array(':idPizza' => $idPizza, ':idCom' => $idCom);
        $resultat2->execute($tags2);
        $idPP = $class2::getid($idCom, $idPizza);

        //on verifie si supplément est peuplé avec l'idPP qu'on recupere
        for($i = 1; $i <= 12; $i++){
            $requeteCheck = "SELECT * FROM $class WHERE idIngredient = :idIngredient AND idPizzaPersonnalisee = :idPizzaPersonnalisee;";
            $resultat = connexion::pdo()->prepare($requeteCheck);
            $tags = array(':idIngredient' => $i, ':idPizzaPersonnalisee' => $idPP);
            try{
                $resultat->execute($tags) ;
                $element = $resultat->fetch();
                if (empty($element)) {
                    if (!empty($quantite[$i])) {
                        $requeteInsertion = "INSERT INTO Supplement(idIngredient, idPizzaPersonnalisee, quantiteSupplement) VALUES (:idIngredient, :idPizzaPersonnalisee, :quantiteSupplement);";
                        $resultat3 = connexion::pdo()->prepare($requeteInsertion);
                        $tags3 = array(':idIngredient' => $i, ':idPizzaPersonnalisee' => $idPP, ':quantiteSupplement' => $quantite[$i]);
                        $resultat3->execute($tags3);
                    }
                }
            }
            catch(PDOException $e){
                echo $e->getMessage();
            }
        }
    }
}

?>
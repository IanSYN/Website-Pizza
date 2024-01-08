<?php
require_once('objet.php');

class VPanier extends objet
{
    protected static $identifiant = "idClient";
    protected static $classe = 'VPanier';

    protected $idCommande;
    protected $nomProduit;
    protected $quantiteProduit;
    protected $idEtatCommande;
    protected $idClient;
    protected $prenomClient;
    protected $prixTotal;

    //constructeur
    public function __construct($idCategorie = null, $nomCategorie = null) {
        if(!is_null($idCategorie)){
            $this->idCategorie = $idCategorie;
            $this->nomCategorie = $nomCategorie;
        }
    }

    //methode to string
    public function __toString()
    {
        return $this->nomCategorie . "(" . $this->idCategorie . ")";
    }

    public static function getPanierProduit($id){
        $classRecuperee = static::$classe;
        $identifiant = static::$identifiant;
        //requete
        $requetePreparee = "SELECT * FROM $classRecuperee WHERE $identifiant = :id_tag; AND ";
        //execution
        $resultat = connexion::pdo()->prepare($requetePreparee);
        $tags = array(':id_tag' => $id);
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

    public static function getPanierPizza($id){
        $classRecuperee = 'VPanierPizza';
        $identifiant = static::$identifiant;
        //requete
        $requetePreparee = "SELECT * FROM $classRecuperee WHERE $identifiant = :id_tag;";
        //execution
        $resultat = connexion::pdo()->prepare($requetePreparee);
        $tags = array(':id_tag' => $id);
        try{
            $resultat->execute($tags);
            //recuperation des resultats
            $resultat->setFetchMode(PDO::FETCH_CLASS, static::$classe);
            //renvoi du tableau
            $element = $resultat->fetchAll();
            //retourne le tableau
            return $element;
        }
        catch(PDOException $e){
            echo $e->getMessage();
        }
    }

    public static function AjoutePanierProduit($idCommande, $idProd){
        $class = 'Panier';
        $requeteCheck = "SELECT * FROM $class WHERE idCommande = :idCommande AND idProduit = :idProd;";
        $resultat = connexion::pdo()->prepare($requeteCheck);
        $tags = array(':idCommande' => $idCommande, ':idProd' => $idProd);
        try{
            $resultat->execute($tags);
            $resultat->setFetchMode(PDO::FETCH_CLASS, $class);
            $element = $resultat->fetchAll();
            if(empty($element)){
                $requetePreparee = "INSERT INTO $class VALUES (:idCommande, :idProd, 1);";
                $resultat = connexion::pdo()->prepare($requetePreparee);
                $tags = array(':idCommande' => $idCommande, ':idProd' => $idProd);
                try{
                    $resultat->execute($tags);
                }
                catch(PDOException $e){
                    echo $e->getMessage();
                }
            }
            else{
                $requetePreparee = "UPDATE $class SET quantiteProduit = quantiteProduit + 1 WHERE idCommande = :idCommande AND idProduit = :idProd;";
                $resultat = connexion::pdo()->prepare($requetePreparee);
                $tags = array(':idCommande' => $idCommande, ':idProd' => $idProd);
                try{
                    $resultat->execute($tags);
                }
                catch(PDOException $e){
                    echo $e->getMessage();
                }
            }
        }
        catch(PDOException $e){
            echo $e->getMessage();
        }
    }
}
?>
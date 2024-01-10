<?php
require_once('objet.php');

class VPanier extends objet
{
    protected static $identifiant = "idClient";
    protected static $classe = 'VPanier';

    protected $idCommande;
    protected $idProduit;
    protected $idCategorie;
    protected $nomProduit;
    protected $quantiteProduit;
    protected $idEtatCommande;
    protected $idClient;
    protected $prenomClient;
    protected $prixTotalCommande;
    protected $coverProduit;

    //constructeur
    public function __construct($idCommande = null, $idProduit = null, $idCategorie = null, $nomProduit = null, $quantiteProduit = null, $idEtatCommande = null, $idClient = null, $prenomClient = null, $prixTotalCommande = null, $coverProduit = null) {
        if(!is_null($idCommande)){
            $this->idCommande = $idCommande;
            $this->idProduit = $idProduit;
            $this->idCategorie = $idCategorie;
            $this->nomProduit = $nomProduit;
            $this->quantiteProduit = $quantiteProduit;
            $this->idEtatCommande = $idEtatCommande;
            $this->idClient = $idClient;
            $this->prenomClient = $prenomClient;
            $this->prixTotalCommande = $prixTotalCommande;
            $this->coverProduit = $coverProduit;
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
        $requetePreparee = "SELECT * FROM $classRecuperee WHERE $identifiant = :id_tag;";
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

    public static function SupprimerPanierProduit($idcmd, $idProd){
        $class = 'Panier';
        $requeteCheck = "SELECT * FROM $class WHERE idCommande = :idCommande AND idProduit = :idProd;";
        $resultat = connexion::pdo()->prepare($requeteCheck);
        $tags = array(':idCommande' => $idcmd, ':idProd' => $idProd);
        try{
            $resultat->execute($tags);
            $element = $resultat->fetchAll();
            if(!empty($element)){
                $requetePreparee = "DELETE FROM $class WHERE idCommande = :idCommande AND idProduit = :idProd";
                $resultat = connexion::pdo()->prepare($requetePreparee);
                $tags = array(':idCommande' => $idcmd, ':idProd' => $idProd);
                try{
                    $resultat->execute($tags);
                    return true;
                }
                catch(PDOException $e){
                    echo $e->getMessage();
                    return false;
                }
            }
        }
        catch(PDOException $e){
            echo $e->getMessage();
            return false;
        }
    }

    public static function DownPanierProduit($idcmd, $idProd){
        $class = 'Panier';
        $requeteCheck = "SELECT * FROM $class WHERE idCommande = :idCommande AND idProduit = :idProd;";
        $resultat = connexion::pdo()->prepare($requeteCheck);
        $tags = array(':idCommande' => $idcmd, ':idProd' => $idProd);
        try{
            $resultat->execute($tags);
            $element = $resultat->fetchAll();
            if(!empty($element)){
                $requetePreparee = "UPDATE $class SET quantiteProduit = quantiteProduit - 1 WHERE idCommande = :idCommande AND idProduit = :idProd;";
                $resultat = connexion::pdo()->prepare($requetePreparee);
                $tags = array(':idCommande' => $idcmd, ':idProd' => $idProd);
                try{
                    $resultat->execute($tags);
                    return true;
                }
                catch(PDOException $e){
                    echo $e->getMessage();
                    return false;
                }
            }
        }
        catch(PDOException $e){
            echo $e->getMessage();
            return false;
        }
    }

    public static function UpPanierProduit($idcmd, $idProd){
        $class = 'Panier';
        $requeteCheck = "SELECT * FROM $class WHERE idCommande = :idCommande AND idProduit = :idProd;";
        $resultat = connexion::pdo()->prepare($requeteCheck);
        $tags = array(':idCommande' => $idcmd, ':idProd' => $idProd);
        try{
            $resultat->execute($tags);
            $element = $resultat->fetchAll();
            if(!empty($element)){
                $requetePreparee = "UPDATE $class SET quantiteProduit = quantiteProduit + 1 WHERE idCommande = :idCommande AND idProduit = :idProd;";
                $resultat = connexion::pdo()->prepare($requetePreparee);
                $tags = array(':idCommande' => $idcmd, ':idProd' => $idProd);
                try{
                    $resultat->execute($tags);
                    return true;
                }
                catch(PDOException $e){
                    echo $e->getMessage();
                    return false;
                }
            }
        }
        catch(PDOException $e){
            echo $e->getMessage();
            return false;
        }
    }
}
?>
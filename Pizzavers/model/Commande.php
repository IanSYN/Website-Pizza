<?php
require_once('objet.php');
class Commande extends objet {
    protected static $identifiant = "idCommande";
    protected static $classe = "Commande";
    protected $idCommande;
    protected $dateCommande;
    protected $prixTotalCommande;
    protected $idMoyenPaiement;
    protected $idAdresse;
    protected $idEtatCommande;
    protected $codeCoupon;
    protected $idClient;
    protected $idCB;

    // Constructor
    public function __construct($idCommande = null, $dateCommande = null, $prixTotalCommande = null, $idMoyenPaiement = null, $idAdresse = null, $idEtatCommande = null, $codeCoupon = null, $idClient = null, $idCB = null) {
        if(!is_null($idCommande)) {
            $this->idCommande = $idCommande;
            $this->dateCommande = $dateCommande;
            $this->prixTotalCommande = $prixTotalCommande;
            $this->idMoyenPaiement = $idMoyenPaiement;
            $this->idAdresse = $idAdresse;
            $this->idEtatCommande = $idEtatCommande;
            $this->codeCoupon = $codeCoupon;
            $this->idClient = $idClient;
            $this->idCB = $idCB;
        }
    }
    public static function idPanier($id){
        $classRecuperee = static::$classe;
        //requete verifiant si le client a deja un panier
        $requete = "SELECT * FROM $classRecuperee WHERE idClient = :id_tag AND idEtatCommande = 1;";
        $resultat = connexion::pdo()->prepare($requete);
        $tags = array(':id_tag' => $id);
        try{
            $resultat->execute($tags);
            $resultat->setFetchMode(PDO::FETCH_CLASS, $classRecuperee);
            $element = $resultat->fetch();
            if(empty($element)){
                $requete = "INSERT INTO $classRecuperee (dateCommande, prixTotalCommande, idMoyenPaiement, idAdresse, idEtatCommande, codeCoupon, idClient, idCB) VALUES (now(), 0.0, 1, NULL, 1, NULL, :id_tag, NULL);";
                $resultat = connexion::pdo()->prepare($requete);
                $tags = array(':id_tag' => $id);
                try{
                    $resultat->execute($tags);
                    $requete = "SELECT * FROM $classRecuperee WHERE idClient = :id_tag AND idEtatCommande = 1;";
                    $resultat = connexion::pdo()->prepare($requete);
                    $tags = array(':id_tag' => $id);
                    try{
                        $resultat->execute($tags);
                        $resultat->setFetchMode(PDO::FETCH_CLASS, $classRecuperee);
                        $element = $resultat->fetch();
                        $idPanier = $element->idCommande;
                        return $idPanier;
                    }
                    catch(PDOException $e){
                        echo $e->getMessage();
                    }
                }
                catch(PDOException $e){
                    echo $e->getMessage();
                }
            }
            else{
                $idPanier = $element->idCommande;
                return $idPanier;
            }
        }
        catch(PDOException $e){
            echo $e->getMessage();
        }
    }
    public static function getCommandeClient($idClient){
        $classRecuperee = static::$classe;
        $requete = "SELECT * FROM $classRecuperee WHERE idClient = :id_tag AND idEtatCommande != 1;";
        $resultat = connexion::pdo()->prepare($requete);
        $tags = array(':id_tag' => $idClient);
        try{
            $resultat->execute($tags);
            $resultat->setFetchMode(PDO::FETCH_CLASS, $classRecuperee);
            $elements = $resultat->fetchAll();
            return $elements;
        }
        catch(PDOException $e){
            echo $e->getMessage();
        }
    }

    public static function MAJPrix($id, $prix){
        $classRecuperee = static::$classe;
        $requete = "UPDATE $classRecuperee SET prixTotalCommande = prixTotalCommande + :prix_tag WHERE idCommande = :id_tag;";
        $resultat = connexion::pdo()->prepare($requete);
        $tags = array(':id_tag' => $id, ':prix_tag' => $prix);
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

?>
<?php
require_once('objet.php');

class VPanier extends objet
{
    protected static $identifiant = "idClient";
    protected static $classe = 'VPanier';

    protected $idCommande;
    protected $nomProduit;
    protected $quantiteProduit;
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

    public static function getPanier($id){
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

    public static function AjoutePanier($id){
        $classRecuperee = 'Panier';
        $identifiant = static::$identifiant;

        $checkQuery = "SELECT * FROM Commande WHERE idClient = :idClient";
        $checkResult = connexion::pdo()->prepare($checkQuery);
        $checkResult->execute(array(':idClient' => $id));
        // $checkQuery = "SELECT * FROM Commande WHERE idCommande = :idCommande";
        // $checkResult = connexion::pdo()->prepare($checkQuery);
        // $checkResult->execute(array(':idCommande' => $idCommande));
        // if ($checkResult->rowCount() == 0) {
        //     // Handle the case where idCommande does not exist in Commande table
        //     echo "idCommande does not exist in Commande table";
        //     return;
        // }

        // If idCommande exists in Commande table, proceed with the insert
        // $requetePreparee = "INSERT INTO $classRecuperee VALUES (:idCommande, :idProduit, :quantiteProduit);";
        // $resultat = connexion::pdo()->prepare($requetePreparee);
        // $tags = array(':idCommande' => (int)$idCommande,':idProduit' => (int)$id, ':quantiteProduit' => 1);
        // try{
        //     $resultat->execute($tags);
        // }
        // catch(PDOException $e){
        //     echo $e->getMessage();
        // }
    }
}
?>
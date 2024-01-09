<?php
require_once('objet.php');
class Commande {
    protected static $identifiant = "idCommande";
    protected static $classe = "Commande";
    private $idCommande;
    private $dateCommande;
    private $prixTotalCommande;
    private $idMoyenPaiement;
    private $idAdresse;
    private $idEtatCommande;
    private $codeCoupon;
    private $idClient;
    private $idCB;

    // Constructor
    public function __construct($idCommande, $dateCommande, $prixTotalCommande, $idMoyenPaiement, $idAdresse, $idEtatCommande, $codeCoupon, $idClient, $idCB) {
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
    // public static function idPanier($id){
    //     $classRecuperee = static::$classe;
    //     //requete verifiant si le client a deja un panier
    //     $requete = "SELECT * FROM $classRecuperee WHERE idClient = :id_tag AND idEtatCommande = 1;";
    //     //execution
    //     $resultat = connexion::pdo()->prepare($requete);
    //     $tags = array(':id_tag' => $id);
    //     try{
    //         $resultat->execute($tags);
    //         //recuperation des resultats
    //         $resultat->setFetchMode(PDO::FETCH_CLASS, $classRecuperee);
    //         //renvoi du tableau
    //         $element = $resultat->fetch();
    //         //retourne le tableau
    //         return $element;
    //     }
    //     catch(PDOException $e){
    //         echo $e->getMessage();
    //     }
    // }
}

?>
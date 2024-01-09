<?php 
require_once('objet.php');

class Base{

    // protected static $identifiant = "idPizza";
    // protected static $identifiant2 = "idIngredient";

    // protected static $classe = 'Base';

    // protected string $idPizza;
    // protected string $idIngredient;

    // protected $quantiteIngredient;
    
    // public function __construct($idPizza  = NULL, $idIngredient  = NULL, $quantiteIngredient  = NULL){
    //     if (!is_null($idIngredient)){
    //         $this->idPizza = $idPizza;
    //         $this->idIngredient = $idIngredient;
    //         $this->quantiteIngredient = $quantiteIngredient;
    //     }
    // }

    // /*public static function getOneVBase($id, $id2){
    //     $classRecuperee = static::$classe;
    //     $identifiant = static::$identifiant;
    //     $identifiant2 = static::$identifiant2;
    //     //requete
    //     $requetePreparee = "SELECT * FROM $classRecuperee WHERE $identifiant = :id_tag; and $identifiant2 = :id2_tag;";
    //     //execution
    //     $resultat = connexion::pdo()->prepare($requetePreparee);
    //     $tags = array(':id_tag' => $id, ':id2_tag' => $id2);
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
    // }*/

    // public static function getIngreAll(){
    //     $classRecuperee = static::$classe;
    //     $requete = "SELECT * FROM $classRecuperee;";
    //     $resultat = connexion::pdo()->query($requete);
    //     try{
    //         $resultat->execute();
    //         $resultat->setFetchMode(PDO::FETCH_CLASS, $classRecuperee);
    //         $tab = $resultat->fetchAll();
    //         return $tab;
    //     }
    //     catch(PDOException $e){
    //         echo $e->getMessage();
    //         return false;
    //     }
    // }
}
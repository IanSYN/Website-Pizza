<?php 
require_once('objet.php');

class Base extends objet{

    protected static $identifiantA = "idPizza";
    protected static $identifiantB = "idIngredient";

    protected static $classe = 'Base';

    protected string $idPizza;
    protected string $idIngredient;

    protected $quantiteIngredient;
    
    public function __construct($idPizza  = NULL, $idIngredient  = NULL, $quantiteIngredient  = NULL){
        if (!is_null($idIngredient)){
            $this->idPizza = $idPizza;
            $this->idIngredient = $idIngredient;
            $this->quantiteIngredient = $quantiteIngredient;
        }
    }

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
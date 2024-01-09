<?php
require_once('model/objet.php');

class Alerte extends objet {

    // Partie statique
    protected static $classe = "Alerte";

    // Partie attributs
    protected int $idIngredient;
    protected int $idGestionnaire;
    protected int $seuilIngredient;
    protected bool $verifSeuil;

    // Constructeur
    public function __construct($idIngredient = null, $idGestionnaire = null, $seuilIngredient = null, $verifSeuil = null) {
        if(!is_null($idIngredient) && !is_null($idGestionnaire)) {
            $this->idIngredient = $idIngredient;
            $this->idGestionnaire = $idGestionnaire;
            $this->seuilIngredient = $seuilIngredient;

            // conversion d'un tinyint(4) en un booléen
            if ($verifSeuil == 1) {
                $this->verifSeuil = true;
            }
            else {
                $this->verifSeuil = false;
            }
        }
    }  
    
    
    // Méthode renvoyant le nom de l'ingrédient dont l'alerte fait l'objet
    public function getNomIngredient() {
        $ingr = $this->idIngredient;
        $requete = "SELECT nomIngredient FROM Ingredient WHERE idIngredient = $ingr";
        $result = connexion::pdo()->query($requete);
        return $result->fetchColumn();
    }

    // Méthode renvoyant le nom de l'ingrédient dont l'alerte fait l'objet
    public function getCoverIngredient() {
        $ingr = $this->idIngredient;
        $requete = "SELECT coverIngredient FROM Ingredient WHERE idIngredient = $ingr";
        $result = connexion::pdo()->query($requete);
        return $result->fetchColumn();
    }

    /* Fonctions statiques */

    /*
    // Méthode renvoyant le nom de l'ingrédient
    public function getNomIngredient() {
        $idIngr = $this->idIngredient;
        $requete = "SELECT nomIngredient FROM Ingredient WHERE idIngredient = $idIngr";
        $resultat = connexion::pdo()->query($requete);
        return $resultat->fetchColumn();
    }

    // Méthode renvoyant le nom de l'image de l'ingrédient
    public function getCoverIngredient() {
        $idIngr = $this->idIngredient;
        $requete = "SELECT coverIngredient FROM Ingredient WHERE idIngredient = $idIngr";
        $resultat = connexion::pdo()->query($requete);
        return $resultat->fetchColumn();
    }
    */

    // Fonction renvoyant les alertes d'un gestionnaire
    // et seulement celles dont le seuil a été dépassé
    public static function getMesAlertes($idGestionnaire) {

        // requete comprenant récupérant les alertes dont le seuil a été dépassé
        $requetePreparee = "SELECT * FROM Alerte WHERE idGestionnaire = :id_gest AND verifSeuil = 1";

        //execution
        $resultat = connexion::pdo()->prepare($requetePreparee);
        $tags = array(':id_gest' => $idGestionnaire);
        
        try{
            $resultat->execute($tags);
            //recuperation des resultats
            $resultat->setFetchMode(PDO::FETCH_CLASS, 'Alerte');
            //renvoi du tableau
            $element = $resultat->fetchAll();
            //retourne le tableau
            return $element;
        }
        catch(PDOException $e){
            echo $e->getMessage();
        }
    }
}
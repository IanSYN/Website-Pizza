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

    // Fonction renvoyant les alertes d'un gestionnaire à partir de 
    // son idGestionnaire
    public static function getMesAlertes($idGestionnaire) {

        //requete
        $requetePreparee = "SELECT * FROM Alerte WHERE idGestionnaire = :id_gest;";

        //execution
        $resultat = connexion::pdo()->prepare($requetePreparee);
        $tags = array(':id_gest' => $idGestionnaire);
        
        try{
            $resultat->execute($tags);
            //recuperation des resultats
            $resultat->setFetchMode(PDO::FETCH_CLASS, 'Alerte');
            //renvoi du tableau
            $element = $resultat->fetch();
            //retourne le tableau
            return $element;
        }
        catch(PDOException $e){
            echo $e->getMessage();
        }
    }
}
<?php
class objet {
    public function get($attribut)
    {
        return $this->$attribut;
    }

    public function set($attribut, $valeur)
    {
        $this->$attribut = $valeur;
    }

    public static function getAll(){
        $classRecuperee = static::$classe;
        //requete
        $requete = "SELECT * FROM $classRecuperee;";
        //execution
        $resultat = connexion::pdo()->query($requete);
        //recuperation des resultats
        $resultat->setFetchMode(PDO::FETCH_CLASS, $classRecuperee);
        //renvoi du tableau
        $tableau = $resultat->fetchAll();
        //retourne le tableau
        return $tableau;
    }

    public static function getOne($id){
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
            $element = $resultat->fetch();
            //retourne le tableau
            return $element;
        }
        catch(PDOException $e){
            echo $e->getMessage();
        }
    }

    // Permet de supprimer une ligne de la base de données à partir de l'identifiant
    public static function delete($id) {
        // récupération du nom de la classe
        $classeRecuperee = static::$classe;

        // Récupération du nom de l'identifiant
        $identifiantRecupere = static::$identifiant;

        // écriture de la requête préparée
        $requete = "DELETE FROM $classeRecuperee WHERE $identifiantRecupere = :id_tag";

        // on prépare la requête
        $requetePreparee = connexion::pdo()->prepare($requete);
        
        // on crée le tableau contenant la valeur pour le tag
        $tag = array("id_tag" => $id);
        try {
            // on exécute la requête préparée
            $requetePreparee->execute($tag);
        } 
        catch (PDOException $e) {
            echo $e->getMessage();
        }
    }
}
?>
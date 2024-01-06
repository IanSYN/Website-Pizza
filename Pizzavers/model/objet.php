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

    public static function delete($id){
        $classRecuperee = static::$classe;
        $identifiant = static::$identifiant;
        //requete
        $requetePreparee = "DELETE FROM $classRecuperee WHERE $identifiant = :id_tag;";
        //execution
        $resultat = connexion::pdo()->prepare($requetePreparee);
        $tags = array(':id_tag' => $id);
        try{
            $resultat->execute($tags);
        }
        catch(PDOException $e){
            echo $e->getMessage();
        }
    }
}
?>
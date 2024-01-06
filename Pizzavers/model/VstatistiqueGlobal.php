<?php
require_once("objet.php");
class VstatistiqueGlobal extends objet
{
    protected static $classe = "VStatGlobal";
    protected $nbrCommande;
    protected $CATotal;
    //constructeur
    public function __construct($nbrCommande = null, $CATotal = null) {
        if(!is_null($nbrCommande)){
            $this->nbrCommande = $nbrCommande;
            $this->CATotal = $CATotal;
        }
    }
    //methode to string
    public function __toString()
    {
        return "Nombre de commande :" . $this->nbrCommande . "<br> Chiffre d'affaire :" . $this->CATotal . "€";
    }
    public static function getStat(){
        $classRecuperee = static::$classe;
        $requete = "SELECT * FROM $classRecuperee;";
        $resultat = connexion::pdo()->query($requete);
        $resultat->setFetchMode(PDO::FETCH_CLASS, "VstatistiqueJournalier");
        $tab = $resultat->fetchAll();
        if (empty($tab)) {
            return false;
        }
        return $tab[0];
    }
}
?>
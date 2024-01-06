<?php
require_once("objet.php");
class Produit extends objet
{
    protected static $identifiant = "idProduit";
    protected static $classe = "Produit";
    protected $idProduit;
    protected $nomProduit;
    protected $prixProduit;
    protected $coverProduit;
    protected $alAffiche;
    protected $idCategorie;
    //constructeur
    public function __construct($idProduit = null, $nomProduit = null, $prixProduit = null, $coverProduit = null, $alAffiche = null, $idCategorie = null) {
        if(!is_null($idProduit)){
            $this->idProduit = $idProduit;
            $this->nomProduit = $nomProduit;
            $this->prixProduit = $prixProduit;
            $this->coverProduit = $coverProduit;
            $this->idCategorie = $idCategorie;

            if ($alAffiche == 1) {
                $this->alAffiche = true;
            }
            else {
                $this->alAffiche = false;
            }
        }
    }

    //methode to string
    public function __toString()
    {
        return "Produit " . $this->nomProduit . " (" . $this->idProduit . " " . $this->prixProduit . ")";
    }

    public static function getAffiche(){
        $classRecuperee = static::$classe;
        $requete = "SELECT * FROM $classRecuperee WHERE alAffiche = 1;";
        $resultat = connexion::pdo()->query($requete);
        $resultat->setFetchMode(PDO::FETCH_CLASS, "Produit");
        $tab = $resultat->fetchAll();
        if (empty($tab)) {
            return false;
        }
        return $tab[0];
    }
}
?>
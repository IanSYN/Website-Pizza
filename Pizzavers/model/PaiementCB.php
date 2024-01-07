<?php
    require_once('objet.php');
    class PaiementCB extends Objet {
        protected static $identifiant = "idCB";
        protected static $classe = 'PaiementCB';
        
        protected $idCB;
        protected $codeCB;
        protected $nomCB;
        protected $dateExpiration;
        protected $cryptoCB;
        protected $datePaiement;
        protected $etatPaiement;

    public function __construct($idCB = null, $codeCB = null, $nomCB = null, $dateExpiration = null, $cryptoCB = null, $datePaiement = null, $etatPaiement = null) {
        if(!is_null($idCB)){
            $this->idCB = $idCB;
            $this->codeCB = $codeCB;
            $this->nomCB = $nomCB;
            $this->dateExpiration = $dateExpiration;
            $this->cryptoCB = $cryptoCB;
            $this->datePaiement = $datePaiement;
            $this->etatPaiement = $etatPaiement;
        }
    }

    public function __toString()
    {
        return "PaiementCB " . $this->idCB . " (" . $this->codeCB . " " . $this->nomCB . " " . $this->dateExpiration . " " . $this->cryptoCB . " " . $this->datePaiement . " " . $this->etatPaiement . ")";
    }

    public static function payer($id, $NCard, $Crypto, $Date, $Nom){
        $classe = static::$classe;
        $query = "INSERT INTO $classe (codeCB, nomCB, dateExpiration, cryptoCB, datePaiement, etatPaiement) VALUES ('$NCard', '$Nom', '$Date', '$Crypto', now(), 'Paiement validé');";
        $resultat = connexion::pdo()->prepare($query);
        try{
            $resultat->execute();
            $idCB = connexion::pdo()->lastInsertId();
            $query = "UPDATE Commande SET idCB = '$idCB' WHERE idCommande = '$id'";
            $resultat = connexion::pdo()->prepare($query);
            try{
                $resultat->execute();
                return true;
            }
            catch(PDOException $e){
                echo $e->getMessage();
                return false;
            }
        }
        catch(PDOException $e){
            echo $e->getMessage();
            return false;
        }

    }
}
?>

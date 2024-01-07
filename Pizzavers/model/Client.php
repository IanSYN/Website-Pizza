<?php
require_once('objet.php');

class Client extends objet {
    
    // Partie statique
    protected static $identifiant = "mailClient";
    protected static $classe = "Client";

    // Partie attributs
    protected int $idClient;
    protected string $mailClient;
    protected string $mdpClient;
    protected string $nomClient;
    protected string $prenomClient;
    protected string $telClient;

    // Constructeur
    public function __construct($idClient = null, $mailClient = null, $mdpClient = null, $nomClient = null, $prenomClient = null, $telClient = null) {
        if(!is_null($idClient)) {
            $this->idClient = $idClient;
            $this->mailClient = $mailClient;
            $this->mdpClient = $mdpClient;
            $this->nomClient = $nomClient;
            $this->prenomClient = $prenomClient;
            $this->telClient = $telClient;
        }
    }

    public static function creationClient($mailClient, $mdpClient, $nomClient, $prenomClient, $telClient) {
        $classRecuperee = static::$classe;
        $requete = "INSERT INTO $classRecuperee (mailClient, mdpClient, nomClient, prenomClient, telClient) VALUES (:mailClient, :mdpClient, :nomClient, :prenomClient, :telClient);";
        $resultat = connexion::pdo()->prepare($requete);
        $tags = array(':mailClient' => $mailClient, ':mdpClient' => $mdpClient, ':nomClient' => $nomClient, ':prenomClient' => $prenomClient, ':telClient' => $telClient);
        try{
            $resultat->execute($tags);
            return true;
        }
        catch(PDOException $e){
            echo $e->getMessage();
            return false;
        }
    }
    
}
?>

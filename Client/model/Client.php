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

    
}
?>

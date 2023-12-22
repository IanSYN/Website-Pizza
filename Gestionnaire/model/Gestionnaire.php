<?php
require_once('objet.php');

class Gestionnaire extends objet {
    
    // Partie statique
    protected static $identifiant = "idGestionnaire";
    protected static $classe = "Gestionnaire";

    // Partie attributs
    protected int $idGestionnaire;
    protected string $mdpGestionnaire;
    protected string $mailGestionnaire;
    protected int $telGestionnaire;

    // Constructeur
    public function __construct($idGestionnaire = null, $mdpGestionnaire = null, $mailGestionnaire = null, $telGestionnaire = null) {
        if(!is_null($idGestionnaire)) {
            $this->idGestionnaire = $idGestionnaire;
            $this->mdpGestionnaire = $mdpGestionnaire;
            $this->mailGestionnaire = $mailGestionnaire;
            $this->telGestionnaire = $telGestionnaire;
        }
    }

    
}
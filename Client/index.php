<?php

session_start(); // On permet l'écriture dans $_SESSION

$objet = "accueil";
$action = "AfficherAccueil";
$objets = ["accueil","connexion","produit","panier", "gestionnaire", "info"];
$actions = ["connect", "afficherProduit","afficher","afficherAccueil", "afficherConnexion", "afficherPage", "afficherOne", "disconnect"];

/* Vérification de gestionnaire connecté */
require_once("model/session.php");

// Si un gestionnaire est connecté, on bascule toutes les 
// actions sur indexGestionnaire.php, sauf celle de la déconnexion
if (session::gestionnaireConnected()) {

    // Cas pour la déconnexion
    if ($objet == "connexion" && $action == "disconnect") {
        require_once("controller/controllerConnexion.php");
        controllerConnexion::Disconnect();
    } 

    // Autres cas
    else {
        include("gestionnaire/indexGestionnaire.php");
    }

}

// Autres cas
else {
    if(isset($_GET['objet']) && in_array($_GET['objet'],$objets)){
        $objet = $_GET['objet'];
    }
    
    if(isset($_GET['action']) && in_array($_GET['action'],$actions)){
        $action = $_GET['action'];
    }
    
    $controller = "controller".ucfirst($objet);
    $action = ucfirst($action);
    
    require_once ("controller/$controller.php");
    require_once ("config/connexion.php");
    connexion::connect();
    $controller::$action();
}


?> 
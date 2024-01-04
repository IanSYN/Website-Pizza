<?php

    /* Valeurs par défaut */
    $objet = "accueil";
    $action = "afficherAccueilGestionnaire";

    $objets = ["accueil","connexion"];
    $actions = ["afficherAccueilGestionnaire", "disconnect"];

    if(isset($_GET['objet']) && in_array($_GET['objet'],$objets)){
        $objet = $_GET['objet'];
    }
    
    if(isset($_GET['action']) && in_array($_GET['action'],$actions)){
        $action = $_GET['action'];
    }
    
    $controller = "controller".ucfirst($objet);
    $action = ucfirst($action);
    
    require_once ("controller/$controller.php");
    require_once ("");
    connexion::connect();
    $controller::$action();
?>
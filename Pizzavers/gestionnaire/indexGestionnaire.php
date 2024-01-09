<?php

    /* Valeurs par défaut */
    $objet = "gestionnaire";
    $action = "afficherAccueilGestionnaire";

    $objets = ["alerte", "connexion", "gestionnaire", "produit"];
    $actions = ["afficherAccueilGestionnaire", "afficherMesAlertes", "afficherMonCompte", "disconnect", "pizzaAlAffiche", "parametresAlerte", "mettreAlAffiche", "nosPizzas", "nosProduit", "ajouterPizza", "creerPizza"];

    if(isset($_GET['objet']) && in_array($_GET['objet'],$objets)){
        $objet = $_GET['objet'];
    }
    
    if(isset($_GET['action']) && in_array($_GET['action'],$actions)){
        $action = $_GET['action'];
    }
    
    $controller = "controller".ucfirst($objet);
    $action = ucfirst($action);
    
    require_once ("gestionnaire/controller/$controller.php");
    require_once ("config/connexion.php");
    connexion::connect();
    $controller::$action();
?>
<?php
require_once('controller/controllerDefaut.php');
require_once('model/Ingredient.php');

class controllerIngredient extends controllerDefaut {
    protected static $classe = 'Ingredient';

    public static function AfficherEtatStock() {

        // On affiche le début, en reprenant les mêmes codes que ceux pour l'alerte
        include('gestionnaire/view/Alerte/debutAlerte.html');
        include('gestionnaire/view/menuGestionnaire.html');

        include('gestionnaire/view/Ingredient/titreEtatStocks.html');

        // On récupère tous les ingrédients 
        $lesIngredients = Ingredient::getAll();

        foreach ($lesIngredients as $unIngredient) {

            // On récupère les informations à afficher
            $nom = $unIngredient->get('nomIngredient');
            $cover = $unIngredient->get('coverIngredient');
            $stock = $unIngredient->get('stockIngredient');

            // On affiche les informations
            include('gestionnaire/view/Ingredient/viewIngredient.php');

        }
    }

}
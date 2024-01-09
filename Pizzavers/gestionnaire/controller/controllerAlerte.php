<?php
require_once('controller/controllerDefaut.php');
require_once('gestionnaire/model/Alerte.php');
require_once('model/Ingredient.php');

class controllerAlerte extends controllerDefaut {
    protected static $classe = 'Alerte';
    
    public static function AfficherMesAlertes() {

        // On importe toutes les alertes du gestionnaire
        $lesAlertes = Alerte::getMesAlertes($_SESSION['idGestionnaire']);

        // Cas où la liste des alertes est vide
        if (count($lesAlertes) == 0) {
            
            // On affiche le message d'absence d'alerte
            include('gestionnaire/view/Alerte/debutAlerte.html');
            include('gestionnaire/view/menuGestionnaire.html');
            include('gestionnaire/view/Alerte/debutAlerte.html');
            include('gestionnaire/view/Alerte/viewAucuneAlerte.html');
            include('gestionnaire/view/Alerte/finAlerte.html');
        }

        // Autres cas
        else {

            // On affiche le début
            include('gestionnaire/view/Alerte/debutAlerte.html');
            include('gestionnaire/view/menuGestionnaire.html');
            include('gestionnaire/view/Alerte/debutAlerte.html');

            foreach ($lesAlertes as $uneAlerte) {

                // On récupère l'ingrédient spécifié dans l'alerte
                $ingredient = Ingredient::getOne($uneAlerte->get('idIngredient'));
                
                // on récupère des données de l'ingrédient
                $nom = $ingredient->get('nomIngredient');
                $cover = $ingredient->get('coverIngredient');
                $stock = $ingredient->get('stockIngredient');
                
                include('gestionnaire/view/Alerte/viewAlerte.php');
            }   
            
            // On affiche la fin
            include('gestionnaire/view/Alerte/finAlerte.html');
        }


    }

    // Fonction qui renvoie le nombre d'alertes 
    public static function nbAlertes() {
        return count(Alerte::getMesAlertes($_SESSION['idGestionnaire']));
    }
}
?>
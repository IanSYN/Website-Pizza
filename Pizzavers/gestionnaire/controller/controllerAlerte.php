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
            include('gestionnaire/view/Alerte/titreAlerte.html');
            include('gestionnaire/view/Alerte/viewAucuneAlerte.html');
            include('gestionnaire/view/Alerte/finAlerte.html');
        }

        // Autres cas
        else {

            // On affiche le début
            include('gestionnaire/view/Alerte/debutAlerte.html');
            include('gestionnaire/view/menuGestionnaire.html');
            include('gestionnaire/view/Alerte/titreAlerte.html');

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


    // Fonction permettant d'afficher les paramètres d'alerte
    // pour régler les seuils d'alerte
    public static function ParametresAlerte() {

        // On affiche le début
        include('gestionnaire/view/Alerte/debutAlerte.html');
        include('gestionnaire/view/menuGestionnaire.html');
        include('gestionnaire/view/Alerte/titreParametresAlerte.html');

        // On récupère tous les ingrédients 
        $lesIngredients = Ingredient::getAll();

        foreach ($lesIngredients as $unIngredient) {

            // On récupère les informations à afficher
            $nom = $unIngredient->get('nomIngredient');
            $cover = $unIngredient->get('coverIngredient');
            $stock = $unIngredient->get('stockIngredient');

            // On cherche l'alerte correspondant à cet ingrédient
            $alerte = Alerte::getOne($unIngredient->get('idIngredient'));
            $seuil = 0.0;

            // Si l'alerte n'a pas été trouvée
            if($alerte != null) {
                $seuil = $alerte->get('seuilIngredient');
                include('gestionnaire/view/Alerte/viewParametresAlerte.html');
            }
        }

        // On affiche la fin
        include('gestionnaire/view/Alerte/finParametresAlerte.html');
    }
}
?>
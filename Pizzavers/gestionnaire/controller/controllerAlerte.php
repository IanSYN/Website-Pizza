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

    // Fonction permettant d'afficher les paramètres d'alerte
    // pour régler les seuils d'alerte
    public static function ParametresAlerte($succes = false) {

        // On affiche le début
        include('gestionnaire/view/Alerte/debutAlerte.html');
        include('gestionnaire/view/menuGestionnaire.html');

        // Cas où les modifications ont fonctionné
        if ($succes) include('gestionnaire/view/Alerte/paramEnregistres.html');

        include('gestionnaire/view/Alerte/titreParametresAlerte.html');

        // On récupère tous les ingrédients 
        $lesIngredients = Ingredient::getAll();

        foreach ($lesIngredients as $unIngredient) {

            // On récupère les informations à afficher
            $idIngr = $unIngredient->get('idIngredient');
            $nom = $unIngredient->get('nomIngredient');
            $cover = $unIngredient->get('coverIngredient');
            $stock = $unIngredient->get('stockIngredient');

            // On cherche l'alerte correspondant à cet ingrédient
            $alerte = Alerte::getOne($idIngr);
            $seuil = 0.0;

            // Si l'alerte n'a pas été trouvée
            if($alerte != null) {
                $seuil = $alerte->get('seuilIngredient');
                include('gestionnaire/view/Alerte/viewParametresAlerte.php');
            }
        }

        // On affiche la fin
        include('gestionnaire/view/Alerte/finParametresAlerte.html');
    }


    // Fonction permettant de régler les seuils émis
    // depuis le formulaire des paramètres
    public static function EnregistrerSeuils() {
        $succesModif = true; // Sert à déterminer si les modifications ont fonctionné

        // On prend tous les seuils de $_POST
        foreach($_POST as $key => $value) {
            $requetePrepare = "";

            // On vérifie si l'alerte est présente dans la base
            $alerte = Alerte::getOne($key);

            // Si l'alerte n'est pas présente dans la base de données
            // on la crée
            if($alerte == null) {
                $requetePrepare = "INSERT INTO Alerte VALUES (:idIngr, :idGest, :seuil, 0);";
            } 

            // Autres cas
            else {
                $requetePrepare = "UPDATE Alerte SET seuilIngredient = :seuil WHERE idIngredient = :idIngr AND idGestionnaire = :idGest";
            }

            try {
                $statement = connexion::pdo()->prepare($requetePrepare);
                $tags = [
                    'idIngr' => $key, // la clé est l'identifiant de l'ingrédient
                    'idGest' => $_SESSION["idGestionnaire"],
                    'seuil' => $value // la valeur est la valeur du seuil défini par le gestionnaire
                ];
                $statement->execute($tags);
                $statement->closeCursor();
            }
            catch(PDOException $e){
                echo $e->getMessage();
                $succesModif = false; // On met à false le succès en cas d'erreur
            }
        }

        // On renvoie l'utilisateur vers la page des paramètres 
        self::ParametresAlerte($succesModif);
    }
}
?>
<?php
    require_once('controller/controllerDefaut.php');
    require_once('model/Produit.php');
    require_once('model/Categorie.php'); // au cas où
    require_once('model/session.php');

    class controllerProduit extends controllerDefaut {
        protected static $classe = 'Produit';
        protected static $identifiant = 'idProduit';


        // Fonction permettant d'afficher les pizzas
        // et de laisser le gestionnaire choisir celle à l'affiche
        public static function PizzaAlAffiche() {

            // Cas où un gestionnaire n'est pas connecté,
            // on renvoie une erreur 403 : Forbidden
            if (!(session::gestionnaireConnected())) {
                self::AfficherErreur403();
            }
            else {

                // On importe tous les produits 
                $tableauProduits = Produit::getAll();

                try {
                    // On cherche l'idCategorie correspondant à Pizza
                    $requete = "SELECT idCategorie FROM Categorie WHERE nomCategorie = 'Pizza';";
                    $resultat = connexion::pdo()->query($requete);
                    $idCategoriePizza = $resultat->fetchColumn();

                    // on affiche
                    include('gestionnaire/view/debGestionnaire.html');
                    include('gestionnaire/view/menuGestionnaire.html');
                    include('gestionnaire/view/viewPizzaAlAffiche.php');

                }
                catch(PDOException $e){
                    echo $e->getMessage();
                }
            }
        }

        public static function MettreAlAffiche() {
            
            // Cas où un gestionnaire n'est pas connecté,
            // on renvoie une erreur 403 : Forbidden
            //if (!(session::gestionnaireConnected())) {
                self::AfficherErreur403(); 
            //}


        }
    }
?>
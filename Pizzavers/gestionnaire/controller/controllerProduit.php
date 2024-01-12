<?php
    require_once('controller/controllerDefaut.php');
    require_once('model/Produit.php');
    require_once('model/Pizza.php');
    require_once('model/Base.php');
    require_once('model/PizzaPersonalisee.php');
    require_once('model/Categorie.php');
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
                    include('gestionnaire/view/Pizza/viewPizzaAlAffiche.php');

                }
                catch(PDOException $e){
                    echo $e->getMessage();
                }
            }
        }

        public static function MettreAlAffiche() {
            
            // Cas où un gestionnaire n'est pas connecté,
            // on renvoie une erreur 403 : Forbidden
            if (!(session::gestionnaireConnected())) {
                self::AfficherErreur403(); 
            }
            else {
                try {
                    
                    // On cherche l'élément actuellement mis en affiche, 
                    // afin de lui mettre son 'alAffiche' à 0
                    $pizza = null;
                    $tableauProduits = Produit::getAll();

                    // On cherche l'idCategorie correspondant à Pizza
                    $requete = "SELECT idCategorie FROM Categorie WHERE nomCategorie = 'Pizza';";
                    $resultat = connexion::pdo()->query($requete);
                    $idCategoriePizza = $resultat->fetchColumn();

                    foreach($tableauProduits as $element) {

                        // Si l'élément est une pizza et est à l'affiche,
                        // alors on le stocke dans $pizza
                        if (($element->get('idCategorie') == $idCategoriePizza) && ($element->get('alAffiche'))) {
                            $pizza = $element;
                            break;
                        }
                    }
                    
                    // On retire le statut de 'alAffiche' à l'ancienne pizza
                    // et on l'applique à la nouvelle pizza, le tout, à l'aide
                    // d'une requête préparée

                    $requetePrepare = "UPDATE Produit SET alAffiche = 0 WHERE idProduit = :idAnciennePizza; UPDATE Produit SET alAffiche = 1 WHERE idProduit = :idNouvellePizza;";
                    $statement = connexion::pdo()->prepare($requetePrepare);
                    $tags = [
                        ':idAnciennePizza' => $pizza->get("idProduit"),
                        ':idNouvellePizza' => $_GET['idProduit']
                    ];
                    $statement->execute($tags);
                    $statement->closeCursor();

                    // On revient à la page
                    self::PizzaAlAffiche();
                }
                catch(PDOException $e){
                    echo $e->getMessage();
                }
            }
        }

        public static function NosPizzas() {

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
                    include('gestionnaire/view/Pizza/viewNosPizzas.php');

                }
                catch(PDOException $e){
                    echo $e->getMessage();
                }
            }
        }

        public static function NosProduit() {

            // Cas où un gestionnaire n'est pas connecté,
            // on renvoie une erreur 403 : Forbidden
            if (!(session::gestionnaireConnected())) {
                self::AfficherErreur403();
            }
            else {

                // On importe tous les produits 
                $tableauProduits = Produit::getAll();

                try {
                    include('gestionnaire/view/debGestionnaire.html');
                    include('gestionnaire/view/menuGestionnaire.html');
                    include('gestionnaire/view/Produit/viewNosProduit.php');
                }
                catch(PDOException $e){
                    echo $e->getMessage();
                }
            }
        }

        public static function AjouterPizza() {
            include('gestionnaire/view/debGestionnaire.html');
            include('gestionnaire/view/menuGestionnaire.html');
            include('gestionnaire/view/Produit/formulaireProduit.html');
        }

        public static function CreerProduit(){
            $nomProduit = $_POST['nomProduit'];
            $prixProduit = $_POST['prixProduit'];
            

            /* Partie d'importation et de sauvegarde de l'image */

            // On vérifie que le fichier de cover a été ajouté
            if (isset($_FILES['coverProduit'])) {

                // On récupère les informations utiles du fichier
                $nomFichier = $_FILES['coverProduit']['name'];
                $tmpNameFichier = $_FILES['coverProduit']['tmp_name']; // On récupère le chemin temporaire du fichier importé
                $erreurs = $_FILES['coverProduit']['error']; // On récupère 

                // On vérifie qu'il n'y a pas eu d'erreur
                if ($erreurs == 0) {

                    // On vérifie si le fichier importé est une image
                    $isImage = getimagesize($tmpNameFichier);

                    if ($isImage != false) {

                        // On définit la destination du fichier dans le serveur
                        $destination = "img/" . $nomFichier;

                        // On déplace le fichier au bon endroit
                        if (!(move_uploaded_file($tmpNameFichier, $destination))) {
                            // En cas d'erreur d'import
                            echo "Erreur d'import !";
                        }
                    } 
                    // Cas où le fichier n'est pas une image
                    else {
                        echo "Invalid image file!";
                    }
                } 
                // Cas où il y a eu des erreurs d'importation
                else {
                    echo "Error uploading the file!";
                }
            } 
            // Cas où aucun fichier n'a été importé
            else {
                echo "Aucun fichier importé";
            }

            if (isset($_POST['nomProduit']) && isset($_POST['prixProduit']) && isset($_POST['idCategorie'])) {
                $nomProduit = $_POST['nomProduit'];
                $prixProduit = $_POST['prixProduit'];
                $coverProduit = $_FILES['coverProduit']['name']; // Correspond au nom du fichier importé
                $idCategorie = $_POST['idCategorie'];
                $alAffiche = 0;
                Produit::creerProduit($nomProduit, $prixProduit, $coverProduit, $idCategorie, $alAffiche);

                // A faire eventuellement :
                // Quand le produit est une pizza, mener vers la configuration des ingrédients
                self::NosPizzas();
            }
            else {
                self::AfficherErreur403();
            }
        }

        /*
        // Permet de supprimer un produit à partir de son $id
        public static function SupprimerProduit($idProd) {

            // On récupère les infos de ce produit
            $produit = Produit::getOne($idProd);

            $categ = $produit->get('idCategorie');

            // Cas où il s'agit d'une pizza
            if ($categ == 3) {
                
                // On récupère les identifiants de pizzas du produit
                $requete = "SELECT idPizza FROM Pizza WHERE idProduit = :id_Prod";
                $resultat = connexion::pdo()->prepare($requete);
                $tags = array(':id_Prod' => $idProd);
                try {

                    // On récupère les identifiants des pizzas persos
                    $resultat->execute($tags);
                    $tab = $resultat->fetchColumn();

                    // On supprime toutes les pizzas personnalisées
                    foreach($tab as $unePizza) {
                        
                        // On supprime la pizza de la base 
                        Base::delete($unePizza);
                        PizzaPersonnalisee::SupprimerPizzaPersoParIdPizza($unePizza);

                    }
                    
                    // On supprime le produit dans la table Pizza
                    $requete = "DELETE FROM Pizza WHERE idProduit = :id_prod";
                    $requetePreparee = connexion::pdo()->prepare($requete);
                    $tag = array("id_prod" => $idProd);
                    try {
                        // on exécute la requête préparée
                        $requetePreparee->execute($tag);
                    } 
                    catch (PDOException $e) {
                        echo $e->getMessage();
                    }
                }
                catch(PDOException $e){
                    echo $e->getMessage();
                }
            }
            else {

            }
        }
        */

    }
?>
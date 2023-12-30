<?php
require_once('controllerDefaut.php');
require_once('controllerGestionnaire.php');

class controllerConnexion extends controllerDefaut {
    public static function AfficherConnexion() {
        
        // Si l'adresse e-mail et le mot de passe sont spécifiés
        if (isset($_POST['email']) && isset($_POST['mdp'])) {

            $email = $_POST['email'];
            $mdp = $_POST['mdp'];

            // Vérification de l'authenticité des données
            if (controllerGestionnaire::estUnCompte($email, $mdp)) {
                header('index.php?objet=gestionnaire?action=afficherPageGestionnaire');
            }
            else {
                // Affichage de la page de connexion avec erreur
                require_once('view/connexion/debutConnexion.html');
                require_once('view/menu.html');
                require_once('view/connexion/frmConnexion_erreur.html');
                require_once('view/fin.html');
            }
        }

        // Si rien n'a été défini
        else {
            // Affichage de la page de connexion
            require_once('view/connexion/debutConnexion.html');
            require_once('view/menu.html');
            require_once('view/connexion/frmConnexion.html');
            require_once('view/fin.html');
        }

        
    }
}    
?>
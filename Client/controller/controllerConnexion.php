<?php
require_once('controllerDefaut.php');
require_once('controllerGestionnaire.php');

class controllerConnexion extends controllerDefaut {

    // Fonction affichant la page de connexion
    // Prend en paramètre un booléen qui indique
    // s'il faut afficher le message d'erreur
    public static function AfficherConnexion($erreur = false){

        // Affichage avec erreur
        if($erreur) {
            require_once('view/connexion/debutConnexion.html');
            require_once('view/menu.html');
            require_once('view/connexion/frmConnexion_erreur.html');
            require_once('view/fin.html');            
        }
        
        // Affichage sans erreur
        else {
            require_once('view/connexion/debutConnexion.html');
            require_once('view/menu.html');
            require_once('view/connexion/frmConnexion.html');
            require_once('view/fin.html');
        }

    }

    // Fonction qui initialise une connexion
    // si le login et mdp sont corrects,
    // que ce soit pour un client ou un gestionnaire
    public static function Connect() {
        
        // Si l'adresse e-mail et le mot de passe sont spécifiés
        if (isset($_POST['email']) && isset($_POST['mdp'])) {

            $email = $_POST['email'];
            $mdp = $_POST['mdp'];

            // Vérification de l'authenticité des données
            if (controllerGestionnaire::estUnCompte($email, $mdp)) {
                // Paramétrage de $_SESSION
                $_SESSION["email"] = $email;
                $_SESSION["compte"] = "gestionnaire";
                // A coder
            }
            elseif (controllerClient::estUnCompte($email, $mdp)) {
                
                // Récupération du gestionnaire en question
                $client = Client::getOne($email);

                // Paramétrage de $_SESSION
                $_SESSION["email"] = $email;
                $_SESSION["prenom"] = $client->get("prenomClient");
                $_SESSION["nom"] = $client->get("nomClient");
                $_SESSION["compte"] = "client";

                header("Location : index.php?objet=accueil&action=afficherAccueil");
            }
            else {
                // Affichage de la page de connexion avec erreur
                self::AfficherConnexion(true);
            }
        }
        else {
            self::AfficherConnexion();
        }
    }

    public static function Disconnect() {
        session_unset(); // On vide le tableau $_SESSION
        session_destroy(); // On supprime le fichier de données de la session
                           // stocké dans le serveur
        setcookie(session_name(), '', time()-1); // Demande à la machine cliente de 
                                                 // supprimer le cookie de session

        // On revient à la fonction d'affichage d'accueil
        self::AfficherAccueil();
    }
}    
?>